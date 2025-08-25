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
        Schema::create('rt', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rw_id')->constrained('rw')->onDelete('cascade');
            $table->string('nomor_rt', 10)->comment('RT number');
            $table->string('nama_rt')->nullable()->comment('RT name/area');
            $table->foreignId('ketua_rt_id')->nullable()->constrained('users')->onDelete('set null');
            $table->text('alamat')->nullable()->comment('RT address');
            $table->timestamps();
            
            $table->index(['rw_id', 'nomor_rt']);
            $table->unique(['rw_id', 'nomor_rt']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rt');
    }
};