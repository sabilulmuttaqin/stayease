<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePaymentStatusEnum extends Migration
{
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Ubah kolom enum untuk mengganti nilai yang diperbolehkan
            $table->enum('payment_status', ['done', 'not_yet'])->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Kembalikan ke nilai sebelumnya
            $table->enum('payment_status', ['done', 'not yet'])->nullable()->change();
        });
    }
}
