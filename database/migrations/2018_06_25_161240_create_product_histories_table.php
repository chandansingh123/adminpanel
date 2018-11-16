<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('item_id')->unsigned();
            $table->timestamp('delivery_date')->nullable();
            $table->timestamp('closed_date')->nullable();
            $table->string('delivery_place')->nullable();
            $table->integer('offer_quantity');
            $table->integer('min_reserved_price');
            $table->boolean('status')->default(true); // 0: inactive, 1: active
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
        Schema::dropIfExists('product_histories');
    }
}
