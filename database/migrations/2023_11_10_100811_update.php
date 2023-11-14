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
        Schema::table('projects', function (Blueprint $table) {

            
            $table->longText('projectlink')->nullable();
            $table->longText('githublink')->nullable();

        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {

            // eseguo dropColumn per eliminare le 2 colonne dalla tabella

            $table->dropColumn('projectlink');
            
            $table->dropColumn('githublink');
        });
    }
};
