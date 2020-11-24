<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbItemTiketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_item_tiket', function (Blueprint $table) {
            $table->bigIncrements('id_item');
            $table->unsignedBigInteger('id_tiket');
            $table->text('pesan');
            $table->string('gambar', 255);
            $table->enum('status', ['belum dilihat', 'dilihat', 'selesai']);
            $table->timestamps();

            $table->foreign('id_tiket')->references('id_tiket')->on('tb_tiket')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_item_tiket');
    }
}
