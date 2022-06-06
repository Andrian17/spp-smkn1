<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id');
            $table->string('order_id');
            $table->bigInteger('nominal_pembayaran');
            $table->enum("jenis_pembayaran", ["mid-semester", "akhir-semester"]);
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
        Schema::dropIfExists('payments');
    }
}
