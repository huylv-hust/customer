<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('email_id');
            $table->string('firstname', 25);
            $table->string('lastname', 25);
            $table->tinyInteger('address_1');
            $table->string('address_2', 100)->nullable();
            $table->string('address_3', 255)->nullable();
            $table->string('tel', 20);
            $table->string('card_number', 50);
            $table->string('postcode', 10)->nullable();
            $table->date('birth')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->tinyInteger('status');
            $table->softDeletes();
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
        Schema::drop('profiles');
    }
}
