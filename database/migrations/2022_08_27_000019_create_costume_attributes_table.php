<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostumeAttributesTable extends Migration
{
    public function up()
    {
        Schema::create('costume_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('values')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
