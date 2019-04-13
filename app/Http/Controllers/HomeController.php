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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function userIndex(WithUserIdentificationToken $request) {
        $user = $request->getAuthUser();

        $notes = $user->notes()->orderBy('created_at', 'desc')->limit(20)->get();

        $coupons = $user->discounts()->orderBy('created_at', 'desc')->get();

        return 'blah monte bobao';
    }

}
