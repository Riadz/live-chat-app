<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
	protected $model = User::class;

	public function definition()
	{
		return [
			'name'     => $this->faker->name,
			'number'   => $this->faker->phoneNumber,
			'password' => $this->faker->password,
			'email'    => $this->faker->boolean(50) ? $this->faker->unique()->safeEmail : null,
		];
	}
}
