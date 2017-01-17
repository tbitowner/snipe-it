<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('MessageID');
            $table->integer('MessageTypeID')->unsigned();
            $table->integer('createdby')->unsigned();
            $table->string('message');
            $table->timestamps();
            $table->softDeletes();
        });
        
        if( Schema::hasTable('users') )
        {
            Schema::table('messages', function(Blueprint $table) {
                $table->foreign('createdby')->references('id')->on('users');
            });
        }

        if( Schema::hasTable('message_type') )
        {
            Schema::table('messages', function(Blueprint $table) {
                $table->foreign('MessageTypeID')->references('MessageTypeID')->on('message_type');
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
        Schema::dropIfExists('messages');
    }
}
