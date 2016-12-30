<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use DB;
use Auth;
use App\Participant;
use App\Message;

class MessageSent extends Event implements ShouldBroadcast {

    use SerializesModels;

    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Message $message) {
        $this->message = $message;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn() {
        // return new PrivateChannel();
        return ['messenger-channel'];
    }

    public function broadcastWith() {
        $participants = Participant::with([
                    'user' => function($query) {
                        $query->select('id', 'username', 'thumbnail');
                    }
                ])->where('conversation_id', $this->message->conversation_id)->get();
        return ["participants" => $participants, "message" => $this->message];
    }

}
