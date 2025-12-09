<?php

namespace App\Models;

use App\Enums\Feature\FeatureStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Feature extends Model
{
    /** @use HasFactory<\Database\Factories\FeatureFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'status' => FeatureStatus::class,
            'milestones' => 'array',
        ];
    }
}
