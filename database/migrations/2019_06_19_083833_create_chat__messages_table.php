<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatMessagesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chat_messages', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->unsignedBigInteger('chat_id');
            $table->foreign('chat_id')->references('id')->on('chats');
            $table->BigInteger('sender_id');
            $table->text('message');
            $table->boolean('read')->default(false);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('chat_messages');
	}
}
