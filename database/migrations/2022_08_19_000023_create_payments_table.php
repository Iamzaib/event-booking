<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('amount_total', 15, 2);
            $table->decimal('amount_paid', 15, 2);
            $table->decimal('amount_balance', 15, 2)->nullable();
            $table->string('payment_method');
            $table->longText('payment_details')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
