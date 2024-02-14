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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('teaser')->nullable();
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default('0')->nullable();
            $table->decimal('price', 8, 2);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('visibility')->default('0')->nullable();
            $table->dateTime('publish')->nullable();
            $table->integer('views')->default('0')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
