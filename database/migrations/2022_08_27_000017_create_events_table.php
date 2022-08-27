<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event_title')->nullable();
            $table->longText('overview')->nullable();
            $table->string('duration')->nullable();
            $table->string('age')->nullable();
            $table->decimal('daily_price', 15, 2);
            $table->longText('information')->nullable();
            $table->date('event_start');
            $table->date('event_end');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
