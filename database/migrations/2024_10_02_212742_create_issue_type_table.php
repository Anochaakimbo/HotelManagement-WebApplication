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
        Schema::create('issue_type', function (Blueprint $table) {
            $table->char('idissue_type', 4)->primary();
            $table->string('issue_type_name', 45);
            $table->timestamps();
            $table->softDeletes(); // รองรับการลบแบบ soft delete
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issue_type');
    }
};
