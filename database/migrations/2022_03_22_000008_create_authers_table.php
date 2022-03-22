<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthersTable extends Migration
{
    public function up()
    {
        Schema::create('authers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('bio')->nullable();
            $table->string('seo_title')->nullable();
            $table->longText('seo_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
