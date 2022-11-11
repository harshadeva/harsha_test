<?php

namespace App\Repositories\Invoice;

interface InvoiceInterface
{
    public function filter(array $filters) : object;
}
