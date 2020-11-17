<?php

namespace App\Notifications;

use App\Models\Project;
use App\Models\AdminUser;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProjectAwaitingApproval extends Notification {
    use Queueable;

    protected $project;

    protected $requesting_user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( Project $project, AdminUser $requestingUser ) {
        $this->project         = $project;
        $this->requesting_user = $requestingUser;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via( $notifiable ) {
        return [ 'mail', 'database' ];
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
            ->line( sprintf( 'There is a new project that is awaiting your approval. %s was saved as an official version by %s.', $this->project->title, $this->requesting_user->full_name ) )
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
            'type'            => 'AWAITING_MANAGER_APPROVAL',
            'url' => url( rtrim( $this->project->resource_url, '/' ) . '/edit', [ 'id' => $this->id ] ),
        ];
    }
}
