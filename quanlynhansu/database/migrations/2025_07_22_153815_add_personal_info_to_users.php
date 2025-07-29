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
        Schema::table('users', function (Blueprint $table) {
            $table->string('cccd', 50)->after('birthday')->nullable();
            $table->string('bhxh', 50)->after('cccd')->nullable();
            $table->json('social')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('cccd');
            $table->dropColumn('bhxh');
            $table->dropColumn('social');
        });
    }
};
