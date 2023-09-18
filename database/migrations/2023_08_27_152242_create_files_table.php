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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('notice_id')->nullable();
            $table->unsignedBigInteger('project_report_id')->nullable();
            $table->string('filename');
            $table->timestamps();

            $table->foreign('notice_id')->references('id')->on('notices')->onDelete('cascade');
            $table->foreign('project_report_id')->references('id')->on('project_reports')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
