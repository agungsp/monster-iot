<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAliasStatusToContractDevice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contract_device', function (Blueprint $table) {
            $table->string('alias')->nullable();
            $table->enum('status', ['plugged', 'unplugged'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contract_device', function (Blueprint $table) {
            $table->dropColumn(['alias', 'status']);
        });
    }
}
