<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbKomentarTiketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_komentar_tiket', function (Blueprint $table) {
            $table->bigIncrements('id_komentar');
            $table->unsignedBigInteger('id_tiket');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_item');
            $table->text('pesan');
            $table->string('gambar', 255);
            $table->enum('status', ['belum dilihat', 'dilihat', 'selesai']);
            $table->timestamps();

            $table->foreign('id_tiket')->references('id_tiket')->on('tb_tiket')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_item')->references('id_item')->on('tb_item_tiket')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_komentar_tiket');
    }
}
