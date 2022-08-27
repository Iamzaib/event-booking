<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventPackageAmenityPivotTable extends Migration
{
    public function up()
    {
        Schema::create('event_package_amenity', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id', 'event_id_fk_7216938')->references('id')->on('events')->onDelete('cascade');
            $table->unsignedBigInteger('package_amenity_id');
            $table->foreign('package_amenity_id', 'package_amenity_id_fk_7216938')->references('id')->on('package_amenities')->onDelete('cascade');
        });
    }
}
