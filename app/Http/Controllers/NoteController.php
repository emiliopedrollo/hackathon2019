<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttachNoteRequest;
use App\Note;
use chillerlan\QRCode\QRCode;

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

        $qr_code = (new QRCode())->render("https://gmonte.github.io/meta-hackathon-front/c/".$note->note_identifier);

        return view('note', [
            'note' => $identifier,
            'qr_code' => $qr_code
        ]);

    }


    public function show(Note $note) {
        return static::respondData($note->load('products')->toArray());
    }

    public function attach(AttachNoteRequest $request) {

        $user = $request->getAuthUser();

        $fields = $request->validated();

        $note_identifier = $fields['data']['note_identifier'];

        /** @var Note $note */
        $note = Note::where('note_identifier', '=', $note_identifier)
            ->firstOrFail();

        if ($note->user_id != null) {
            return static::respondWithError('Nota fiscal já cadastrada ):');
        }

        $note->update([
            'user_id' => $user->id,
        ]);

        $user->update([
            'cashback_available' => $user->cashback_available + $note->discount_value,
        ]);
        return static::respondData(['message' => 'Aproveite seu cashback de ' . $note->discount_value . '!']);
    }
}
