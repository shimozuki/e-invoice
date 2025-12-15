<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->enum('status_pembayaran', ['belum_lunas', 'lunas'])
                ->default('belum_lunas')
                ->after('total');

            $table->timestamp('paid_at')->nullable()->after('status_pembayaran');

            $table->foreignId('paid_by')
                ->nullable()
                ->after('paid_at')
                ->constrained('users');
        });
    }

    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn([
                'status_pembayaran',
                'paid_at',
                'paid_by'
            ]);
        });
    }
};
