<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( ! Schema::hasTable('message_views') )
        {
            Schema::create('message_views', function (Blueprint $table) {
                $table->increments('MessageViewID');
                $table->integer('MessageID')->unsigned();
                $table->integer('ViewerID')->unsigned();
                $table->integer('MessageStatusID')->unsigned();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if( Schema::hasTable('messages') )
        {
            Schema::table('message_views', function(Blueprint $table) {
                $table->foreign('MessageID')->references('MessageID')->on('messages');
            });
        }

        if( Schema::hasTable('users') )
        {
            Schema::table('message_views', function(Blueprint $table) {
                $table->foreign('ViewerID')->references('id')->on('users');
            });
        }

        if( Schema::hasTable('message_status') )
        {
            Schema::table('message_views', function(Blueprint $table) {
                $table->foreign('MessageStatusID')->references('MessageStatusID')->on('message_status');
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
        Schema::dropIfExists('message_views');
    }
}
