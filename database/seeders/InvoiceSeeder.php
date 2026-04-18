<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Support\Str;

class InvoiceSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        Customer::chunk(1000, function ($customers) use ($faker) {

            foreach ($customers as $customer) {

                $invoice = Invoice::create([
                    'invoice_number' => 'INV-' . strtoupper(uniqid()),
                    'tanggal'        => now(),
                    'customer_id'    => $customer->id,
                    'pengirim'       => $faker->name,
                    'kota_asal'      => $faker->city,
                    'kota_tujuan'    => $faker->city,
                    'supir'          => $faker->name,
                    'no_polisi'      => strtoupper($faker->bothify('B #### ??')),
                    'created_by'     => 1,
                    'total'          => 0,
                ]);

                $totalInvoice = 0;
                $items = [];

                $itemCount = rand(1, 5);

                for ($i = 0; $i < $itemCount; $i++) {

                    $berat = rand(1, 50);
                    $ongkos = rand(2000, 10000);
                    $total = $berat * $ongkos;

                    $items[] = [
                        'id'            => Str::uuid(),
                        'invoice_id'    => $invoice->id,
                        'coli'          => rand(1, 10),
                        'code'          => strtoupper($faker->bothify('BRG###')),
                        'jenis_barang'  => $faker->word,
                        'berat'         => $berat,
                        'ongkos_per_kg' => $ongkos,
                        'total_ongkos'  => $total,
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ];

                    $totalInvoice += $total;
                }

                DB::table('invoice_items')->insert($items);

                $invoice->update([
                    'total' => $totalInvoice
                ]);
            }
        });
    }
}
