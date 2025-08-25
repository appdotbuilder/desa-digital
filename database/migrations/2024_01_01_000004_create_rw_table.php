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
        Schema::create('rw', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained('desa')->onDelete('cascade');
            $table->string('nomor_rw', 10)->comment('RW number');
            $table->string('nama_rw')->nullable()->comment('RW name/area');
            $table->foreignId('ketua_rw_id')->nullable()->constrained('users')->onDelete('set null');
            $table->text('alamat')->nullable()->comment('RW address');
            $table->timestamps();
            
            $table->index(['desa_id', 'nomor_rw']);
            $table->unique(['desa_id', 'nomor_rw']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rw');
    }
};