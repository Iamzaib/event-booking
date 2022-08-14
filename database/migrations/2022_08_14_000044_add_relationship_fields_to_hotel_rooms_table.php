<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToHotelRoomsTable extends Migration
{
    public function up()
    {
        Schema::table('hotel_rooms', function (Blueprint $table) {
            $table->unsignedBigInteger('hotel_id')->nullable();
            $table->foreign('hotel_id', 'hotel_fk_7150412')->references('id')->on('hotels');
        });
    }
}
