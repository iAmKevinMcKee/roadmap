<?php

use App\Mappers\ClickupTaskMapper;
use App\Models\Feature;
use Illuminate\Support\Facades\Route;

Route::livewire('/', 'public-list-features')->name('list');
Route::livewire('/features/{feature}', 'public-view-feature')->name('view-feature');

Route::get('clickup', function () {
    $response = Http::withHeaders([
        'Authorization' => 'pk_38346676_IWZEBXAVWDM5YDO258KY70CW9ZPIABHG',
        'accept' => 'application/json',
    ])->get('https://api.clickup.com/api/v2/list/901708324873/task');

    return ClickupTaskMapper::getArrayOfFeatureAttributes($response->json());
});

// create an action to mount a form prefilled with data from the API
// create the new Feature model
