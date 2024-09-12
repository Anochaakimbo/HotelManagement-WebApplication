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
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('water_units');
            $table->integer('electric_units');
            $table->decimal('room_price', 10, 2);
            $table->decimal('water_charge', 10, 2);
            $table->decimal('electric_charge', 10, 2);
            $table->decimal('total_charge', 10, 2);
            $table->enum('status', ['ส่งไปยังผู้ใช้แล้ว', 'รอชำระเงิน', 'รอยืนยัน', 'ชำระค่าห้องแล้ว'])->default('ส่งไปยังผู้ใช้แล้ว');
            $table->timestamps();
            $table->softDeletes();
        
            // สร้าง foreign key constraints
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billings');
    }
};
