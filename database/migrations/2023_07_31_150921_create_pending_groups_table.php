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
        Schema::create('pending_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->json('members');
            $table->string('project_type');
            $table->string('domain');
            $table->integer('positive_status');
            $table->integer('member_feedback');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_groups');
    }
};
