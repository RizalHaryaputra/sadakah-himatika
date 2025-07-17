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
        Schema::create('penukaran_poin', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique();
            $table->enum('status', ['diajukan', 'disetujui', 'ditolak'])->default('diajukan');
            $table->integer('points_used');
            $table->string('notes')->nullable();
            
            $table->timestamp('requested_at')->useCurrent();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('nasabah_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('hadiah_id')->constrained('hadiah');
            $table->foreignId('admin_id')->nullable()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penukaran_poins');
    }
};
