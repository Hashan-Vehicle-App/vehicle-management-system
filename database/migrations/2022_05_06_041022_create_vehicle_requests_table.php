<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->reference('id')->on('vehicles');
            $table->foreignId('pickup_location_id')->reference('id')->on('locations');
            $table->foreignId('deliver_location_id')->reference('id')->on('locations');
            $table->string('pickup_date');
            $table->float('cost');
            $table->enum('status', array('pending', 'approved', 'declined'))->default('pending');
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
        Schema::dropIfExists('vehicle_requests');
    }
}
