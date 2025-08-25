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
        Schema::create('surat_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_id')->constrained('surat')->onDelete('cascade');
            $table->string('status_from')->comment('Previous status');
            $table->string('status_to')->comment('New status');
            $table->foreignId('changed_by_id')->constrained('users')->onDelete('cascade');
            $table->text('catatan')->nullable()->comment('Status change notes');
            $table->timestamps();
            
            $table->index(['surat_id', 'created_at']);
            $table->index('changed_by_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_history');
    }
};