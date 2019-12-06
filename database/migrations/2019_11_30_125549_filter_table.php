<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FilterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter_views', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('view_name')->nullable();
            $table->string('set_as_default')->nullable();
            $table->string('list_in_metrics')->nullable();
            $table->string('set_as_public')->nullable();
            $table->string('module_type')->nullable();
            $table->string('column_from')->nullable();
            $table->string('column_days')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->enum('filter_type',['standard','advance'])->default('standard');
            $table->enum('status',['active','inactive','pending'])->default('active');
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
        Schema::dropIfExists('filter_views');
    }
}
