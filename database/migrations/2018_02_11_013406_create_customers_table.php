<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('customers')){
             Schema::create('customers', function (Blueprint $table) {
             $table->increments('id');
             $table->string('customerid')->unique();
             $table->string('customercode')->unique();
             $table->integer('merchantid');
             $table->string('fname');
             $table->string('lname');
             $table->string('email')->unique();
             $table->integer('status');
             $table->timestamps();
             $table->datetime('deleted_at')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
