<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('email');
            $table->string('no_absensi')->default('Adm_1')->after('username');
            $table->enum('role', ['user', 'admin'])->default('user')->after('no_absensi');
            $table->bigInteger('point')->default(0)->after('no_absensi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('no_absensi');
            $table->dropColumn('role');
            $table->dropColumn('point');
        });
    }
};
