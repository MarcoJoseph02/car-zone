<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
//use App\Http\Controllers\SendEmailJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMailable;
use App\Jobs\SendEmailJob;

class JobController extends Controller
{


    public function sendEmail()
    {
        $email = 'kirosidhom@gmail.com';
        // $email = ;
        //dd($email);
        $token = bin2hex(random_bytes(16)); // Generate token
        dispatch(new SendEmailJob($email, $token));

        //JobController::dispatch($email);
        //Mail::to('customer@example.com')->queue(new OrderShipped($order));

        return "Email queued!";
    }
}
