<?php

namespace App\Notifications;

use App\Notifications\MailExtended;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $email;
    protected $subject;
    protected $patient_name;
    protected $admin_email;
    /**
     * Create a new notification instance.
     *
     * @param $email => email content
     * @param $subject => email subject
     * @param $patient_name => patient name
     * @param $admin_email => admin email
     * @return void
     */
    public function __construct($email, $subject, $patient_name, $admin_email)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->patient_name = $patient_name;
        $this->admin_email = $admin_email;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
                    ->subject($this->subject)
                    ->markdown('mail.admin', ['content' => $this->email, 'patient_name' => $this->patient_name]);
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
            'from' => $this->admin_email,
            'message' => $this->email,
            'subject' => $this->subject,
        ];
    }
}