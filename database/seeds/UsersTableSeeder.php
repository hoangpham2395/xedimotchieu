<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Reset users table
        DB::table('users')->truncate();

        // Create virtual DB
        $faker = Faker::create();
        $users = [];

        foreach (range(1, 20) as $index) {
        	$users[] = [
        		'name' => $faker->name,
        		'email' => $faker->email,
        		'fb_id' => str_random(8),
                'gg_id' => str_random(8),
        		'open_flag' => rand(0, 1),
        		'created_at' => new DateTime, 
        		'del_flag' => 0
        	];
        }

        // Insert DB
        DB::table('users')->insert($users);
    }
}
