<?php

namespace App\Jobs;

use App\Mail\ApiMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $messageFields;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->messageFields = $request->validated();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->sendEmail();
    }

    /**
     * Обработка неудавшейся задачи
     *
     * @return void
     */
    public function failed()
    {
        Log::error('«Ошибка выполнения задачи очереди».');
    }

    public function sendEmail()
    {
        Mail::to($this->messageFields['user_email'])->send(new ApiMail('from@example.com'));

    }
}
