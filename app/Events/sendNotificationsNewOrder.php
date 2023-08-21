<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class sendNotificationsNewOrder implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $config;

    public $broadcastName;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($config)
    {
        $this->config    = $config;

        $this->broadcastName = 'realtimeBranchID_' . $this->config['branch_id'];

        if (isset($this->config['broadcastName'])) {
            $this->broadcastName = $this->config['broadcastName'];
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('newOrdersDigitalMenu');
    }

    public function broadcastAs()
    {
        return $this->broadcastName;
    }
}
