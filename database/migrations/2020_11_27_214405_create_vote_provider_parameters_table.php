<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoteProviderParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_provider_parameters', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('value', 255);
            $table->foreignId('vote_provider_id')->constrained('vote_providers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vote_provider_parameters');
    }
}
