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
        Schema::create('user_assign_company', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_user_id'); // the user who assigns
            $table->unsignedBigInteger('company_user_id');  // the assigned user
            $table->timestamps();

            // Foreign keys
            $table->foreign('parent_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('company_user_id')->references('id')->on('users')->onDelete('cascade');

            // Prevent duplicate assignments
            $table->unique(['parent_user_id', 'company_user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_assign_company');
    }
};
