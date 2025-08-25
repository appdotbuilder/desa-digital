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
        Schema::create('galeri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained('desa')->onDelete('cascade');
            $table->string('judul')->comment('Gallery item title');
            $table->text('deskripsi')->nullable()->comment('Gallery item description');
            $table->enum('kategori', ['kegiatan', 'fasilitas', 'pembangunan', 'lainnya'])->comment('Gallery category');
            $table->string('file')->comment('File path');
            $table->string('file_type')->comment('File MIME type');
            $table->integer('file_size')->comment('File size in bytes');
            $table->foreignId('uploaded_by_id')->constrained('users')->onDelete('cascade');
            $table->boolean('is_active')->default(true)->comment('Gallery item status');
            $table->timestamps();
            
            $table->index(['desa_id', 'kategori']);
            $table->index(['desa_id', 'is_active', 'created_at']);
            $table->index('uploaded_by_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeri');
    }
};