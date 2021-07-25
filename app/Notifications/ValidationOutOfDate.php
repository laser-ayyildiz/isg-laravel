<?php

namespace App\Notifications;

use Illuminate\Support\Str;
use App\Models\CoopEmployee;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class ValidationOutOfDate extends Notification implements ShouldQueue
{
    use Queueable;

    const FILE_TYPES = [
        'first_edu' => 'İSG Eğitimi 1',
        'second_edu' => 'İSG Eğitimi 2',
        'examination' => 'Sağlık Muayenesi'
    ];
    private $employee;
    private $changeValues;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(CoopEmployee $employee, $changeValues)
    {
        $this->employee = $employee;
        $this->changeValues = $changeValues;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $changedFiles = "";
        foreach ($this->changeValues as $key => $value) $changedFiles .= ", " . self::FILE_TYPES[$key];

        return [
            'type' => 'Dosya Geçerlilik Süresi',
            'text' => Str::upper($this->employee->company->name) . ' işletmesinden ' . Str::upper($this->employee->name) . ' isimli çalışanın' . $changedFiles . ' dosyalarının geçerlilik süresi doldu. Lütfen dosyaları yenileyiniz!.',
        ];
    }
}
