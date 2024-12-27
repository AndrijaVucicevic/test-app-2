<?php

namespace App\Listeners;

use App\Enums\SettingsEnum;
use App\Events\ImportErrorOccurred;
use App\Mail\ImportErrorMail;
use App\Models\Settings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendImportErrorNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ImportErrorOccurred $event)
    {
        $error = $event->error;

        $mail = json_decode(DB::table('settings')->where('key', SettingsEnum::IMPORT_ERROR_MAIL->value)->first()->value)->mail;

        Mail::to($mail->to)->cc($mail->cc)->send(new ImportErrorMail($error));
    }
}
