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
        Schema::create('post_catalogues', function (Blueprint $table) {
            $table->id();
            $table->integer('parentid')->default(0);
            $table->integer('lft')->default(0);
            $table->integer('rgt')->default(0);
            $table->integer('level')->default(0);
            $table->text('thumbnail')->nullable();
            $table->text('image')->nullable();
            $table->text('album')->nullable();
            $table->tinyInteger('publish')->default(1);
            $table->integer('order')->default(1);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_catalogues');
    }
};
