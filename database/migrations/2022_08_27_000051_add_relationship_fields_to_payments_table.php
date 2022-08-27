<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPaymentsTable extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_event_id')->nullable();
            $table->foreign('payment_event_id', 'payment_event_fk_7150346')->references('id')->on('events');
            $table->unsignedBigInteger('payment_user_id')->nullable();
            $table->foreign('payment_user_id', 'payment_user_fk_7150347')->references('id')->on('users');
            $table->unsignedBigInteger('payment_booking_id')->nullable();
            $table->foreign('payment_booking_id', 'payment_booking_fk_7150348')->references('id')->on('event_bookings');
        });
    }
}
