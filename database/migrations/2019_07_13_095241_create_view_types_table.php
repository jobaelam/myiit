<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('view_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
        });

        DB::table('view_types')->insert(
            array(
                'name' => 'Private'
            )
        );

        DB::table('view_types')->insert(
            array(
                'name' => 'Member'
            )
        );

        DB::table('view_types')->insert(
            array(
                'name' => 'Specific to'
            )
        );

        DB::table('view_types')->insert(
            array(
                'name' => 'Department Only'
            )
        );

        DB::table('view_types')->insert( array( 'name' => 'Public' ) ); }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_types');
    }
}
