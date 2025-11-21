<?php

namespace App\Enums\Feature;

use App\Enums\Traits\UseValueAsLabel;
use BackedEnum;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum FeatureStatus: string implements HasLabel, HasColor, HasIcon
{
    use UseValueAsLabel;

    case Proposed = 'Proposed';
    case Planned = 'Planned';
    case InProgress = 'In Progress';
    case Completed = 'Completed';
    case Cancelled = 'Cancelled';

    public function getColor(): string|array|null
    {
        return match($this) {
            FeatureStatus::Proposed => 'gray',
            FeatureStatus::Planned => 'info',
            FeatureStatus::InProgress => 'primary',
            FeatureStatus::Completed => 'success',
            FeatureStatus::Cancelled => 'danger',
        };
    }

    public function getIcon(): string|BackedEnum|Htmlable|null
    {
        return match ($this) {
            self::Proposed => 'heroicon-o-light-bulb',
            self::Planned => 'heroicon-o-calendar',
            self::InProgress => 'heroicon-o-cog',
            self::Completed => 'heroicon-o-check-circle',
            self::Cancelled => 'heroicon-o-x-circle',
        };
    }

}
