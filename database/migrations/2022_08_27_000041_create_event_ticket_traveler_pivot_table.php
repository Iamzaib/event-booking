<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTicketTravelerPivotTable extends Migration
{
    public function up()
    {
        Schema::create('event_ticket_traveler', function (Blueprint $table) {
            $table->unsignedBigInteger('traveler_id');
            $table->foreign('traveler_id', 'traveler_id_fk_7216919')->references('id')->on('travelers')->onDelete('cascade');
            $table->unsignedBigInteger('event_ticket_id');
            $table->foreign('event_ticket_id', 'event_ticket_id_fk_7216919')->references('id')->on('event_tickets')->onDelete('cascade');
        });
    }
}
