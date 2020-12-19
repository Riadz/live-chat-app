<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
	protected $model = Post::class;

	public function definition()
	{
		return [
			'user_id' => User::inRandomOrder()->get()->first()->id,
			'title'   => $this->faker->sentence(3),
			'body'    => $this->faker->sentence(20),
		];
	}
}
