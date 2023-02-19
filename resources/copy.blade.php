<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name');
            $table->unsignedDouble('price', 8, 2)->default(0.00);
            $table->string('image');
            $table->integer('subcategory_id')->references('id')->on('subcategories')->unsigned();
            $table->integer('category_id')->references('id')->on('categories')->unsigned();

           // $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
           // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            // $table->integer('subcategory_id')->unsigned();
            // $table->integer('category_id')->unsigned();
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
};
