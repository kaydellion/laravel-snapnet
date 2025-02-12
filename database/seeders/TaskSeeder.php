<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
         $user = User::orderBy('id', 'desc')->first(); // This will get the last existing user in the database

         // Now create tasks and assign them to the created user
         Task::factory()->count(20)->create([
             'user_id' => $user->id, // Assigning tasks to the newly created user
         ]);
    }
    
}
