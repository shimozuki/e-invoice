<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        $total = 2000;
        $batchSize = 2000;

        for ($i = 0; $i < $total; $i += $batchSize) {

            $data = [];

            for ($j = 0; $j < $batchSize; $j++) {
                $data[] = [
                    'id' => Str::uuid(),
                    'nama_toko'    => $faker->company,
                    'nama_pemilik' => $faker->name,
                    'telepon'      => $faker->phoneNumber,
                    'alamat'       => $faker->address,
                    'kota'         => $faker->city,
                    'email'        => $faker->unique()->safeEmail,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ];
            }

            DB::table('customers')->insert($data);

            echo "Inserted: " . ($i + $batchSize) . PHP_EOL;
        }
    }
}
