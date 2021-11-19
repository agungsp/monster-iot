<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNodeDeviceToContracts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->boolean('use_base')->default(true);
            $table->boolean('use_door')->default(true);
            $table->boolean('use_load')->default(true);
            $table->boolean('use_rfid')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn('use_base');
            $table->dropColumn('use_door');
            $table->dropColumn('use_load');
            $table->dropColumn('use_rfid');
        });
    }
}
