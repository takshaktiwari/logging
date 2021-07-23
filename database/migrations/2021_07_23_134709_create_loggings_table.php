<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoggingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loggings', function (Blueprint $table) {
            $table->id();
            $table->string('method')->default('GET');
            $table->string('url');
            $table->text('data')->nullable()->comment('json data');
            $table->string('remarks')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('user_ip')->nullable();
            $table->text('user')->nullable()->comment('json data');
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
        Schema::dropIfExists('loggings');
    }
}
