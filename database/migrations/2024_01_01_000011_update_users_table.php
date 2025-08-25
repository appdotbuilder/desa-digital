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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('desa_id')->nullable()->constrained('desa')->onDelete('cascade');
            $table->foreignId('rt_id')->nullable()->constrained('rt')->onDelete('set null');
            $table->enum('role', ['super_admin', 'village_admin', 'village_head', 'rw_chairman', 'rt_chairman', 'citizen'])->default('citizen');
            $table->string('phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->boolean('is_active')->default(true);
            
            $table->index(['desa_id', 'role']);
            $table->index(['desa_id', 'rt_id']);
            $table->index('role');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['desa_id']);
            $table->dropForeign(['rt_id']);
            $table->dropColumn(['desa_id', 'rt_id', 'role', 'phone', 'address', 'is_active']);
        });
    }
};