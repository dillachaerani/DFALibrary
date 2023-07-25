<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SharingBisnisMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        $data = [
            'name'      => "Dody",
            'email'     => "email",
            'handphone' => "handphone",
            'address'   => "address",
            'gender'    => "M",
            'age'       => "age",
        ];
        // return view('email.sharing-bisnis.eticket.index', compact('data'));
        $to = "alfiandody4@gmail.com";
        \Mail::to($to)->send(new SharingBisnisMail($data));
        dd("Email sudah terkirim.");
    }
}
