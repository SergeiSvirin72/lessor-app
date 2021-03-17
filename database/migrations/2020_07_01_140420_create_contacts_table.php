<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id()->comment('Идентификатор контактного лица');
            $table->string('name')->comment('Имя контактного лица');
            $table->string('phone')->comment('Телефон контактного лица');
            $table->string('email')->comment('Элетронная почта контактного лица');
            $table->foreignId('tenant_id')->comment('Идентификатор арендатора');
            $table->foreign('tenant_id')->references('id')->on('tenants');
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
        Schema::dropIfExists('contacts');
    }
}
