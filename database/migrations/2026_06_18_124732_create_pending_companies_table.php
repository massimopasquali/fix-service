<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pending_companies', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_id')->unique();
            $table->string('company_name');
            $table->string('email');
            $table->string('vat_number');
            $table->text('address');
            $table->string('subdomain')->unique();
            $table->string('admin_name');
            $table->string('admin_password_hash');
            $table->string('stripe_session_id')->nullable();
            $table->string('plan')->default('monthly');
            $table->enum('status', ['pending', 'paid', 'failed', 'expired'])->default('pending');
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_companies');
    }
};
