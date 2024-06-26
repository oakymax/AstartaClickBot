<?php

namespace App\Botflow\Events;

use App\Botflow\Telegraph\DTO\Update;
use DefStudio\Telegraph\DTO\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TelegramMessageReceived
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public function __construct(public Message $message)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
