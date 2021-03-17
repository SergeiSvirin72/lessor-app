<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFloorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('floors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estate_id')->comment('Идентификатор объекта недвижимости');
            $table->foreign('estate_id')->references('id')->on('estates');
            $table->string('name')->comment('Наименование плана');
            $table->string('img')->comment('Путь к изображению плана');
            $table->unsignedInteger('price_square_foot')->nullable()->comment('Цена за квадратный метр');
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
        Schema::dropIfExists('floors');
    }
}
