<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->boolean('is_read')->default(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('contact', function (Blueprint $table) {
            $table->boolean('is_read')->default(null)->change();
        });
    }
};
