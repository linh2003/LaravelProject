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
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('user_id')->nullable(); //id nhân sự
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
			$table->index(['user_id', 'created_at']);
			$table->unsignedBigInteger('license_type_term_id')->nullable(); //loại đơn xin gắn với id term
			$table->foreign('license_type_term_id')->references('id')->on('terms')->nullOnDelete();
			$table->index('license_type_term_id');
			$table->unsignedBigInteger('license_status_term_id')->nullable(); //tình trạng đơn xin gắn với id term
			$table->foreign('license_status_term_id')->references('id')->on('terms')->nullOnDelete();
			$table->index('license_status_term_id');
			$table->date('start_date'); //start_date
			$table->date('end_date')->nullable(); //end_date
			$table->index(['start_date', 'end_date']);
			$table->unsignedBigInteger('approver')->nullable(); //id người duyệt
            $table->foreign('approver')->references('id')->on('users')->nullOnDelete();
			$table->index('approver');
			$table->datetime('approved_at')->nullable(); //thời gian duyệt
			$table->text('reason_leave')->nullable(); //lý do nghỉ
			$table->text('reason_reject')->nullable(); //lý do nếu quản lý từ chối duyệt đơn
			$table->tinyInteger('license_unit')->nullable();//loại hình nghỉ(một ngày/nhiều ngày)
			$table->tinyInteger('license_duration')->nullable();//thời gian nghỉ(nửa buổi sáng/nửa buổi chiều/cả ngày)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licenses');
    }
};
