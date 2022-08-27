<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingRoomsTable extends Migration
{
    public function up()
    {
        Schema::create('booking_rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('room_booking_rate', 15, 2);
            $table->date('booking_from');
            $table->date('booking_to');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
