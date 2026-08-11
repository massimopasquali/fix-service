<?php

namespace App\Services;

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Stancl\Tenancy\Contracts\Tenant as TenantContract;

class CustomTenantCreator
{
    protected array $pendingData = [];

    public function withPendingData(array $data): self
    {
        $this->pendingData = $data;
        return $this;
    }

    public function populateTenant(TenantContract $tenant): void
    {
        $tenant->run(function () {
            // Popola la tabella companies
            DB::table('companies')->insert([
                'name' => $this->pendingData['company_name'] ?? '',
                'email' => $this->pendingData['email'] ?? '',
                'vat_number' => $this->pendingData['vat_number'] ?? null,
                'address' => $this->pendingData['address'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Crea l'utente admin
            if (!empty($this->pendingData['admin_name'])) {
                DB::table('users')->insert([
                    'name' => $this->pendingData['admin_name'],
                    'email' => $this->pendingData['email'],
                    'password' => $this->pendingData['admin_password_hash'],
                    'role' => 'admin',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });
    }
}
