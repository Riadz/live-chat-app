<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class TestMessageEvent implements ShouldBroadcast
{
	use InteractsWithSockets, SerializesModels;

	public $id;
	public $user;
	public $message;
	public $time;

	public function __construct($msg)
	{

		$this->msg = $msg;
	}

	public function broadcastOn()
	{
		return new Channel('test');
	}
}
