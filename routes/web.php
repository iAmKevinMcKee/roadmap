<?php

use App\Models\Feature;
use Illuminate\Support\Facades\Route;

Route::livewire('/', 'public-list-features')->name('list');
Route::livewire('/features/{feature}', 'public-view-feature')->name('view-feature');
