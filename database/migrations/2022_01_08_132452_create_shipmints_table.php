<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->integer('status_id');
            $table->date('date');
            $table->string('shipper_id');
            $table->integer('customer_id');
            $table->string('description');
            $table->integer('rate_id');
            $table->string('consignee');
            $table->string('courier');
            $table->integer('courier_id');
            $table->string('pieces');
            $table->string('weight');
            $table->string('volume');
            $table->string('tracking_number');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('prealert', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('shipper_id');
            $table->string('description');
            $table->string('courier _id');
            $table->string('itemcost');
            $table->string('weight');
            $table->string('tracking_number');
            $table->integer('customer_id');
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
        Schema::dropIfExists('shipments');
        Schema::dropIfExists('prealert');
    }
}
