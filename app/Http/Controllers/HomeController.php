<?php

namespace App\Http\Controllers;

use App\Http\Requests\WithUserIdentificationToken;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function userIndex(WithUserIdentificationToken $request) {
        $user = $request->getAuthUser();

        $notes = $user->notes()->orderBy('created_at', 'desc')->get();

        $discounts = $user->discounts()->orderBy('created_at', 'desc')->get();

        $history = collect($notes->toArray())->merge($discounts->toArray())->sortByDesc('created_at');

        return static::respondData([
            'user' => $user->toArray(),
            'history' => $history->toArray(),
        ]);
    }

}
