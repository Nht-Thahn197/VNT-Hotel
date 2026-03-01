<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('room', function (Blueprint $table) {
            if (!Schema::hasColumn('room', 'checkin_at')) {
                $table->dateTime('checkin_at')->nullable()->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('room', function (Blueprint $table) {
            if (Schema::hasColumn('room', 'checkin_at')) {
                $table->dropColumn('checkin_at');
            }
        });
    }
};
