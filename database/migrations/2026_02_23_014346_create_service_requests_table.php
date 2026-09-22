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
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            //Form Details
            $table->timestamp('request_date')->useCurrent();
            $table->string('reference_no')->unique();
            // Vehicle Details
            $table->string('reg_no');
            $table->string('make');
            $table->string('model');
            $table->string('engine_cc');
            $table->string('fuel_type');
            $table->integer('current_km');
            $table->string('assigned_driver');
            $table->enum('service_type', ['minor', 'major', 'other']);
            $table->text('service_type_other')->nullable();
            $table->text('description')->nullable();
            $table->boolean('vehicle_drivable');
            $table->boolean('warning_lights');
            $table->boolean('body_damage');
            $table->boolean('fluid_leaks');
            $table->enum('tyre_condition', ['good', 'worn', 'replace']);
            // Driver Declaration
            $table->string('driver_name');
            $table->mediumText('driver_signature')->nullable();
            $table->date('driver_date');

            // Approval
            $table->text('inspection_findings')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->mediumText('approver_signature')->nullable();
            $table->timestamp('approved_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};
