<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('amount', 8, 2);
            $table->datetime('payment_time')->nullable();
            $table->string('payment_method');
            $table->string('payment_refrence')->nullable();
            $table->string('qeoud_registerd');
            $table->string('qeoud_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
