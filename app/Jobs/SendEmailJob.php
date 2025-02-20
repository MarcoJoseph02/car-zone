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
use App\Mail\TestMailable;
// extends Mailable
class SendEmailJob  implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $dataEmial;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->dataEmial = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to('kirosidhom@gmail.com')->send(new TestMailable('3mk'));
    }
}
