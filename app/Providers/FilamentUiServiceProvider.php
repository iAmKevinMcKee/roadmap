<?php

namespace App\Providers;

use Filament\Actions\CreateAction;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\ServiceProvider;

class FilamentUiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // When a field has multiple words like "due_date", the label changes from "Due date" to "Due Date".
        \Filament\Forms\Components\Field::configureUsing(function (\Filament\Forms\Components\Field $field) {
            $field->label(function (\Filament\Schemas\Components\Component $component) {
                return str($component->getName())
                    ->afterLast('.')
                    ->kebab()
                    ->replace(['-', '_'], ' ')
                    ->ucwords();
            });

            $field->validationAttribute(function (\Filament\Schemas\Components\Component $component) {
                return $component->getLabel();
            });

            return $field;
        });

        // make selects searchable and preloaded by default
        \Filament\Forms\Components\Select::configureUsing(function (\Filament\Forms\Components\Select $field) {
            return $field
                ->searchable()
                ->preload();
        });

        // add sensible min and max so you don't end up with dates like 01/01/0000 or 01/01/3000
        \Filament\Forms\Components\DatePicker::configureUsing(function (\Filament\Forms\Components\DatePicker $datePicker) {
            return $datePicker
                ->minDate(\Illuminate\Support\Carbon::createFromDate(1500, 1, 1))
                ->maxDate(now()->addYears(30));
        });

        // US based phone input, adjust for different countries
        \Filament\Forms\Components\TextInput::macro('phone', function () {
            return $this->mask('(999) 999-9999')
                ->prefixIcon('heroicon-o-phone')
                ->tel()
                ->minLength(14)
                ->maxLength(14)
                ->validationMessages([
                    'min' => 'Please enter a valid phone number including area code.',
                ]);
        });

        // if an action is a modal, do not close by clicking away and default to slideover
        \Filament\Actions\Action::configureUsing(function (\Filament\Actions\Action $action) {
            $action
                ->closeModalByClickingAway(false)
                ->slideOver();
        });

        // capitalize the model name in a create action label
        \Filament\Actions\CreateAction::configureUsing(function (CreateAction $action) {
            $action
                ->label(fn(): string => __('filament-actions::create.single.label', ['label' => ucwords($action->getModelLabel())]));
        });

        // various table presets
        \Filament\Tables\Table::configureUsing(function (Table $table) {
            return $table
                ->reorderableColumns()
                ->columnManagerColumns(2)
                ->columnManagerTriggerAction(fn(\Filament\Actions\Action $action) => $action->button()->label('Columns'))
                ->filtersTriggerAction(fn(\Filament\Actions\Action $action) => $action->button()->label('Filters')->slideOver()->closeModalByClickingAway(true))
                ->filtersFormWidth(\Filament\Support\Enums\Width::Small)
                ->paginationPageOptions([10, 25, 50]);
        });

        // allow any column to be toggled
        \Filament\Tables\Columns\Column::configureUsing(function (Column $column) {
            return $column->toggleable();
        });

        // default each text column to be sortable and searchable
        \Filament\Tables\Columns\TextColumn::configureUsing(function (TextColumn $textColumn) {
            return $textColumn
                ->searchable() // BE CAREFUL, you may end up with 500 errors
                ->sortable(); // BE CAREFUL, you may end up with 500 errors
        });

        // make notifications last 10 seconds by default
        \Filament\Notifications\Notification::configureUsing(function (\Filament\Notifications\Notification $notification) {
            return $notification->duration(10000);
        });

        // use your preferred date displays
        \Filament\Schemas\Schema::configureUsing(function (\Filament\Schemas\Schema $schema) {
            return $schema
                ->defaultDateDisplayFormat('m/d/Y')
                ->defaultDateTimeDisplayFormat('h:i A')
                ->defaultTimeDisplayFormat('m/d/Y h:i A');
        });
    }
}
