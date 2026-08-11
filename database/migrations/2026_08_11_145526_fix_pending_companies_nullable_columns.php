<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pending_companies', function (Blueprint $table) {
            $table->string('tenant_id')->nullable()->change();
            $table->string('subdomain')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('pending_companies', function (Blueprint $table) {
            $table->string('tenant_id')->nullable(false)->change();
            $table->string('subdomain')->nullable(false)->change();
        });
    }
};
