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
        Schema::create('setoran_sampah', function (Blueprint $table) {
            $table->id();
            $table->decimal('weight_kg', 8, 2);
            $table->integer('points_earned')->default(0);
            $table->dateTime('collection_date')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Foreign keys
            $table->foreignId('nasabah_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('operator_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kategori_sampah_id')->constrained('kategori_sampah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setoran_sampah');
    }
};
