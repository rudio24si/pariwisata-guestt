<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DestinasiWisataSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Contoh kategori destinasi
        $namaDestinasi = [
            'Pantai',
            'Gunung',
            'Bukit',
            'Taman',
            'Air Terjun',
            'Hutan Wisata',
            'Danau',
            'Pulau',
            'Museum',
            'Monumen',
            'Kebun Raya',
            'Kampung Wisata',
            'Goa',
            'Waduk',
            'Taman Kota',
            'Gedung Bersejarah'
        ];

        for ($i = 0; $i < 100; $i++) {

            $kategori = $faker->randomElement($namaDestinasi);
            $nama = $kategori . ' ' . $faker->lastName();

            DB::table('destinasi_wisata')->insert([
                'nama'       => $nama,
                'deskripsi'  => $faker->sentence(20),
                'alamat'     => $faker->streetAddress(),
                'rt'         => $faker->numberBetween(1, 10),
                'rw'         => $faker->numberBetween(1, 10),
                'jam_buka'   => $faker->time('H:i'),
                'jam_tutup'  => $faker->time('H:i'),
                'tiket'      => $faker->numberBetween(5000, 50000),
                'kontak'     => '08' . $faker->numerify('##########'),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
