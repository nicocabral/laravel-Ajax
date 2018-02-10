<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('merchants')){
            Schema::create('merchants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userid');
            $table->string('name');
            $table->date('dob');
            $table->string('contact');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('role');
            $table->integer('permission');
            $table->integer('status');
            $table->timestamps();
            $table->datetime('deleted_at');
        }); 
        }
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchants');
    }
}
