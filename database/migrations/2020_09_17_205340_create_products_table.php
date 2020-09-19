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
            $table->bigIncrements('id');
            $table->integer('status')           ->nullable();
            $table->string('name', 128)         ->nullable();
            $table->string('slug')              ->unique()->nullable();
            $table->integer('category_id')      ->nullable();
            $table->string('file')              ->nullable();
            $table->decimal('price', 11,2)      ->nullable();
            $table->integer('in_discount')      ->nullable();
            $table->integer('discount')         ->nullable();
            $table->text('content')             ->nullable();
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
