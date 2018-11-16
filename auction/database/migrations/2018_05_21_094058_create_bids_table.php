<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned()->index('FK_bids_products');
            $table->integer('customer_id')->unsigned()->index('FK_bids_customers');
            $table->integer('bid_quantity');
            $table->float('bid_price');
            $table->float('total_price');
            $table->timestamp('confirmed_date')->nullable();
            $table->string('reason')->nullable();
            $table->integer("status")->unsigned()->default(1); // 1: pending, 2: confirmed, 3: cancelled
            $table->timestamps();

            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onDelete('cascade');

            $table->foreign('customer_id')
                ->references('id')->on('customers')
                ->onDelete('cascade');

            //$table->foreign('customer_id')->references('id')->on('customers');


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
        Schema::dropIfExists('bids');
    }
}
