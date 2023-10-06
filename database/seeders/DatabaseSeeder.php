<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(1)->create([
            'name'=>'Wanderson Passos Barcelos',
            'email'=>'wp.barcelos@gmail.com',
            'password'=> bcrypt('password')
        ]);

        \App\Models\Event::factory(rand(5,10))->create()->each(function($event){

            \App\Models\EventSubscribe::factory(rand(10,40))->create([
                'event_id'=> $event->id
            ]);

        });



        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
