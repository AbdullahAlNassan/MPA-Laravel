<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // totaal 8 digits, 2 na de komma (max 999,999.99 – ruim zat)
            $table->decimal('price', 8, 2)->nullable()->after('pages');
        });
    }
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('price');
        });
    }
};

