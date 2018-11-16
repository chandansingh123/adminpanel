<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('item_id')->unsigned()->index('FK_products_items');
            $table->timestamp('delivery_date')->nullable();
            $table->timestamp('closed_date')->nullable();
            $table->string('delivery_place')->nullable();
            $table->integer('offer_quantity');
            $table->integer('min_reserved_price');
            $table->boolean('status')->default(true); // 0: inactive, 1: active
            $table->timestamps();

            $table->foreign('item_id')
                ->references('id')->on('items')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('products');
    }
}
