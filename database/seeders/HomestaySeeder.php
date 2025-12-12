<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class HomestaySeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $fasilitasList = [
            ['WiFi', 'AC', 'Kamar Mandi Dalam', 'Parkir Luas', 'Televisi'],
            ['WiFi', 'Kipas Angin', 'Dapur Bersama'],
            ['AC', 'Air Panas', 'Sarapan', 'Parkir'],
            ['Kamar Mandi Dalam', 'Tempat Tidur Queen', 'WiFi'],
            ['Tempat Tidur King', 'Air Panas', 'TV', 'Parkir Motor'],
            ['WiFi', 'Televisi', 'Meja Kerja', 'Kulkas Mini']
        ];

        $statusList = ['aktif', 'nonaktif'];

        for ($i = 0; $i < 100; $i++) {

            DB::table('homestay')->insert([
                'pemilik_warga_id' => $faker->numberBetween(1, 100), // asumsi warga_id 1–100 sudah ada
                'nama'             => 'Homestay ' . $faker->lastName(),
                'alamat'           => $faker->streetAddress(),
                'rt'               => $faker->numberBetween(1, 10),
                'rw'               => $faker->numberBetween(1, 10),
                'fasilitas_json'   => json_encode($faker->randomElement($fasilitasList)),
                'harga_per_malam'  => $faker->numberBetween(100000, 700000),
                'status'           => $faker->randomElement($statusList),
                'created_at'       => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at'       => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
