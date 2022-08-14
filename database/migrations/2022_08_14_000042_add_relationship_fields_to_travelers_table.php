<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTravelersTable extends Migration
{
    public function up()
    {
        Schema::table('travelers', function (Blueprint $table) {
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->foreign('booking_id', 'booking_fk_7150382')->references('id')->on('event_bookings');
        });
    }
}
