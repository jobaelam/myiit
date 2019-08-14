<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('areaId');
            $table->foreign('areaId')->references('id')->on('areas');
            $table->unsignedBigInteger('departmentId');
            $table->foreign('departmentId')->references('id')->on('departments');
            $table->unsignedBigInteger('head')->nullable();
            $table->foreign('head')->references('id')->on('users');
            $table->decimal('status',3,2)->default(0);
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
        Schema::dropIfExists('access_areas');
    }
}
