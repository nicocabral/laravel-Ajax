<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('user_logs')){
          Schema::create('user_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userid');
            $table->string('user_name');
            $table->string('action');
            $table->string('details');
            $table->string('others');
            $table->timestamps();
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
        Schema::dropIfExists('user_logs');
    }
}
