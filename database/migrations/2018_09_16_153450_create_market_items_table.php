<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid');
            $table->integer('user_id');
            $table->integer('zipcode_id');
            $table->string('category');
            $table->string('title');
            $table->string('description', 2500)->nullable();
            $table->integer('amount')->nullable();
            $table->decimal('price');
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
        Schema::dropIfExists('market_items');
    }
}
