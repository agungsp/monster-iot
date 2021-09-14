<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTelegramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_telegrams', function (Blueprint $table) {
            $table->id();
            $table->string('chat_id')->unique();
            $table->unsignedBigInteger('user_id')->index();
            $table->double('longitude', 10, 7)->nullable();
            $table->double('latitude', 10, 7)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_telegrams');
    }
}
