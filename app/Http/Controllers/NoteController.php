<?php

namespace App\Http\Controllers;

use App\Http\Requests\WithUserIdentificationToken;
use App\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{


    public function attach(WithUserIdentificationToken $request) {
        $user = $request->getAuthUser();

        $fields = $request->validated();

        $note = Note::where('note_identifier', '=', $fields['note_identifier'])->firstOrFail();

        $note->update([
            'user_id' => $user->id,
        ]);
        
        return 'Aproveite seu cashback!';
    }
}
