<?php

namespace App\Filament\Resources\Features\RelationManagers;

use App\Filament\Resources\Votes\VoteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class VotesRelationManager extends RelationManager
{
    protected static string $relationship = 'votes';

    protected static ?string $relatedResource = VoteResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
