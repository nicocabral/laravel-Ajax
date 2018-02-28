<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('contracts')){
          Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contractid');
            $table->string('customerid');
            $table->string('name');
            $table->date('startdate');
            $table->date('enddate');
            $table->double('subtotal');
            $table->double('tax');
            $table->double('total');
            $table->integer('status');
            $table->string('paymentitem');
            $table->integer('contractfrequency');
            $table->integer('retryprocessing');
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
        Schema::dropIfExists('contracts');
    }
}
