<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelRoomsTable extends Migration
{
    public function up()
    {
        Schema::create('hotel_rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('room_title');
            $table->longText('details')->nullable();
            $table->decimal('room_price', 15, 2);
            $table->string('room_capacity');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
