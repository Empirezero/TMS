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
        Schema::table('service_requests', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('previous_km')->nullable()->after('fuel_type');
            $table->string('service_station')->nullable()->after('assigned_driver');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_requests', function (Blueprint $table) {
            //
            Schema::table('service_requests', function (Blueprint $table) {
                $table->dropColumn(['previous_kms', 'service_station']);
            });
        });
    }
};
