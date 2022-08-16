<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEventBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('event_bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('booking_event_id')->nullable();
            $table->foreign('booking_event_id', 'booking_event_fk_7122776')->references('id')->on('events');
            $table->unsignedBigInteger('booking_by_user_id')->nullable();
            $table->foreign('booking_by_user_id', 'booking_by_user_fk_7122777')->references('id')->on('users');
        });
    }
}
