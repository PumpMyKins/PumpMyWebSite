<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidature', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('name');
            $table->string('prenom');
            $table->Integer('age');
            $table->text('horaire');
            $table->text('motivation');
            $table->text('anciennete');
            $table->text('presentation');
            $table->string('sanction');
            $table->unsignedInteger('user_id');
            $table->string('state')->default("En attente");
            $table->boolean('status')->default(false);
            $table->string('upvote')->nullable();
            $table->string('downvote')->nullable();
            $table->string('slug')->unique();
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
        Schema::dropIfExists('candidatures');
    }
}
