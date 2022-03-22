<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCitiesTable extends Migration
{
    public function up()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->unsignedBigInteger('countryid_id')->nullable();
            $table->foreign('countryid_id', 'countryid_fk_6258066')->references('id')->on('countries');
        });
    }
}
