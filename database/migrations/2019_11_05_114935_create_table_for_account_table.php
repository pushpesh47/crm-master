<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableForAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('sales_agent')->nullable();
            $table->string('customer_number')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('alternate_mobile')->nullable();
            $table->string('date_of_injury')->nullable();
            $table->string('account_status')->nullable();
            $table->string('lead_source')->nullable();
            $table->string('injury_type')->nullable();
            $table->string('potential_defendant')->nullable();
            $table->string('date_of_injury_aware')->nullable();
            $table->string('lead_quality')->nullable();
            $table->string('facebook_injury_date')->nullable();
            $table->string('enquiry_type')->nullable();
            $table->string('panel_refrence')->nullable();
            $table->string('type_of_lead')->nullable();
            $table->string('date_lead_recieved')->nullable();
            $table->string('home_telephone_number')->nullable();
            $table->string('mobile_telephone_number')->nullable();
            $table->string('social_media_handle')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('call_transfer_time')->nullable();
            $table->string('call_back_time')->nullable();
            $table->string('call_back_date')->nullable();
            $table->enum('status',['active','inactive'])->default('active');
            
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
        Schema::dropIfExists('accounts');
    }
}
