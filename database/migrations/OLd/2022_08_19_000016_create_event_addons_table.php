<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventAddonsTable extends Migration
{
    public function up()
    {
        Schema::create('event_addons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('addon_title');
            $table->string('addon_details')->nullable();
            $table->decimal('addon_price', 15, 2);
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
