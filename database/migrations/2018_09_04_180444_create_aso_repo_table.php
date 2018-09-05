<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsoRepoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aso_repo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('asobikata_id');
            $table->integer('user_id');
            $table->text('content');
            $table->integer('status')->default(1);
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aso_repo');
    }
}
