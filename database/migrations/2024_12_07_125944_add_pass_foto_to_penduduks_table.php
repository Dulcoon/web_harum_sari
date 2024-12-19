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
        Schema::table('penduduks', function (Blueprint $table) {
            $table->string('pass_foto')->nullable()->after('status_perkawinan');
        });
    }
    
    public function down()
    {
        Schema::table('penduduks', function (Blueprint $table) {
            $table->dropColumn('pass_foto');
        });
    }
    
};
