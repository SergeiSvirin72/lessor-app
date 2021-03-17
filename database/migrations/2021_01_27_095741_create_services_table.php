<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bill_id')->comment('Идентификатор счета');
            $table->foreign('bill_id')->references('id')->on('bills');
            $table->string('name')->comment('Наименование услуги');
            $table->integer('quantity')->comment('Количество');
            $table->string('measure')->comment('Единица измерения');
            $table->float('price')->comment('Цена');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
