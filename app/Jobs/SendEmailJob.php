<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Job;
use Illuminate\Contracts\Mail\Mailable;
use App\Http\Controllers\JobController;
use App\Mail\ResetPasswordMail;
use App\Mail\TestMailable;
// extends Mailable
class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $dataEmail;
    protected $otp;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$otp)
    {
        $this->dataEmail = $email;
        $this->otp = $otp;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //$token = bin2hex(random_bytes(16));
        Mail::to($this->dataEmail)->send(new ResetPasswordMail($this->dataEmail,$this->otp));
        // Mail::to('marojojo707@gmail.com')->send(new ResetPasswordMail($this->dataEmail,$this->otp));
    }
}
