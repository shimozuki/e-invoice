<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {

            $table->uuid('id')->primary();
            $table->string('invoice_number')->unique();
            $table->date('tanggal');
            $table->uuid('customer_id');
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->cascadeOnDelete();
            $table->string('kota_asal');
            $table->string('kota_tujuan');
            $table->string('supir')->nullable();
            $table->string('no_polisi')->nullable();

            $table->decimal('total', 15, 2)->default(0);

            $table->foreignId('created_by')
                ->constrained('users');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
