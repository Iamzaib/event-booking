<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestimonialsTable extends Migration
{
    public function up()
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('review_text')->nullable();
            $table->string('ratings');
            $table->date('review_date');
            $table->boolean('featured')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
