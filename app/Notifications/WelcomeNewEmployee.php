<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class WelcomeNewEmployee extends Notification
{
    use Queueable;

    private object $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via(mixed $notifiable): array
    {
        return ["mail"];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail(mixed $notifiable): MailMessage
    {
        $appName = config("app.name");

        return (new MailMessage())
            ->subject("Witamy w {$appName}")
            ->greeting("Cześć {$this->data->firstname} {$this->data->surname}")
            ->line(
                "Serdecznie witamy w {$appName}! Od teraz możesz przeglądać działy, w których się znajdujesz oraz sprawdzić, kto w nich pracuje."
            )
            ->line("Zostałeś dodany(-a) przez Administratora systemu. Możesz się już zalogować poniższymi danymi:")
            ->line(new HtmlString("Adres e-mail: {$this->data->email} <br> Hasło: {$this->data->password}"))
            ->action("Przejdź do logowania", url(route("auth.login.index")));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray(mixed $notifiable): array
    {
        return [
                //
            ];
    }
}
