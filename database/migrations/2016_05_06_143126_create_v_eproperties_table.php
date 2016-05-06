<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVEpropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v_eproperties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('element_id');
            $table->string('propertyName');
            $table->text('propertyValue');
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
        Schema::drop('v_eproperties');
    }
}
