<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id()->comment('Идентификатор договора');
            $table->string('number')->comment('Номер договора');
            $table->date('date_start')->comment('Начало срока действия договора');
            $table->date('date_end')->comment('Окончание срока действия договора');
            $table->integer('security_payment')->nullable()->comment('Обеспечительный платеж арендатора');
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
        Schema::dropIfExists('contracts');
    }
}
