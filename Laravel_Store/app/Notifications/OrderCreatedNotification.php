<?php

namespace App\Notifications;

use App\Mail\Orders\NewOrderForCustomer;
use Illuminate\Bus\Queueable;
use App\Services\AwsPublicLinkService;
use App\Services\Contracts\InvoicesServiceContract;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\Telegram\TelegramFile;
use NotificationChannels\Telegram\TelegramMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['mail', 'telegram'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return NewOrderForCustomer
     */
    public function toMail($notifiable)
    {
        return (new NewOrderForCustomer($notifiable->id, $notifiable->user->name))->to($notifiable->user);
    }

    public function toTelegram($notifiable)
    {
        $invoiceService = app()->make(InvoicesServiceContract::class);
        $pdf = $invoiceService->generate($notifiable)->save('s3');
        $fileLink = AwsPublicLinkService::generate($pdf->filename);

        return  TelegramFile::create()
            ->to($notifiable->user->telegram_id)
            ->content("Hello, your order #{$notifiable->id} was created")
            ->document($fileLink, $pdf->filename);
    }
}