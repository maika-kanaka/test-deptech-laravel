<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Inout extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inout', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('type_inout', 3);
            $table->string('notes', 255)->nullable();
            $table->timestamps();
        });

        Schema::create('inout_detail', function(Blueprint $table)
        {
            $table->integer('id')->primaryKey();
            $table->integer('id_detail')->primaryKey();
            $table->integer('id_produk');
            $table->integer('qty');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inout');
        Schema::drop('inout_detail');
    }
}
