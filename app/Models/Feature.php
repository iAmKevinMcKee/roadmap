<?php

namespace App\Models;

use App\Enums\Feature\FeatureStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    /** @use HasFactory<\Database\Factories\FeatureFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'status' => FeatureStatus::class,
        ];
    }
}
