<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisites', function (Blueprint $table) {
            $table->id()->comment('Идентификатор реквизитов');
            $table->string('name')->comment('Наименование');
            $table->string('inn')->comment('ИНН');
            $table->string('bik')->comment('БИК');
            $table->string('account')->comment('Номер счета');
            $table->foreignId('team_id')->comment('Идентификатор компании');
            $table->foreign('team_id')->references('id')->on('teams');
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
        Schema::dropIfExists('requisites');
    }
}
