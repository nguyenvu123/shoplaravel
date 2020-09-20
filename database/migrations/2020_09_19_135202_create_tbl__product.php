<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl__product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->text('product_name');
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->text('product_des');
            $table->text('product_content');
            $table->string('product_price');
            $table->string('product_img');
            $table->integer('product_status');
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
        Schema::dropIfExists('tbl__product');
    }
}
