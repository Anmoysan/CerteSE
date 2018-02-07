<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEventIdToCommentaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commentarys', function (Blueprint $table) {
            $table->integer('event_id')->unsigned()->after('id');
            $table->foreign('event_id')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commentarys', function (Blueprint $table) {
            $table->dropForeign('commentarys_event_id_foreign');
            $table->dropColumn('event_id');
        });
    }
}