<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('customer_contacts')){
        Schema::create('customer_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customerid');
            $table->string('d_phone')->nullable();
            $table->string('e_phone')->nullable();
            $table->string('m_phone')->nullable();
            $table->string('fax')->nullable();
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
        Schema::dropIfExists('customer_contacts');
    }
}
