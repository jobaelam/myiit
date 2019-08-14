<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParameterViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parameter_views', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parameterId');
            $table->foreign('parameterId')->references('id')->on('parameters');
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
        Schema::dropIfExists('parameter_views');
    }
}
