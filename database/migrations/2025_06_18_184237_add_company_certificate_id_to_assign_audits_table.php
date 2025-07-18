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
        Schema::table('assign_audits', function (Blueprint $table) {
            $table->unsignedBigInteger('company_certificate_id')->nullable();
            $table->foreign('company_certificate_id')->references('id')->on('company_certifications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assign_audits', function (Blueprint $table) {
            $table->dropColumn('company_certificate_id');
        });
    }
};
