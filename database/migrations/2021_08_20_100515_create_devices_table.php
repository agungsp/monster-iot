<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('alias')->nullable();
            $table->boolean('has_door1')->default(true);
            $table->enum('door1_state', ['Opened', 'Closed'])->nullable();
            $table->boolean('has_door2')->default(true);
            $table->enum('door2_state', ['Opened', 'Closed'])->nullable();
            $table->boolean('has_door_lock')->default(true);
            $table->enum('door_lock_state', ['Locked', 'Unlocked'])->nullable();
            $table->boolean('has_container_weight')->default(true);
            $table->double('container_weight_state', 11, 5)->nullable();
            $table->boolean('has_proximity')->default(true);
            $table->enum('proximity_state', ['Safe', 'Unsafe'])->nullable();
            $table->boolean('has_emergency_button')->default(true);
            $table->enum('emergency_button_state', ['Safe', 'Unsafe'])->nullable();
            $table->boolean('has_machine')->default(true);
            $table->enum('machine_state', ['On', 'Off'])->nullable();
            $table->boolean('has_driving_behavior')->default(true);
            $table->enum('driving_behavior_state', ['Stable', 'Unstable'])->nullable();
            $table->boolean('has_drowsiness')->default(true);
            $table->enum('drowsiness_state', ['Sleepy', 'Not Sleepy'])->nullable();
            $table->boolean('has_fuel_tank')->default(true);
            $table->enum('fuel_tank_state', ['Opened', 'Closed'])->nullable();
            $table->double('longitude', 10, 7)->nullable();
            $table->double('latitude', 10, 7)->nullable();
            $table->boolean('is_available')->default(true);
            $table->unsignedBigInteger('created_by')->index();
            $table->unsignedBigInteger('updated_by')->index();
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
        Schema::dropIfExists('devices');
    }
}
