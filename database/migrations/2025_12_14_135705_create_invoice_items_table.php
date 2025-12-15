<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('invoice_id');

            $table->integer('coli')->nullable();
            $table->string('code')->nullable();
            $table->string('jenis_barang');
            $table->decimal('berat', 10, 2);
            $table->decimal('ongkos_per_kg', 15, 2);
            $table->decimal('total_ongkos', 15, 2);

            $table->timestamps();

            $table->foreign('invoice_id')
                ->references('id')
                ->on('invoices')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};
