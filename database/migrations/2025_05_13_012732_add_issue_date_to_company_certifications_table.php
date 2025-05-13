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
            $table->string('certification_name')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('expire_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_certifications', function (Blueprint $table) {
            $table->dropColumn('certification_name');
            $table->dropColumn('issue_date');
            $table->dropColumn('expire_date');
        });
    }
};
