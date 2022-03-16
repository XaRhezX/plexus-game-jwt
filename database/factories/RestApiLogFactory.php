<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RestApiLog>
 */
class RestApiLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $data = rand(1,2);
        $dateTime = $this->faker->dateTimeThisMonth();

        return [
            'ip_address'=> $this->faker->ipv4(),
            'method'    => ($data % 2 == 0) ? "GET" : "POST",
            'request'   => ['factory'=>'factory'],
            'endpoint'  => $this->faker->url(),
            'useragent' => $this->faker->userAgent(),
            'header'    => ['factory'=>'factory'],
            'user_id'   => User::inRandomOrder()->first()->id,
            'created_at'=> $dateTime,
            'updated_at'=> $dateTime,
        ];
        /*
        return [
            'name' => "Games Of ".$this->faker->unique()->name()
        ];*/
    }
}
