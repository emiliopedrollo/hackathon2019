<?php

namespace App\Http\Controllers;

use App\Http\Requests\WithUserIdentificationToken;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{

    public function show(User $user) {
        return JsonResource::make($user);
    }

    public function create(Request $request) {

        $data = $request->post('data');

        $user = User::whereIdentificationToken($data['identification_token'])
            ->firstOrNew($data);

        $user->update($data);

        $user->save();

        return JsonResource::make($user);
    }

}
