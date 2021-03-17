<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->comment('Идентификатор компании');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->string('date')->comment('Дата проводки');
            $table->string('debet_account')->comment('Счет дебет');
            $table->string('credit_account')->comment('Счет кредит');
            $table->float('amount')->nullable()->comment('Сумма');
            $table->integer('document_number')->comment('Номер документа');
            $table->integer('vo')->comment('ВО');
            $table->unique(['document_number', 'vo']);
            $table->string('bank')->comment('Банк');
            $table->text('purpose')->comment('Назначение платежа');
            $table->boolean('status')->default(0)->comment('Статус назначения выписки');
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
        Schema::dropIfExists('statements');
    }
}
