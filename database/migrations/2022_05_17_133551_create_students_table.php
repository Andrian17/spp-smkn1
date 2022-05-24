<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('major_id');
            $table->foreignId('kelas_id');
            $table->string('nama', 100);
            $table->string('jenis_kelamin', 100);
            $table->bigInteger('nis');
            $table->string('no_hp');
            $table->integer('semester');
            $table->string('tanggal_lahir');
            $table->string('agama');
            $table->string('foto');
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
        Schema::dropIfExists('students');
    }
}
