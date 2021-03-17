<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id()->comment('Идентификатор помещения');
            $table->string('name')->comment('Название помещения');
            $table->unsignedInteger('size')->comment('Размер помещения');
            $table->unsignedInteger('price_square_foot')->nullable()->comment('Цена за квадратный метр');
            $table->foreignId('floor_id')->comment('Идентификатор плана объекта недвижимости');
            $table->foreign('floor_id')->references('id')->on('floors');
            $table->integer('type')->default(0)->comment('Тип помещения');
            $table->json('coordinates')->nullable()->comment('Координаты помещения на плане объекта недвижимости');
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
        Schema::dropIfExists('rooms');
    }
}
