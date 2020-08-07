<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDespesaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despesa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idusuario')->nullable();
            $table->string('nmdespesa', 256);
            $table->string('descricao',256);
            $table->float('valor');
            $table->date('data');
            $table->integer('status')->nullable();
            $table->timestamps();
            $table->foreign('idusuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('despesa');
    }
}
