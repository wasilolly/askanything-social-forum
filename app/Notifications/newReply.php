<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class newReply extends Notification 
{
    use Queueable;
	
	public $thread;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($thread)
    {
        $this->thread = $thread;
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
					->greeting('Hello from AskAnything')
                    ->line('New Reply to a thread you created.')
                    ->action('View Thread', route('thread.show',['slug'=>$this->thread->slug]))
                    ->line('Thank you for using our application!');
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
			'name'=>$this->thread->slug,
            'message'=>'New  reply added to a Thread you created'
        ];
    }
}
