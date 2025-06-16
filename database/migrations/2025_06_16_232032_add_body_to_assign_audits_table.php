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
            $table->unsignedBigInteger('certification_body_id')->nullable();
            $table->foreign('certification_body_id')->references('id')->on('certification_bodies')->onDelete('cascade');
            $table->boolean('completed')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assign_audits', function (Blueprint $table) {
            $table->dropColumn('certification_body_id');
            $table->dropColumn('completed');
        });
    }
};
