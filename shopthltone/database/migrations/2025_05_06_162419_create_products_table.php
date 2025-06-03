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
            $table->integer('product_catalogue_id')->default(0);
            $table->string('image')->nullable();
            $table->text('album')->nullable();
            $table->string('icon')->nullable();
            $table->integer('quantity')->default(0);
            $table->float('price', 30, 0)->default(0);
            $table->string('code')->default(0);
            $table->tinyInteger('publish')->default(1);
            $table->tinyInteger('follow')->default(1);
            $table->integer('order')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('attribute_type')->nullable(); //cot nay ko can thiet
            $table->text('attribute')->nullable();
            $table->text('variant')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
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
