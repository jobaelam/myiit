<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileViewTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_view_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
        });

        DB::table('file_view_types')->insert(
            array(
                'name' => 'Private'
            )
        );

        DB::table('file_view_types')->insert(
            array(
                'name' => 'Public'
            )
        );

        DB::table('file_view_types')->insert(
            array(
                'name' => 'Department Only'
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
        Schema::dropIfExists('file_view_types');
    }
}
