<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('cost');
            $table->enum('type',['university','faculty1','faculty2','faculty3','faculty4','faculty5','faculty6','faculty7','faculty8']);
            $table->enum('scope',['uii','prov','national','international']);
            $table->enum('category',['activity1','activity2','activity3','activity4','activity5','activity6','activity7','activity8'])->nullable();
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
        Schema::dropIfExists('activities');
    }
}
