<?php

namespace App\Http\Controllers;

use App\Note;
use chillerlan\QRCode\QRCode;
use App\Http\Requests\WithUserIdentificationToken;

class NoteController extends Controller
{

    public function visualize() {
        /** @var Note $note */
        $note = Note::whereNull('user_id')->inRandomOrder()->first();


        $identifier = "";
        for ($i = 0; $i < 11; $i++) {
            $identifier .= " ".substr($note->note_identifier,$i * 4, 4);
        }
        $identifier = trim($identifier);

        $qr_code = (new QRCode())->render("https://someshit.here.com/".$note->note_identifier);

        return view('note', [
            'note' => $identifier,
            'qr_code' => $qr_code
        ]);

    }


    public function show(Note $note) {
        return $note->load('products')->toArray();
    }

    public function attach(WithUserIdentificationToken $request) {
        $user = $request->getAuthUser();

        $fields = $request->validated();

        $note = Note::where('note_identifier', '=', $fields['note_identifier'])
            ->firstOrFail();

        if ($note->user_id != null) {
            return "Nota fiscal já cadastrada ):";
        }

        $note->update([
            'user_id' => $user->id,
        ]);

        $user->update([
            'cashback_available' = $user->cashback_available + $note->discount_value,
        ]);
        
        return 'Aproveite seu cashback de ' . $note->discount_value . '!';
    }
}
