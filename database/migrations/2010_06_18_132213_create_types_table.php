<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
        });

        DB::table('types')->insert(
            array(
                'name' => 'Admin',
            )
        );

        DB::table('types')->insert(
            array(
                'name' => 'Dean',
            )
        );

        DB::table('types')->insert(
            array(
                'name' => 'Assistant Dean',
            )
        );

        DB::table('types')->insert(
            array(
                'name' => 'Chairperson',
            )
        );

        DB::table('types')->insert(
            array(
                'name' => 'Faculty',
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
        Schema::dropIfExists('types');
    }
}
