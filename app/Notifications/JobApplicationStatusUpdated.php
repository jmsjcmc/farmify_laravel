<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class JobApplicationStatusUpdated extends Notification
{

    use Queueable;


    protected $data;

    // public function __construct(private $application)
    // {
    //     $this->application = $application;
    // }

    // public function via($notifiable): array
    // {
    //     return ['database', 'broadcast'];
    // }

    // public function toBroadcast($notifiable): BroadcastMessage
    // {
    //     return new BroadcastMessage([
    //         'message' => "Your application for {$this->application->job->title} has been {$this->application->status}",
    //         'application' => $this->application->id
    //     ]);
    // }

    // public function toArray($notifiable): array
    // {
    //     return [
    //         'application_id' => $this->application->id,
    //         'job_title' => $this->application->job->title,
    //         'status' => $this->application->status
    //     ];
    // }

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return $this->data;
    }
}
