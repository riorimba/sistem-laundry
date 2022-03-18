<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_outlet');
            $table->unsignedBigInteger('id_member');
            $table->unsignedBigInteger('id_paket');
            $table->double('qty');
            $table->date('tgl');
            $table->date('batas_waktu');
            $table->date('tgl_bayar')->nullable();
            $table->enum('status', ['proses', 'selesai', 'diambil']);
            $table->enum('dibayar', ['dibayar', 'belum_dibayar']);

            $table->foreign('id_outlet')->references('id')->on('outlets');
            $table->foreign('id_member')->references('id')->on('members');
            $table->foreign('id_paket')->references('id')->on('pakets');
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
        Schema::dropIfExists('transaksis');
    }
}
