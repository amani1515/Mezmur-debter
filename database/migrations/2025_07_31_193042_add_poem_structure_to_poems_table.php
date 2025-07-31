<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('poems', function (Blueprint $table) {
            $table->json('structure')->nullable()->after('body');
            $table->boolean('is_structured')->default(false)->after('structure');
        });
    }

    public function down(): void
    {
        Schema::table('poems', function (Blueprint $table) {
            $table->dropColumn(['structure', 'is_structured']);
        });
    }
};