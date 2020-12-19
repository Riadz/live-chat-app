<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Laravel\Lumen\Routing\Controller;
use App\Models\Post;

class PostController extends Controller
{
	function getPosts()
	{
		$posts = Post::take(20)->with('user')->get();
		return $this->apiRes($posts);
	}

	function test()
	{
		Event::dispatch(new \App\Events\TestMessageEvent('Hello world'));
		return 'Broadcasted !';
	}

	private function apiRes($data)
	{
		return response(
			$data,
			200,
			[
				'Access-Control-Allow-Origin' => '*',
				'Content-Type' => 'application/json',
			]
		);
	}
}
