<?php

namespace App\Core;

use App\Core\Interfaces\RedirectInterface;

class Redirect implements RedirectInterface
{
    public function __construct(public string $address = '/')
    {
    }

    public function redirect()
    {
        header("location: {$this->address}");
    }
}