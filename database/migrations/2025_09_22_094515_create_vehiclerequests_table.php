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
        Schema::create('vehiclerequests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requestor_id')->constrained('users')->onDelete('cascade');
            $table->string('activity_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('participants');
            $table->string('attachment')->nullable();
            $table->integer('days')->nullable();
            $table->foreignId('preferred_vehicle_id')->nullable()->constrained('vehicles')->onDelete('set null');

            // assignment by transport officer
            $table->enum('transport_mode', ['vehicle', 'taxi'])->default('vehicle');
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles')->nullOnDelete();
            $table->foreignId('driver_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('assigned_by')->nullable()->constrained('users')->nullOnDelete();

            // driver’s work ticket after activity
            $table->string('work_ticket')->nullable();
            $table->decimal('fare_cost', 10, 2)->nullable();
            $table->string('fare_receipt')->nullable();

            //refunds of fare
            $table->boolean('is_refunded')->default(false);
            $table->foreignId('refunded_by')->nullable()->constrained('users')->onDelete('set null');

            $table->enum('status', ['pending', 'approved', 'assigned', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiclerequests');
    }
};
