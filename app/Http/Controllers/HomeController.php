<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lead;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendNewMail;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('guest.home');
    }

    public function listPostApi()
    {
        return view('api.home');
    }

    public function contact()
    {
        return view('guest.contact');
    }

    public function handleContactForm(Request $request)
    {
        // salviamo tutti i dati inseriti nel form di contatto 
        $form_data = $request->all();
        $new_lead = new Lead();
        $new_lead->fill($form_data);
        $new_lead->save();

        // inviamo la mail all'admin del sito passando il nuovo oggetto Lead 

        Mail::to('Elymara13@gmail.com')->send(new SendNewMail($new_lead));
        return redirect()->route('contacts.thank-you');
    }


    public function thankYou()
    {
        return view('guest.thank-you');
    }

}
