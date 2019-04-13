<?php

namespace App\Http\Controllers;

use App\Note;
use chillerlan\QRCode\QRCode;
use Illuminate\Http\Request;

class NoteController extends Controller
{

    public function create(Request $request) {
        $cpf = $request->get('cpf');

        $attributes = [];

        if ($cpf) {
            $attributes['cpf'] = $cpf;
        }

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

}
