<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGenreIdToBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('books', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->foreignId('genre_id')->nullable()->constrained()->nullOnDelete()->after('pages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('books', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->dropConstrainedForeignId('genre_id');
        });
    }
}
