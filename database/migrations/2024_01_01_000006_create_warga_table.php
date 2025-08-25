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
        Schema::create('warga', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained('desa')->onDelete('cascade');
            $table->foreignId('rt_id')->constrained('rt')->onDelete('cascade');
            $table->string('nama')->comment('Citizen full name');
            $table->string('nik', 16)->comment('National ID number');
            $table->text('alamat')->comment('Citizen address');
            $table->string('tempat_lahir')->comment('Place of birth');
            $table->date('tanggal_lahir')->comment('Date of birth');
            $table->enum('jenis_kelamin', ['L', 'P'])->comment('Gender: L=Male, P=Female');
            $table->string('agama')->comment('Religion');
            $table->string('pekerjaan')->comment('Occupation');
            $table->string('pendidikan')->comment('Education level');
            $table->enum('status_perkawinan', ['belum_kawin', 'kawin', 'cerai_hidup', 'cerai_mati'])->comment('Marital status');
            $table->enum('status_keluarga', ['kepala_keluarga', 'istri', 'anak', 'menantu', 'cucu', 'orang_tua', 'mertua', 'keponakan', 'lainnya'])->comment('Family status');
            $table->string('no_kk', 16)->nullable()->comment('Family card number');
            $table->string('kk_file')->nullable()->comment('Family card file path');
            $table->string('ktp_file')->nullable()->comment('ID card file path');
            $table->string('telepon', 20)->nullable()->comment('Phone number');
            $table->string('email')->nullable()->comment('Email address');
            $table->boolean('is_active')->default(true)->comment('Citizen status');
            $table->timestamps();
            
            $table->index(['desa_id', 'nama']);
            $table->index(['desa_id', 'rt_id']);
            $table->index('nik');
            $table->index('jenis_kelamin');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warga');
    }
};