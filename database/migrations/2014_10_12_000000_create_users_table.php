<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('profile_image')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('dept_id');
            $table->foreign('dept_id')->references('id')->on('departments');
            $table->unsignedBigInteger('type');
            $table->foreign('type')->references('id')->on('types');
            $table->rememberToken();
            $table->timestamps();

        });

        DB::table('users')->insert(
            array(
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
                'dept_id' => '1',
                'type' => '1',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        //Information Technology
        DB::table('users')->insert(
            array(
                'first_name' => 'Lomesindo',
                'last_name' => 'Caparida',
                'email' => 'caparida@gmail.com',
                'password' => Hash::make('1234'),
                'dept_id' => '1',
                'type' => '2',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        DB::table('users')->insert(
            array(
                'first_name' => 'Mia Amor',
                'last_name' => 'Catindig',
                'email' => 'catindig@gmail.com',
                'password' => Hash::make('1234'),
                'dept_id' => '1',
                'type' => '4',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        DB::table('users')->insert(
            array(
                'first_name' => 'January',
                'last_name' => 'Febro',
                'email' => 'febro@gmail.com',
                'password' => Hash::make('1234'),
                'dept_id' => '1',
                'type' => '5',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        DB::table('users')->insert(
            array(
                'first_name' => 'Haron Hakeen',
                'last_name' => 'Lua',
                'email' => 'lua@gmail.com',
                'password' => Hash::make('1234'),
                'dept_id' => '1',
                'type' => '5',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        DB::table('users')->insert(
            array(
                'first_name' => 'Manuel',
                'last_name' => 'Cabido',
                'email' => 'cabido@gmail.com',
                'password' => Hash::make('1234'),
                'dept_id' => '1',
                'type' => '5',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );
        //Computer Studies
        DB::table('users')->insert(
            array(
                'first_name' => 'Renato',
                'last_name' => 'Crisostomo',
                'email' => 'crisostomo@gmail.com',
                'password' => Hash::make('1234'),
                'dept_id' => '2',
                'type' => '4',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        DB::table('users')->insert(
            array(
                'first_name' => 'Malikey',
                'last_name' => 'Maulana',
                'email' => 'maulana@gmail.com',
                'password' => Hash::make('1234'),
                'dept_id' => '2',
                'type' => '5',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        DB::table('users')->insert(
            array(
                'first_name' => 'Darlene Daryl',
                'last_name' => 'Obach',
                'email' => 'obach@gmail.com',
                'password' => Hash::make('1234'),
                'dept_id' => '2',
                'type' => '5',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        DB::table('users')->insert(
            array(
                'first_name' => 'Julieto',
                'last_name' => 'Perez',
                'email' => 'perez@gmail.com',
                'password' => Hash::make('1234'),
                'dept_id' => '2',
                'type' => '5',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        DB::table('users')->insert(
            array(
                'first_name' => 'Jennifer Joyce',
                'last_name' => 'Montemayor',
                'email' => 'montemayor@gmail.com',
                'password' => Hash::make('1234'),
                'dept_id' => '2',
                'type' => '5',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );
        //Electronics Engineering Tech
        DB::table('users')->insert(
            array(
                'first_name' => 'Antonio',
                'last_name' => 'Marajas',
                'email' => 'marajas@gmail.com',
                'password' => Hash::make('1234'),
                'dept_id' => '3',
                'type' => '4',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        DB::table('users')->insert(
            array(
                'first_name' => 'Rolando',
                'last_name' => 'Galucan',
                'email' => 'galucan@gmail.com',
                'password' => Hash::make('1234'),
                'dept_id' => '3',
                'type' => '5',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        DB::table('users')->insert(
            array(
                'first_name' => 'Alexander',
                'last_name' => 'Gaw',
                'email' => 'gaw@gmail.com',
                'password' => Hash::make('1234'),
                'dept_id' => '3',
                'type' => '5',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        DB::table('users')->insert(
            array(
                'first_name' => 'Ofelia',
                'last_name' => 'Mendoza',
                'email' => 'mendoza@gmail.com',
                'password' => Hash::make('1234'),
                'dept_id' => '3',
                'type' => '5',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        DB::table('users')->insert(
            array(
                'first_name' => 'Michael',
                'last_name' => 'Nabua',
                'email' => 'nabua@gmail.com',
                'password' => Hash::make('1234'),
                'dept_id' => '3',
                'type' => '5',
                'profile_image' => 'http://via.placeholder.com/150x150',
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
        Schema::dropIfExists('users');
    }
}
