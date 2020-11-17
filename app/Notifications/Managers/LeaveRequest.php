<?php

namespace App\Notifications\Managers;

use App\Models\AdminUser;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LeaveRequest extends Notification
{
    use Queueable;

    protected $leaveRequest;

    protected $requestingUser;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( \App\Models\LeaveRequest $leaveRequest, \Brackets\AdminAuth\Models\AdminUser $requestingUser )
    {
        $this->leaveRequest = $leaveRequest;
        $this->requestingUser = $requestingUser;
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
                    ->line('There is a new leave request for you to review.')
                    ->action('Review', url( rtrim( $this->leaveRequest->resource_url, '/' ) . '/edit', [ 'id' => $this->id ] ) );
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
            'requesting-user' => $this->requestingUser,
            'request'         => $this->leaveRequest,
            'type'            => 'AWAITING_APPROVAL',
            'url' => url( rtrim( $this->leaveRequest->resource_url, '/' ) . '/edit', [ 'id' => $this->id ] ),
        ];
    }
}
