<?php

use Illuminate\Database\Seeder;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cars table
        DB::table('cars')->truncate();
        $cars = [];
        $carNames = [
        	1 => 'Toyota',
        	2 => 'Huyndai',
        	3 => 'Kia',
        	4 => 'Ford',
        	5 => 'Thaco',
        	6 => 'Vinfast',
        	7 => 'Mitsubishi',
        	8 => 'Suzuki',
        	9 => 'Honda',
        ];

        foreach (range(1, 20) as $index) {
        	$cars[] = [
        		'user_id' => rand(1, 20),
                'car_name' => $carNames[rand(1, 9)],
        		'car_type' => rand(1, 8),
        		'created_at' => new DateTime, 
        		'del_flag' => 0
        	];
        }

        // Insert DB
        DB::table('cars')->insert($cars);
    }
}
