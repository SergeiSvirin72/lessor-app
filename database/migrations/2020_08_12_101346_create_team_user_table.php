<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('Идентификатор владельца недвижимости');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('team_id')->comment('Идентификатор компании');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->integer('role')->default(1)->comment('Должность пользователя');
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
        Schema::dropIfExists('team_user');
    }
}
