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
        Schema::table('company_certifications', function (Blueprint $table) {
            $table->unsignedBigInteger('certification_body_id')->nullable();
            $table->foreign('certification_body_id')->references('id')->on('certification_bodies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_certifications', function (Blueprint $table) {
            $table->dropColumn('certification_body_id');
        });
    }
};
