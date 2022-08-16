<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostumeCostumeAttributePivotTable extends Migration
{
    public function up()
    {
        Schema::create('costume_costume_attribute', function (Blueprint $table) {
            $table->unsignedBigInteger('costume_id');
            $table->foreign('costume_id', 'costume_id_fk_7112424')->references('id')->on('costumes')->onDelete('cascade');
            $table->unsignedBigInteger('costume_attribute_id');
            $table->foreign('costume_attribute_id', 'costume_attribute_id_fk_7112424')->references('id')->on('costume_attributes')->onDelete('cascade');
        });
    }
}
