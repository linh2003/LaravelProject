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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone', 20)->nullable();
            $table->text('image')->nullable();
            $table->dateTime('birthday')->nullable();
            $table->string('province_id',10)->nullable();
            $table->string('district_id',10)->nullable();
            $table->string('ward_id',10)->nullable();
            $table->text('address')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->decimal('salary', 20, 0)->nullable();
            $table->decimal('bonus', 20, 0)->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->integer('day_off_number')->nullable();
            $table->dateTime('day_of_join')->nullable();
            $table->dateTime('day_of_leave')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
