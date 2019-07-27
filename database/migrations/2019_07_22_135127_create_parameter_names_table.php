<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParameterNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parameter_names', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
        });

        DB::table('parameter_names')->insert(
            array(
                'name' => 'System-Inputs And Processes'
            )
        );
        DB::table('parameter_names')->insert(
            array(
                'name' => 'Implementation'
            )
        );
        DB::table('parameter_names')->insert(
            array(
                'name' => 'Outcomes'
            )
        );
        DB::table('parameter_names')->insert(
            array(
                'name' => 'Best Practices'
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
        Schema::dropIfExists('parameter_names');
    }
}
