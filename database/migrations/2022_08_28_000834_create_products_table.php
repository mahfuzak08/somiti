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
            $table->string('barcode');
            $table->string('name');
            $table->string('img')->nullable();
            $table->string('folder')->nullable();
            $table->integer('is_active')->default(1);
            $table->foreignId('category_id')->default(1);
            $table->integer('quantity')->default(1);
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('unit')->nullable();
            $table->string('price')->default(1);
            $table->string('details')->nullable();
            $table->foreignId('brand_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
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
