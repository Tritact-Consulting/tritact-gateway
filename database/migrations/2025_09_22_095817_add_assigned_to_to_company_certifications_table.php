<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     public function up(): void
    {
        Schema::table('company_certifications', function (Blueprint $table) {
            // Add nullable foreign key column
            $table->unsignedBigInteger('assigned_to')->nullable()->after('previous_certification');

            // Foreign key reference to users table
            $table->foreign('assigned_to')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null'); // if the user is deleted, keep record but nullify
        });
    }

    public function down(): void
    {
        Schema::table('company_certifications', function (Blueprint $table) {
            $table->dropForeign(['assigned_to']);
            $table->dropColumn('assigned_to');
        });
    }
};
