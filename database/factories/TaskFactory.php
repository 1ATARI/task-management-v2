<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {



        return [
            'title'=>fake()->colorName,
            'body'=>fake()->paragraph,
            'status'=>fake()->randomElement(['In progress' , 'Completed']),
            'user_id'=>fake()->numberBetween('1' , User::count()),
            'created_at'=>$this->faker->dateTime,


            'department_id'=>fake()->numberBetween('1' , Department::count())
        ];

    }
}
