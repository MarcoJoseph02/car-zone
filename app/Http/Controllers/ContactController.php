<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class ContactController extends Controller
{
     public function send(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'body' => 'required|string|max:1000',
        ]);

        // Send email
        Mail::raw("Message from: {$validated['name']} ({$validated['email']})\n\n{$validated['body']}", function ($message) {
            $message->to('marco.joseph.dev@gmail.com')
                    ->subject('New Contact Us Message');
        });

        return response()->json([
            'message' => 'Your message has been sent successfully.',
        ], 200);
    }
}
