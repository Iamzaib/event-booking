<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmenityHotelPivotTable extends Migration
{
    public function up()
    {
        Schema::create('amenity_hotel', function (Blueprint $table) {
            $table->unsignedBigInteger('hotel_id');
            $table->foreign('hotel_id', 'hotel_id_fk_7150439')->references('id')->on('hotels')->onDelete('cascade');
            $table->unsignedBigInteger('amenity_id');
            $table->foreign('amenity_id', 'amenity_id_fk_7150439')->references('id')->on('amenities')->onDelete('cascade');
        });
    }
}
