<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserLoggedOut implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $userName="";
    public $userId=0;
    /**
     * Create a new event instance.
     */
    public function __construct(string $name,$id)
    {
        $this->userName=$name;
        $this->userId=$id;
    }
    function broadcastWith(){
        return[
            "name"=>$this->userName,
            "id"=>$this->userId,
            "message"=>"Logged out"
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('channel'),
        ];
    }
}
