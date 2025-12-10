<?php

namespace App\Filament\Resources\Comments\Tables;

use App\Filament\Resources\Features\FeatureResource;
use App\Filament\Resources\Features\Pages\ViewFeature;
use App\Filament\Resources\Features\RelationManagers\CommentsRelationManager;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CommentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->searchable(),
                TextColumn::make('body')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('feature.name')
                    ->hiddenOn([CommentsRelationManager::class])
                    ->searchable(),
                IconColumn::make('is_approved')
                    ->label('Approved')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
//                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
