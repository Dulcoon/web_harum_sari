<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\sendEmail;

class sendEmailController extends Controller
{
    public function index()
    {
        return view("homepage.email");
    }

    public function send_email(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
    
        // Ambil data dari form
        $data = [
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'text' => $request->input('message'),
        ];
    
            // Hardcode alamat email tujuan
        $email_target = 'valenfebian353@gmail.com';

        // Kirim email  
        \Mail::to($email_target)->send(new sendEmail($data));
    

        // Redirect dengan pesan sukses
        return redirect()->route('email.form')->with('pesan', 'The email has been successfully sent.');
    }
    

    public function showForm()
        {
        return view('homepage.contact'); // Nama view untuk form
        }

    
}
