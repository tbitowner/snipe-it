<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageRecipientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_recipient', function (Blueprint $table) {
            $table->increments('MessageRecipientID');
            $table->integer('MessageID')->unsigned();
            $table->integer('RecipientID')->unsigned();
            $table->integer('GroupRecipientID')->unsigned();
            $table->integer('createdby')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        if( Schema::hasTable('users') )
        {
            Schema::table('message_recipient', function(Blueprint $table) {
                $table->foreign('createdby')->references('id')->on('users');
                $table->foreign('RecipientID')->references('id')->on('users');
            });
        }

        if( Schema::hasTable('messages') )
        {
            Schema::table('message_recipient', function(Blueprint $table) {
                $table->foreign('MessageID')->references('MessageID')->on('messages');
            });
        }

        if( Schema::hasTable('groups') )
        {
            Schema::table('message_recipient', function(Blueprint $table) {
                $table->foreign('GroupRecipientID')->references('id')->on('groups');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message_recipient');
    }
}
