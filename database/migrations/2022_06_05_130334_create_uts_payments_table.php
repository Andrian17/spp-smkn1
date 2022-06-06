<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtsPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uts_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id');
            $table->string('order_id');
            $table->bigInteger('nominal_pembayaran');
            $table->string("jenis_pembayaran")->default('mid-semester');
            $table->enum('status_pembayaran', ['pending', 'success', 'failed'])->default('pending');
            $table->string("snap_token")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uts_payments');
    }
}
