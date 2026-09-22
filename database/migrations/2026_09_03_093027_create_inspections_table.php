<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            $table->foreignId('inspected_by')->nullable()->constrained('users')->onDelete('set null');
            $table->date('inspection_date');
            $table->date('expiry_date');
            $table->string('certificate_number')->nullable();
            $table->enum('status', ['valid', 'expired', 'pending'])->default('pending');
            $table->string('certificate_file')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};
