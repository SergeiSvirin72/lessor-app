<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_tenant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->comment('Идентификатор арендатора');
            $table->foreign('tenant_id')->references('id')->on('tenants');
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
        Schema::dropIfExists('contract_tenant');
    }
}
