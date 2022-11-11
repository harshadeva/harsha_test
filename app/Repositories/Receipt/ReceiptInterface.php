<?php

namespace App\Repositories\Receipt;

interface ReceiptInterface
{
    public function filter(array $filters) : object;
}
