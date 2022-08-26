<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventHotelPivotTable extends Migration
{
    public function up()
    {
        Schema::create('event_hotel', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id', 'event_id_fk_7158241')->references('id')->on('events')->onDelete('cascade');
            $table->unsignedBigInteger('hotel_id');
            $table->foreign('hotel_id', 'hotel_id_fk_7158241')->references('id')->on('hotels')->onDelete('cascade');
        });
    }
}
