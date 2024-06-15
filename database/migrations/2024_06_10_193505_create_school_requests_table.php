<?php

use App\Enums\SchoolRequestStatus;
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
        Schema::create('school_requests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('request_code')->unique();
            $table->text('description');
            $table->string('status')->default(SchoolRequestStatus::Draft);
            
            $table->foreignId('level_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('department_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_requests');
    }
};
