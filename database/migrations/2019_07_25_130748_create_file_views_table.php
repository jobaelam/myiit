<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_views', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fileId');
            $table->foreign('fileId')->references('id')->on('files');
            $table->unsignedBigInteger('viewType');
            $table->foreign('viewType')->references('id')->on('view_types');
            $table->unsignedBigInteger('user');
            $table->foreign('user')->references('id')->on('users');
            $table->boolean('isApproved')->default(false);
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
        Schema::dropIfExists('file_views');
    }
}
