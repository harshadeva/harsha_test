<?php

namespace App\Providers;

use App\Repositories\Invoice\InvoiceInterface;
use App\Repositories\Invoice\InvoiceRepository;
use App\Repositories\Patient\PatientInterface;
use App\Repositories\Patient\PatientRepository;
use App\Repositories\Receipt\ReceiptInterface;
use App\Repositories\Receipt\ReceiptRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PatientInterface::class, PatientRepository::class);
        $this->app->bind(InvoiceInterface::class, InvoiceRepository::class);
        $this->app->bind(ReceiptInterface::class, ReceiptRepository::class);
       
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
