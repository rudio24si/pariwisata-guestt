<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class KamarHomestaySeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $fasilitasKamar = [
            ['AC', 'Kamar Mandi Dalam', 'WiFi'],
            ['Kipas Angin', 'Kamar Mandi Luar'],
            ['AC', 'Air Panas', 'TV', 'WiFi'],
            ['Tempat Tidur Queen', 'AC', 'Kamar Mandi Dalam'],
            ['Tempat Tidur King', 'AC', 'Air Panas', 'TV'],
            ['WiFi', 'Meja Kerja', 'Lemari']
        ];

        for ($i = 1; $i <= 100; $i++) {

            DB::table('kamar_homestay')->insert([
                'homestay_id' => $faker->numberBetween(2, 56),
                'nama_kamar' => 'Kamar ' . $faker->randomElement(['Standard', 'Deluxe', 'Superior', 'Family']) . ' ' . $faker->numberBetween(1, 20),
                'kapasitas' => $faker->numberBetween(1, 6),
                'fasilitas_json' => json_encode($faker->randomElement($fasilitasKamar)),
                'harga' => $faker->numberBetween(150000, 600000),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
