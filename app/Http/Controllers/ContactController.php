<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail; // <--- Yeh line zaroori hai

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Agar request AJAX nahi hai, toh headers force kar dein
        $request->headers->set('Accept', 'application/json');

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        Mail::raw("New contact message from:\n\nName: {$contact->name}\nEmail: {$contact->email}\nMessage:\n{$contact->message}", function ($message) use ($contact) {
            $message->to('farahmanzoor2336@gmail.com')
                    ->subject('New Portfolio Message from ' . $contact->name);
        });

        return response()->json(['success' => 'Thank you! Your message has been sent successfully.']);
    }
}