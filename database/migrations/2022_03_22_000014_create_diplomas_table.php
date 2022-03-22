<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiplomasTable extends Migration
{
    public function up()
    {
        Schema::create('diplomas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('type');
            $table->longText('descrption')->nullable();
            $table->float('price', 8, 2);
            $table->float('discount_price', 8, 2)->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('seo_title')->nullable();
            $table->longText('seo_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
