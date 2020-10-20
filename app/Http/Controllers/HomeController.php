<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if(Token::where('user_id', Auth::user()->id)->first()){

        return Auth::user()->auth !== 'guest'
        ? view('dashboard')
        :view('guest');
        }else{
            return Auth::user()->auth !== 'guest'
            ? view('zoom')
            :view('guest');
        }
    }

}
