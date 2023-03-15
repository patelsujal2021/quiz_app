<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

         /*\App\Models\Admin::create([
             'first_name' => 'Admin',
             'last_name' => 'Admin',
             'email' => 'admin@gmail.com',
             'password' => Hash::make('admin@123')
         ]);*/

        \App\Models\Answer::create(['title' => 'php 1', 'question_id' => 1]);
        \App\Models\Answer::create(['title' => 'php 2', 'question_id' => 1]);
        \App\Models\Answer::create(['title' => 'php 3', 'question_id' => 1]);
        \App\Models\Answer::create(['title' => 'php 8', 'question_id' => 1]);

        \App\Models\Question::create([
            'title' => 'What is current php version?',
            'correct_answer' => \App\Models\Answer::first()->id
        ]);
    }
}
