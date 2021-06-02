<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserChange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->string('nama_belakang', 70)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin', 35)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->dropColumn('nama_belakang');
            $table->dropColumn('tanggal_lahir');
            $table->dropColumn('jenis_kelamin');
        });
    }
}
