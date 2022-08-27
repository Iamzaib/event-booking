<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTestimonialsTable extends Migration
{
    public function up()
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_7212424')->references('id')->on('users');
            $table->unsignedBigInteger('event_trip_booking_id')->nullable();
            $table->foreign('event_trip_booking_id', 'event_trip_booking_fk_7212425')->references('id')->on('event_bookings');
        });
    }
}
