<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomsTable extends Migration
{
    public function up()
    {
        Schema::create('zooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('zoomlink');
            $table->datetime('zoomtime');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
