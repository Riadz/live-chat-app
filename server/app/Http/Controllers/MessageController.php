<?php

namespace App\Http\Controllers;

use App\Events\PublicMessage;
use Laravel\Lumen\Routing\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class MessageController extends Controller
{
	function fetch()
	{
		$messages = Message::all();
		return response()->json($messages);
	}

	function store(Request $request)
	{
		$message = Message::create($request->all());

		broadcast(new PublicMessage($message));

		return response()->json(['message created']);
	}
}
