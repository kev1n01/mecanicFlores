<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('code')->unique()->nullable();
            $table->string('name')->unique();
            $table->integer('stock')->default(0);
            $table->string('image',2048)->nullable();
            $table->float('sale_price');
            $table->float('purchase_price');
            $table->string('unit')->nullable();
            $table->integer('product_status_id')->default(1);

            //aplicar una llave foranea en category_products->id
            $table->unsignedBigInteger('category_product_id');
            $table->foreign('category_product_id')->references('id')->on('category_products');

            $table->unsignedBigInteger('brand_product_id');
            $table->foreign('brand_product_id')->references('id')->on('brand_products');

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
