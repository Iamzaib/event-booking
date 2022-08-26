<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('event_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('booking_details')->nullable();
            $table->decimal('booking_total', 15, 2)->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
