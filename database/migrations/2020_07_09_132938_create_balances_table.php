<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->comment('Идентификатор арендатора');
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->tinyInteger('type')->default(1)->comment('Тип платежа: дебит, кредит');
            $table->unsignedInteger('amount')->comment('Сумма платежа');
            $table->foreignId('bill_id')->nullable()->comment('Идентификатор счета');
            $table->foreign('bill_id')->references('id')->on('bills');
            $table->tinyInteger('status')->default(1)->comment('Статус платежа');
            $table->text('comment')->nullable()->comment('Комментарий к платежу');
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
        Schema::dropIfExists('balances');
    }
}
