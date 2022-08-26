<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBookingRoomsTable extends Migration
{
    public function up()
    {
        Schema::table('booking_rooms', function (Blueprint $table) {
            $table->unsignedBigInteger('room_id')->nullable();
            $table->foreign('room_id', 'room_fk_7212789')->references('id')->on('hotel_rooms');
            $table->unsignedBigInteger('booking_for_id')->nullable();
            $table->foreign('booking_for_id', 'booking_for_fk_7212790')->references('id')->on('event_bookings');
        });
    }
}
