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
        Schema::table('pending_companies', function (Blueprint $table) {
            // Aggiungi company_id solo se non esiste
            if (!Schema::hasColumn('pending_companies', 'company_id')) {
                $table->foreignId('company_id')
                    ->nullable()
                    ->after('id')
                    ->constrained()
                    ->cascadeOnDelete();
            }

            // Aggiungi tenant_id solo se non esiste
            if (!Schema::hasColumn('pending_companies', 'tenant_id')) {
                $table->string('tenant_id')
                    ->nullable()
                    ->after('company_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pending_companies', function (Blueprint $table) {
            if (Schema::hasColumn('pending_companies', 'tenant_id')) {
                $table->dropColumn('tenant_id');
            }

            if (Schema::hasColumn('pending_companies', 'company_id')) {
                $table->dropForeign(['company_id']);
                $table->dropColumn('company_id');
            }
        });
    }
};
