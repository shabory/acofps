<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDiplomasTable extends Migration
{
    public function up()
    {
        Schema::table('diplomas', function (Blueprint $table) {
            $table->unsignedBigInteger('trainer_id')->nullable();
            $table->foreign('trainer_id', 'trainer_fk_6260184')->references('id')->on('users');
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id', 'country_fk_6260189')->references('id')->on('countries');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id', 'city_fk_6260190')->references('id')->on('cities');
            $table->unsignedBigInteger('speclization_id')->nullable();
            $table->foreign('speclization_id', 'speclization_fk_6260193')->references('id')->on('specializations');
        });
    }
}
