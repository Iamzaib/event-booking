<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTicketsTable extends Migration
{
    public function up()
    {
        Schema::create('event_tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ticket_title');
            $table->date('ticket_date');
            $table->decimal('ticket_price', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
