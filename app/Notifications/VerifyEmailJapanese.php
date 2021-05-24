<?php


namespace App\Notifications;


use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class VerifyEmailJapanese extends VerifyEmail
{
    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
        }

        $mailMessage = new MailMessage;
        $mailMessage->greeting = Lang::getFromJson('ご登録ありがとうございます。');

        return $mailMessage
            ->subject(Lang::getFromJson('メールアドレスの確認'))
            ->line(Lang::getFromJson('下のボタンをクリックして、メールアドレスを確認してください。'))
            ->action(Lang::getFromJson('メールアドレスの確認'), $verificationUrl)
            ->line(Lang::getFromJson('もしこのメールに覚えが無い場合は破棄してください。'));
    }
}
