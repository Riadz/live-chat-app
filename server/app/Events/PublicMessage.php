<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;


class PublicMessage implements ShouldBroadcastNow
{
	use InteractsWithSockets, SerializesModels;

	public $message;

	public function __construct($message)
	{
		$this->message = $message;
	}

	public function broadcastOn()
	{
		return new Channel('public-chat');
	}

	public function broadcastAs()
	{
		return 'message-created';
	}
}
