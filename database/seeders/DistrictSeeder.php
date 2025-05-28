<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = [
            ['id' => '0ee346c1-e633-4508-9193-3c71d1fd476e', 'name' => 'Kulai'],
            ['id' => '327e6392-14dc-4f37-aa6a-b532eee716cb', 'name' => 'Simpang Renggam'],
            ['id' => '4770eb02-aa3b-4ca2-b9f7-0550aa96b2f1', 'name' => 'Muar'],
            ['id' => '7639b4bd-f882-4c5c-a763-a3cb4d50c2e0', 'name' => 'Segamat'],
            ['id' => '832adf6f-be04-499e-a1e9-87f9e7af66cb', 'name' => 'Skudai'],
            ['id' => '8f108c42-0283-4dc8-844c-bb5feb33387e', 'name' => 'Yong Peng'],
            ['id' => '92e516da-ebdb-4965-874c-b15cb77bbff6', 'name' => 'Batu Pahat'],
            ['id' => '9b57fb0b-1b23-4b01-9e6b-da5cdae9929d', 'name' => 'Mersing'],
            ['id' => '9bec31ff-3ac3-4485-b7e2-034dbbb1b819', 'name' => 'Kluang'],
            ['id' => '9c4cac25-2a34-4538-b764-46909f6d31f2', 'name' => 'Kota Tinggi'],
            ['id' => 'b6c9ab59-53f0-4e83-8936-d99ec2020451', 'name' => 'Tangkak'],
            ['id' => 'c9e891b7-da12-4ebb-b4a7-4f33ca1240f6', 'name' => 'Bandar Penawar'],
            ['id' => 'f3ca160b-f02d-423c-aa64-e33ea325abbf', 'name' => 'Labis'],
            ['id' => 'f3ce649e-a327-4877-8124-383064de3b40', 'name' => 'Pasir Gudang'],
            ['id' => 'f9d7f89f-a171-4f2d-8950-9cfd0cd5a69e', 'name' => 'Pontian'],
            ['id' => 'fe2bc068-c6f3-4e74-984e-5d09a06f92fb', 'name' => 'Johor Bahru'],
        ];

        foreach ($districts as $district) {
            District::updateOrCreate(
                ['id' => $district['id']],
                ['name' => $district['name']]
            );
        }
    }
}