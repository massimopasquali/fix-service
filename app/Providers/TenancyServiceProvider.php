<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Stancl\Tenancy\Events;
use Stancl\Tenancy\Jobs;

class TenancyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Tenant creato → Crea il database + esegue le migrazioni tenant
        Event::listen(Events\TenantCreated::class, function (Events\TenantCreated $event) {
            $tenant = $event->tenant;

            Jobs\CreateDatabase::dispatchSync($tenant);
            Jobs\MigrateDatabase::dispatchSync($tenant);
        });

        // Tenant eliminato → Elimina il database
        Event::listen(Events\DeletingTenant::class, function (Events\DeletingTenant $event) {
            $tenant = $event->tenant;

            Jobs\DeleteDatabase::dispatchSync($tenant);
        });
    }
}
