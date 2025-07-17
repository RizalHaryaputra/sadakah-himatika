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
        Schema::table('users', function (Blueprint $table) {
            // Kode yang Anda berikan
            $table->integer('total_poin')->default(0)->after('password');
            $table->foreignId('padukuhan_id')->nullable()->after('total_poin')->constrained('padukuhan')->onDelete('set null');
            $table->string('phone_number')->nullable()->after('padukuhan_id');
            $table->string('address')->nullable()->after('phone_number');
            $table->string('profile_picture')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Untuk membatalkan migrasi (rollback)
            $table->dropForeign(['padukuhan_id']);
            $table->dropColumn(['total_poin', 'padukuhan_id', 'phone_number', 'address', 'profile_picture']);
        });
    }
};