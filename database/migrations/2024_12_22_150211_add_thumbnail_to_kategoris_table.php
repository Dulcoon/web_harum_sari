<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('kategoris', function (Blueprint $table) {
            $table->string('thumbnail')->nullable(); // Tambahkan kolom thumbnail
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('kategoris', function (Blueprint $table) {
            $table->dropColumn('thumbnail'); // Hapus kolom thumbnail jika dibatalkan
        });
    }
};
