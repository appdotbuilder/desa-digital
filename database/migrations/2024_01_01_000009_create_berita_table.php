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
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained('desa')->onDelete('cascade');
            $table->string('judul')->comment('News title');
            $table->text('konten')->comment('News content');
            $table->string('gambar')->nullable()->comment('News image');
            $table->foreignId('admin_input_id')->constrained('users')->onDelete('cascade');
            $table->enum('status_approve', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('approved_by_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('approved_at')->nullable()->comment('Approval date');
            $table->text('rejection_reason')->nullable()->comment('Reason for rejection');
            $table->boolean('is_published')->default(false)->comment('Published status');
            $table->timestamp('published_at')->nullable()->comment('Publication date');
            $table->timestamps();
            
            $table->index(['desa_id', 'status_approve']);
            $table->index(['desa_id', 'is_published', 'published_at']);
            $table->index('admin_input_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};