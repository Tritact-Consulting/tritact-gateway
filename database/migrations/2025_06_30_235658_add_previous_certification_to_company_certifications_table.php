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
            $table->unsignedBigInteger('previous_certification')->nullable();
            $table->foreign('previous_certification')->references('id')->on('company_certifications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_certifications', function (Blueprint $table) {
            $table->dropColumn('previous_certification');
        });
    }
};
