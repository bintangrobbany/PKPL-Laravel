<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Tambahkan kolom baru setelah 'sampul'
            $table->boolean('is_popular')->default(false)->after('sampul');
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Hapus kolom jika migrasi di-rollback
            $table->dropColumn('is_popular');
        });
    }
};