<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class WargaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 100; $i++) {

            DB::table('warga')->insert([
                'no_ktp'        => $faker->nik(),
                'nama'          => $faker->name(),
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'agama'         => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
                'pekerjaan'     => $faker->jobTitle(),
                'telp'          => '08' . $faker->numerify('##########'),
                'email'         => $faker->unique()->safeEmail(),
                'created_at'    => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at'    => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
