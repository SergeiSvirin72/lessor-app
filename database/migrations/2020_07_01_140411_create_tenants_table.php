<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id()->comment('Идентификатор арендатора');
            $table->foreignId('team_id')->comment('Идентификатор владельца недвижимости');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->string('inn')->comment('ИНН арендатора');
            $table->string('kpp')->nullable()->comment('КПП арендатора');
            $table->string('ogrn')->nullable()->comment('ОГРН арендатора');
            $table->string('status')->nullable()->comment('Статус арендатора');
            $table->string('full_name')->nullable()->comment('Полное наименование арендатора');
            $table->string('short_name')->nullable()->comment('Краткое наименование арендатора');
            $table->string('address')->nullable()->comment('Адрес арендатора');
            $table->string('okpo')->nullable()->comment('ОКПО арендатора');
            $table->string('okato')->nullable()->comment('ОКАТО арендатора');
            $table->string('oktmo')->nullable()->comment('ОКТМО арендатора');
            $table->string('okogu')->nullable()->comment('ОКОГУ арендатора');
            $table->string('okfs')->nullable()->comment('ОКФС арендатора');
            $table->text('document_full_name')->nullable();
            $table->string('document_short_name')->nullable();
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
        Schema::dropIfExists('tenants');
    }
}
