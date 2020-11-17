<?php

namespace App\Notifications;

use App\Models\Project;
use App\Models\AdminUser;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProjectedApproved extends Notification {
    use Queueable;

    protected $project;

    protected $approved_by;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( Project $project, AdminUser $approver ) {
        $this->project     = $project;
        $this->approved_by = $approver;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via( $notifiable ) {
        return [ 'mail' ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail( $notifiable ) {
        return ( new MailMessage )
            ->greeting( sprintf( 'Hi %s,', $notifiable->first_name ) )
            ->line( sprintf( 'A project that you have recently marked as "official" has been approved. %s was checked as an official version by %s.', $this->project->title, $this->approved_by->full_name ) )
            ->action( 'Click to review', url( $this->project->resource_url . '/edit' ) );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray( $notifiable ) {
        return [
            'requesting-user' => $this->requesting_user,
            'project'         => $this->project,
            'type'            => 'MANAGER_APPROVED'
        ];
    }
}
