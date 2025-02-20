<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
//use App\Http\Controllers\SendEmailJob;
use App\Jobs\SendEmailJob;

class JobController extends Controller
{


    public function sendEmail()
{
    $email = 'kirosidhom@gmail.com';
    SendEmailJob::dispatch($email);
    //Mail::to('customer@example.com')->queue(new OrderShipped($order));

    return "Email queued!";
}
    
}
