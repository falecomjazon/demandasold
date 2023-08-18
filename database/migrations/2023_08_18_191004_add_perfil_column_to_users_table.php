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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('ce_perfil')->nullable();
            $table->string('st_cpf',14)->nullable();//->unique();
            $table->integer('ce_unidade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
           /*  if (Schema::hasColumn('users', 'email')) {
                // The "users" table exists and has an "email" column...
            } */
            $table->dropColumn('ce_perfil');
            $table->dropColumn('st_cpf');
            $table->dropColumn('ce_unidade');
        });
    }
};
