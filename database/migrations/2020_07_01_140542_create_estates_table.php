<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estates', function (Blueprint $table) {
            $table->id()->comment('Идентификатор объекта недвижимости');
            $table->string('name')->comment('Наименование объекта недвижимости');
            $table->text('info')->nullable()->comment('Информация об объекте');
            $table->string('address')->nullable()->comment('Адрес объекта');
            $table->string('longitude')->nullable()->comment('Долгота объекта');
            $table->string('latitude')->nullable()->comment('Широта объекта');
            $table->unsignedInteger('price_square_foot')->nullable()->comment('Цена за квадратный метр');
            $table->boolean('status')->default(0)->comment('Статус недвижимости');
            $table->foreignId('team_id')->comment('Идентификатор компании');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->string('mask')->nullable()->comment('Маска договоров');
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
        Schema::dropIfExists('estates');
    }
}
