<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('merchant_users')){
            Schema::create('merchant_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userid');
            $table->integer('locationid')->nullable();
            $table->string('location_name')->nullable();
            $table->integer('branchid')->nullable();
            $table->string('branch_name')->nullable();
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
        Schema::dropIfExists('merchant_users');
    }
}
