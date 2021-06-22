<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CreateOsgbEmployee extends Notification
{
    use Queueable;

    protected $user;
    protected $password;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Aramıza Hoş Geldin ' . Str::title($this->user->name))
            ->line(
                'Parolan otomatik olarak oluşturuldu. Bu parolayı senden başka hiç kimse'
                    . ' bilmiyor merak etme ama eğer istersen'
                    . ' Profiline girip parolanı değiştirebilirsin!'
            )
            ->line('Kullanıcı Adı: ' . $this->user->email)
            ->line('Parola: ' . $this->password)
            ->action('Giriş Yapmak İçin Tıkla!', url('/login'))
            ->subject('Yeni Çalışan Kaydı')
            ->salutation('İyi Günler, Özgür OSGB')
            ->priority(1);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
