<?php

namespace Database\Factories;


use App\Models\User;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TaskFactory extends Factory
{  /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
   protected $model = Task::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $arrayValues = ['TODO', 'DOING', 'DONE'];
        return [
            
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => $arrayValues[rand(0,2)],
            'user_id' =>  User::factory()->create()->id,
        ];
    }
}
