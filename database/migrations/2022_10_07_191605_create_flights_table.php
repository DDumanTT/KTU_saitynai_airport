<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('gate');
            $table->time('duration');
            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');
            $table->decimal('price');
            $table->foreignId('departure_id')->constrained('airports')->onDelete('cascade');
            $table->foreignId('arrival_id')->constrained('airports')->onDelete('cascade');
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
        Schema::dropIfExists('flights');
    }
};
