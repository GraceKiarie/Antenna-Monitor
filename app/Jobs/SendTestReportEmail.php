<?php

namespace App\Jobs;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Mail\Mailer;

class SendTestReportEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $data = [];
    public $url;
    public function __construct($data,$url)
    {
        $this->data = $data;
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle($data,$url )
    {
        $this->data = $data;
        $this->url = $url;

        //send mail

        try {
            Mail::send('mails.test_report', ['data'=>'data'], function ($message) use ($url, $data) {
                $message->to('gnjokikiarie@gmail.com')->subject('Test Report!')
                    ->subject('Test Report Certificate')
                    ->attach($url);
            });
        } catch (JWTException $exception) {
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }

        if (Mail::failures()) {
            return response()->json(['status'=>'failure','data'=>['message'=>'error occured']],401);

        } else {
            return response()->json(['status'=>'success','data'=>['message'=>'report generated']],200);
        }

    }
}
