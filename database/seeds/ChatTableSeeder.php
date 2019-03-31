<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ChatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset users table
        DB::table('chat')->truncate();

        // Create virtual DB
        $faker = Faker::create();
        $chat = [];

        foreach (range(1, 20) as $index) {
        	$chat[] = [
        		'user_from_id' => rand(1, 20),
                'user_to_id' => rand(1, 20),
        		'content' => $faker->sentence,
        		'created_at' => new DateTime, 
        		'del_flag' => 0
        	];
        }

        // Insert DB
        DB::table('chat')->insert($chat);
    }
}
