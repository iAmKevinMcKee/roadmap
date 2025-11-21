<?php

namespace App\Enums\Traits;

use Illuminate\Contracts\Support\Htmlable;

trait UseValueAsLabel
{
    public function getLabel(): string|Htmlable|null
    {
        return $this->value;
    }
}
