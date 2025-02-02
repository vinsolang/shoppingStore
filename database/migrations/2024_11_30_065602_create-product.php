<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product', function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->decimal('regular_price',8,2);
            $table->decimal('sale_price',8,2);
            $table->integer('qty');
            $table->string('thumbnail');
            $table->integer('views');
            $table->string('color');
            $table->string('size');
            $table->longText('description');
            $table->integer('category_id');
            $table->integer('author_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
