<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('number')->comment('Номер счета');
            $table->foreignId('contract_id')->comment('Идентификатор договора');
            $table->foreign('contract_id')->references('id')->on('contracts');
            $table->foreignId('tenant_id')->comment('Идентификатор арендатора');
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->foreignId('requisite_id')->nullable()->comment('Идентификатор реквизитов');
            $table->foreign('requisite_id')->references('id')->on('requisites');
            $table->boolean('status')->default(false)->comment('Статус счета');
            $table->integer('type')->comment('Тип счета');
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
        Schema::dropIfExists('bills');
    }
}
