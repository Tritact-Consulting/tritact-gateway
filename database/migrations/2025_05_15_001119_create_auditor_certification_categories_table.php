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
        Schema::create('auditor_certification_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('auditor_id');
            $table->unsignedBigInteger('cer_cat_id');
            $table->foreign('auditor_id')->references('id')->on('auditors')->onDelete('cascade');
            $table->foreign('cer_cat_id')->references('id')->on('certification_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auditor_certification_categories');
    }
};
