<?php

namespace App\Filament\Resources\Votes;

use App\Filament\Resources\Votes\Pages\CreateVote;
use App\Filament\Resources\Votes\Pages\EditVote;
use App\Filament\Resources\Votes\Pages\ListVotes;
use App\Filament\Resources\Votes\Schemas\VoteForm;
use App\Filament\Resources\Votes\Tables\VotesTable;
use App\Models\Vote;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class VoteResource extends Resource
{
    protected static ?string $model = Vote::class;
    protected static ?int $navigationSort = 3;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHandThumbUp;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return VoteForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VotesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVotes::route('/'),
            'create' => CreateVote::route('/create'),
            'edit' => EditVote::route('/{record}/edit'),
        ];
    }
}
