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
        Schema::create('desa', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->comment('Village name');
            $table->text('alamat')->comment('Village address');
            $table->string('kode_pos', 10)->nullable()->comment('Postal code');
            $table->string('telepon', 20)->nullable()->comment('Village phone');
            $table->string('email')->nullable()->comment('Village email');
            $table->string('paket_langganan')->default('basic')->comment('Subscription package');
            $table->integer('max_users')->default(50)->comment('Maximum users allowed');
            $table->integer('max_letters')->default(1000)->comment('Maximum letters per month');
            $table->bigInteger('max_storage')->default(1073741824)->comment('Maximum storage in bytes (1GB default)');
            $table->boolean('is_active')->default(true)->comment('Subscription status');
            $table->timestamp('subscription_expires_at')->nullable()->comment('Subscription expiry date');
            $table->timestamps();
            
            $table->index('is_active');
            $table->index('paket_langganan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desa');
    }
};