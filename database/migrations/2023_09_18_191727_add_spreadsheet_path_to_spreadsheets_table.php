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
        Schema::table('spreadsheets', function (Blueprint $table) {
            $table->string('spreadsheet_path')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('spreadsheets', function (Blueprint $table) {
            $table->dropColumn('spreadsheet_path');
        });
    }
};
