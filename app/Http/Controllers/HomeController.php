<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\Contact;

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
      $all_user = User::all();
      return view('home', compact('all_user'));
    }
    function contactmessageview()
    {
      $contactMessages = Contact::all();
      return view('contact.messageview',compact('contactMessages'));
    }
}
