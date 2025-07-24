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
        Schema::create('consultation_summaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consultant_id');
            $table->foreign('consultant_id')->references('id')->on('consultants')->onDelete('cascade');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('certification_category_id');
            $table->foreign('certification_category_id')->references('id')->on('certification_categories')->onDelete('cascade');
            $table->unsignedBigInteger('certification_body_id');
            $table->foreign('certification_body_id')->references('id')->on('certification_bodies')->onDelete('cascade');
            $table->string('audit_type');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_summaries');
    }
};
