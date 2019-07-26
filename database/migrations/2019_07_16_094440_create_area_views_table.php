<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_views', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('accessId');
            $table->foreign('accessId')->references('id')->on('access_areas');
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
        Schema::dropIfExists('area_views');
    }
}
