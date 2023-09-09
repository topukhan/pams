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
        Schema::create('phase2', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('examiner_1_mark', 5, 2)->nullable();
            $table->decimal('examiner_2_mark', 5, 2)->nullable();
            $table->decimal('examiner_3_mark', 5, 2)->nullable();
            $table->decimal('examiner_average', 5, 2)->nullable();
            $table->decimal('attendance', 5, 2)->nullable();
            $table->decimal('project_development', 5, 2)->nullable();
            $table->decimal('report_preparation', 5, 2)->nullable();
            $table->decimal('total', 5, 2)->default(0)->nullable(); // Default to 0
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phase2');
    }
};
