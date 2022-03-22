<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCoursesTable extends Migration
{
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->unsignedBigInteger('trainer_id')->nullable();
            $table->foreign('trainer_id', 'trainer_fk_6260144')->references('id')->on('users');
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id', 'country_fk_6260149')->references('id')->on('countries');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id', 'city_fk_6260150')->references('id')->on('cities');
            $table->unsignedBigInteger('speclization_id')->nullable();
            $table->foreign('speclization_id', 'speclization_fk_6260174')->references('id')->on('specializations');
            $table->unsignedBigInteger('diploma_id')->nullable();
            $table->foreign('diploma_id', 'diploma_fk_6260342')->references('id')->on('diplomas');
        });
    }
}
