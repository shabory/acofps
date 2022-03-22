<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToForumCommentsTable extends Migration
{
    public function up()
    {
        Schema::table('forum_comments', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_6258602')->references('id')->on('users');
            $table->unsignedBigInteger('thread_id')->nullable();
            $table->foreign('thread_id', 'thread_fk_6258603')->references('id')->on('threads');
        });
    }
}
