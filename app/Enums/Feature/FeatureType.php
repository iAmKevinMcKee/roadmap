<?php

namespace App\Enums\Feature;

use App\Enums\Traits\UseValueAsLabel;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum FeatureType: string implements HasLabel, HasColor, HasIcon
{
    use UseValueAsLabel;

    case Feature = 'Feature';
    case Bug = 'Bug';

    public function getColor(): string|array|null
    {
        return match($this) {
            FeatureType::Feature => 'info',
            FeatureType::Bug => 'warning',
        };
    }

    public function getIcon(): string|null
    {
        return match ($this) {
            self::Feature => 'heroicon-o-star',
            self::Bug => 'heroicon-o-bug-ant',
        };
    }
}
