<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('billings', function (Blueprint $table) {
            $table->string('billing_slip')->nullable()->after('status'); // แทน 'some_column' ด้วยคอลัมน์ที่ต้องการให้ billing_slip อยู่หลังจากนั้น
        });
    }

    public function down()
    {
        Schema::table('billings', function (Blueprint $table) {
            $table->dropColumn('billing_slip');
        });
    }

};
