<?php

namespace App\Livewire;

use App\Filament\Resources\Features\Schemas\FeatureForm;
use App\Mappers\ClickupTaskMapper;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ClickupTasksTable extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithSchemas;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        $tasks = Cache::remember('tasks_from_clickup', now()->addMinutes(5), function () {
            return Http::withHeaders([
                'Authorization' => 'pk_38346676_IWZEBXAVWDM5YDO258KY70CW9ZPIABHG',
                'accept' => 'application/json',
            ])->get('https://api.clickup.com/api/v2/list/901708324873/task')->json();
        });

        return $table
            ->records(function (?string $sortColumn, ?string $sortDirection, ?string $search) use ($tasks) {
                return ClickupTaskMapper::getCollectionOfFeatureAttributes($tasks)
                    ->when(
                        filled($sortColumn),
                        fn ($collection) => $collection->sortBy($sortColumn, SORT_REGULAR, $sortDirection === 'desc')
                    )
                    ->when(
                        filled($search),
                        fn ($collection) => $collection->filter(function ($item) use ($search) {
                            return str_contains(strtolower($item['name']), strtolower($search));
                        })
                    );
            })
            ->columns([
                TextColumn::make('name')
                    ->searchable(false)
                    ->sortable(),
                TextColumn::make('type')
                    ->badge(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('priority')
                    ->searchable(false)
                    ->sortable(false),
            ])
            ->columnManager(false)
            ->recordActions([
                Action::make('import_record_from_clickup')
                    ->label('Import')
                    ->schema(function (Schema $schema) {
                        return FeatureForm::configure($schema->model(\App\Models\Feature::class));
                    })
                    ->fillForm(function (array $record) {
                        return $record;
                    })
                    ->action(function (array $data) {
                        \App\Models\Feature::create($data);
                    })
                    ->color('success'),
            ]);
    }

    public function render()
    {
        return view('livewire.clickup-tasks-table');
    }
}
