<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chats', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->unsignedBigInteger('user1');
            $table->foreign('user1')->references('id')->on('users');
            $table->unsignedBigInteger('user2');
            $table->foreign('user2')->references('id')->on('users');
            $table->boolean('user1_is_typing')->default(false);
			$table->boolean('user2_is_typing')->default(false);
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
		Schema::drop('chats');
	}
}
