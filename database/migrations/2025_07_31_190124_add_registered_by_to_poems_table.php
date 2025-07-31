<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('poems', function (Blueprint $table) {
            $table->string('registered_by')->nullable()->after('author');
        });
    }

    public function down(): void
    {
        Schema::table('poems', function (Blueprint $table) {
            $table->dropColumn('registered_by');
        });
    }
};