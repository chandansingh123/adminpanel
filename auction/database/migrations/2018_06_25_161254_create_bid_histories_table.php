<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bid_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bid_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('bid_quantity');
            $table->float('bid_price');
            $table->float('total_price');
            $table->timestamp('confirmed_date')->nullable();
            $table->string('reason')->nullable();
            $table->integer("status")->unsigned()->default(1); // 1: pending, 2: confirmed, 3: cancelled
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
        Schema::dropIfExists('bid_histories');
    }
}
