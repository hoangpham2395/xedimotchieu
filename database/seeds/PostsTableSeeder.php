<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset posts table
        DB::table('posts')->truncate();

        // Create virtual DB
        $faker = Faker::create();
        $posts = [];
        $cities = [
        	1 => [1, 11],
        	2 => [12, 19],
        	3 => [20, 29],
        	4 => [30, 37],
        	5 => [38, 44],
        ];

        foreach (range(1, 20) as $index) {
        	$cityFromId = rand(1, 5);
        	$cityToId = rand(1, 5);
        	$posts[] = [
        		'user_id' => rand(1, 20),
        		'city_from_id' => $cityFromId,
        		'city_to_id' => $cityToId,
        		'district_from_id' => rand($cities[$cityFromId][0], $cities[$cityFromId][1]),
        		'district_to_id' => rand($cities[$cityToId][0], $cities[$cityToId][1]),
        		'car_id' => rand(1, 20),
        		'type' => rand(1, 2),
        		'date_start' => new DateTime,
        		'cost' =>rand(0, 9) * 10000,
        		'phone' => ljust(rand(100000000, 999999999), 10, '0'),
        		'note' => $faker->text(rand(150,200)),
        		'created_at' => new DateTime, 
        		'del_flag' => 0
        	];
        }

        // Insert DB
        DB::table('posts')->insert($posts);
    }
}
