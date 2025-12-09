<?php

namespace App\Filament\Resources\Features\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FeatureInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Feature Information')
                    ->columns(4)
                    ->columnSpanFull()
                    ->schema(self::getFeatureInformationSchema()),
                Section::make('Description')
                    ->description('Detailed description of the feature.')
                    ->columns(1)
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('description')
                            ->hiddenLabel()
                            ->html()
                            ->prose()
                            ->columnSpanFull(),
                    ]),
                Section::make('Milestones')
                    ->columns(1)
                    ->columnSpanFull()
                    ->schema([
                        RepeatableEntry::make('milestones')
                            ->hiddenLabel()
                            ->table([
                                RepeatableEntry\TableColumn::make('Title'),
                                RepeatableEntry\TableColumn::make('Due Date'),
                                RepeatableEntry\TableColumn::make('Is Completed'),
                            ])
                            ->schema([
                                TextEntry::make('title'),
                                TextEntry::make('due_date')
                                    ->date(),
                                IconEntry::make('is_completed')
                                    ->boolean(),
                            ])
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    private static function getFeatureInformationSchema(): array
    {
        return [
            TextEntry::make('name'),
            TextEntry::make('status')->badge(),
            TextEntry::make('type')->badge(),
            TextEntry::make('effort_in_days')
                ->numeric(),
            TextEntry::make('priority')
                ->numeric(),
            TextEntry::make('cost')
                ->money(),
            TextEntry::make('target_delivery_date')
                ->date()
                ->placeholder('N/A'),
            TextEntry::make('delivered_at')
                ->dateTime()
                ->placeholder('N/A'),
        ];
    }
}
