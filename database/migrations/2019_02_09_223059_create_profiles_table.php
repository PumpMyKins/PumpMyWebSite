<?php

use Illuminate\Support\Facades\Schema;
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
        Schema::create('profiles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('prenom', 50)->nullable();
            $table->string('nom', 50)->nullable();
            $table->string('adresse', 255)->nullable();
            $table->string('ville')->nullable();
            $table->Integer('zipcode')->nullable();
            $table->string('country')->nullable();
            $table->string('image')->nullable();
            $table->text('bio')->nullable();
            $table->boolean('stat_privacy')->default(true);
            $table->boolean('privacy')->default(false);
            $table->unsignedInteger('user_id');
            $table->boolean('minecraft_link')->default(false);
            $table->boolean('discord_link')->default(false);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('profiles');
    }
}
