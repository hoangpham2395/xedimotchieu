<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset users table
        DB::table('cities')->truncate();

        // Init data
        $cities = [
            ['city_name' => 'Tỉnh An Giang',],
            ['city_name' => 'Tỉnh Bà Rịa - Vũng Tàu',],
            ['city_name' => 'Tỉnh Bắc Giang',],
            ['city_name' => 'Tỉnh Bắc Kạn',],
            ['city_name' => 'Tỉnh Bạc Liêu',],
            ['city_name' => 'Tỉnh Bắc Ninh',],
            ['city_name' => 'Tỉnh Bến Tre',],
            ['city_name' => 'Tỉnh Bình Định',],
            ['city_name' => 'Tỉnh Bình Dương',],
            ['city_name' => 'Tỉnh Bình Phước',],
            ['city_name' => 'Tỉnh Bình Thuận',],
            ['city_name' => 'Tỉnh Cà Mau',],
            ['city_name' => 'Tỉnh Cao Bằng',],
            ['city_name' => 'Thành Phố Cần Thơ',],
            ['city_name' => 'Thành phố Đà Nẵng',],
            ['city_name' => 'Tỉnh Đắk Lắk',],
            ['city_name' => 'Tỉnh Đắk Nông',],
            ['city_name' => 'Tỉnh Điện Biên',],
            ['city_name' => 'Tỉnh Đồng Nai',],
            ['city_name' => 'Tỉnh Đồng Tháp',],
            ['city_name' => 'Tỉnh Gia Lai',],
            ['city_name' => 'Tỉnh Hà Giang',],
            ['city_name' => 'Tỉnh Hà Nam',],
            ['city_name' => 'Thành phố Hà Nội',],
            ['city_name' => 'Tỉnh Hà Tĩnh',],
            ['city_name' => 'Tỉnh Hải Dương',],
            ['city_name' => 'Thành phố Hải Phòng',],
            ['city_name' => 'Tỉnh Hậu Giang',],
            ['city_name' => 'Tỉnh Hòa Bình',],
            ['city_name' => 'Tỉnh Hưng Yên',],
            ['city_name' => 'Tỉnh Khánh Hòa',],
            ['city_name' => 'Tỉnh Kiên Giang',],
            ['city_name' => 'Tỉnh Kon Tum',],
            ['city_name' => 'Tỉnh Lai Châu',],
            ['city_name' => 'Tỉnh Lâm Đồng',],
            ['city_name' => 'Tỉnh Lạng Sơn',],
            ['city_name' => 'Tỉnh Lào Cai',],
            ['city_name' => 'Tỉnh Long An',],
            ['city_name' => 'Tỉnh Nam Định',],
            ['city_name' => 'Tỉnh Nghệ An',],
            ['city_name' => 'Tỉnh Ninh Bình',],
            ['city_name' => 'Tỉnh Ninh Thuận',],
            ['city_name' => 'Tỉnh Phú Thọ',],
            ['city_name' => 'Tỉnh Quảng Bình',],
            ['city_name' => 'Tỉnh Quảng Nam',],
            ['city_name' => 'Tỉnh Quảng Ngãi',],
            ['city_name' => 'Tỉnh Quảng Ninh',],
            ['city_name' => 'Tỉnh Quảng Trị',],
            ['city_name' => 'Tỉnh Sóc Trăng',],
            ['city_name' => 'Tỉnh Sơn La',],
            ['city_name' => 'Tỉnh Tây Ninh',],
            ['city_name' => 'Tỉnh Thái Bình',],
            ['city_name' => 'Tỉnh Thái Nguyên',],
            ['city_name' => 'Tỉnh Thanh Hóa',],
            ['city_name' => 'Tỉnh Thừa Thiên Huế',],
            ['city_name' => 'Tỉnh Tiền Giang',],
            ['city_name' => 'Tỉnh Trà Vinh',],
            ['city_name' => 'Tỉnh Tuyên Quang',],
            ['city_name' => 'Thành phố Hồ Chí Minh',],
            ['city_name' => 'Tỉnh Vĩnh Long',],
            ['city_name' => 'Tỉnh Vĩnh Phúc',],
            ['city_name' => 'Tỉnh Yên Bái',],
            ['city_name' => 'Tỉnh Phú Yên',],
        ];

        // Insert DB
        DB::table('cities')->insert($cities);
    }
}
