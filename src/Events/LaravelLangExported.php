<?php

namespace YazeedObaid\Lang\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LaravelLangExported
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $messages;

    public function __construct($messages)
    {
        $this->messages = $messages;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel(config('laravel-lang.events.channel', 'channel-name'));
    }
}