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
        Schema::create('assistances', function (Blueprint $table) {
            $table->id();
            $table->string('type_or_value');
            $table->date('date');
            $table->text('notes')->nullable();
            $table->string('proof_photo')->nullable();
            $table->foreignId('applicant_id')->constrained('applicants')->cascadeOnDelete();
            $table->foreignId('association_id')->nullable()->constrained('associations')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assistances');
    }
};
