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

    

    public $broadcastName; 
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($broadcastName)
    {
      
       
        $this->broadcastName = $broadcastName['broadcastName'];
            
        if ( isset($this->config['broadcastName']) )
        {
            $this->broadcastName = $broadcastName['broadcastName'];
        }

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
      return ['newOrdersDigitalMenu'];

       
    }

    public function broadcastAs()
    {
        return $this->broadcastName;
    }
}
