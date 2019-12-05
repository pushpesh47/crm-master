<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFilterViewDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter_view_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('filter_view_id')->nullable();
            $table->string('meta_key')->nullable();
            $table->string('meta_value')->nullable();
            $table->string('meta_name')->nullable();
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
        Schema::dropIfExists('filter_view_details');
    }
}
