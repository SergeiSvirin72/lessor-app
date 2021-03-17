<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_room', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->comment('Идентификатор помещения');
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->integer('price_square_foot')->comment('Цена помещения за квадратный метр');
            $table->date('moved_at')->useCurrent()->comment('Когда арендатор заехал в помещение');
            $table->date('pay_start')->useCurrent()->comment('Дата начала расчетного периода');
            $table->date('paid_till')->nullable()->comment('До какого числа оплачена аренда');
            $table->foreignId('contract_id')->comment('Идентификатор договора');
            $table->foreign('contract_id')->references('id')->on('contracts');
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
        Schema::dropIfExists('contract_room');
    }
}
