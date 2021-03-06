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
        // I know it could be normalized. But it's not even that important in the application.
        // The name could be easily be changed to "product_id" and this table be renamed to
        // bought products.

        // Normalization is overrated. If I bought 3 pairs of pink socks and someone renamed them
        // to red ponies, it wouln't change what I bought.
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('price');
            $table->bigInteger('note_id')->nullable();
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
        Schema::dropIfExists('products');
    }
}
