<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('devices', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('rfids', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('contracts', function (Blueprint $table) {
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('devices', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('rfids', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('contracts', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
