<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_subject', function (Blueprint $table) {
            $table->integer('event_id')->unsigned();
            $table->integer('subject_id')->unsigned();

            // Definimos la clave principal
            $table->primary(['event_id', 'subject_id']);

            // Definimos las claves foráneas
            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('subject_id')->references('id')->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_subject');
    }
}
