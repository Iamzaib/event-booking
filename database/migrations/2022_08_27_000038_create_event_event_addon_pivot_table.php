<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventEventAddonPivotTable extends Migration
{
    public function up()
    {
        Schema::create('event_event_addon', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id', 'event_id_fk_7216922')->references('id')->on('events')->onDelete('cascade');
            $table->unsignedBigInteger('event_addon_id');
            $table->foreign('event_addon_id', 'event_addon_id_fk_7216922')->references('id')->on('event_addons')->onDelete('cascade');
        });
    }
}
