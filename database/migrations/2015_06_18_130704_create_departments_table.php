<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('college_id');
            $table->foreign('college_id')->references('id')->on('colleges');
            $table->unsignedBigInteger('head')->nullable();
            //problem when migrate:fresh
            $table->foreign('head')->references('id')->on('users');
            $table->timestamps();
        });

        DB::table('departments')->insert(
            array(
                'name' => 'Department of Information Technology',
                'college_id' => '1'
            )
        );

        DB::table('departments')->insert(
            array(
                'name' => 'Department of Computer Science',
                'college_id' => '1'
            )
        );

        DB::table('departments')->insert(
            array(
                'name' => 'Electronics Engineering Technology',
                'college_id' => '1'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
