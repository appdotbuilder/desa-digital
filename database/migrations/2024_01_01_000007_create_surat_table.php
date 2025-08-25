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
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained('desa')->onDelete('cascade');
            $table->foreignId('warga_id')->constrained('warga')->onDelete('cascade');
            $table->foreignId('rt_id')->constrained('rt')->onDelete('cascade');
            $table->foreignId('rw_id')->constrained('rw')->onDelete('cascade');
            $table->foreignId('created_by_id')->constrained('users')->onDelete('cascade');
            $table->string('nomor_surat')->nullable()->comment('Letter number (generated)');
            $table->string('jenis_surat')->comment('Letter type');
            $table->text('keperluan')->comment('Purpose of the letter');
            $table->text('keterangan')->nullable()->comment('Additional information');
            $table->enum('input_type', ['online', 'manual'])->comment('Input method');
            $table->enum('status', ['draft', 'rt_approved', 'rw_approved', 'admin_process', 'village_head_approved', 'completed', 'rejected'])->default('draft');
            $table->string('dokumen_file')->nullable()->comment('Generated document file');
            $table->timestamp('submitted_at')->nullable()->comment('Submission date');
            $table->timestamp('completed_at')->nullable()->comment('Completion date');
            $table->timestamps();
            
            $table->index(['desa_id', 'status']);
            $table->index(['warga_id', 'status']);
            $table->index(['rt_id', 'status']);
            $table->index(['rw_id', 'status']);
            $table->index('created_by_id');
            $table->index('jenis_surat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
};