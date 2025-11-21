<?php

namespace App\Filament\Resources\Features\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FeatureInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('status'),
                TextEntry::make('type'),
                TextEntry::make('description')
                    ->columnSpanFull(),
                TextEntry::make('effort_in_days')
                    ->numeric(),
                TextEntry::make('priority')
                    ->numeric(),
                TextEntry::make('cost')
                    ->money(),
                TextEntry::make('target_delivery_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('delivered_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
