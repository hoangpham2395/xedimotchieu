<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset users table
        DB::table('admin')->truncate();

        // Init data
        $admin = [
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role_type' => 1,
            'created_at' => new DateTime,
            'del_flag' => 0,
        ];

        // Insert DB
        DB::table('admin')->insert($admin);
    }
}
