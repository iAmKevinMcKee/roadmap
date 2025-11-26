<?php

use App\Models\Feature;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('policy', function () {
    // TODO this should be removed, only here for demonstration purposes
    $feature = Feature::first();

    if (! auth()->user()->can('update', $feature)) {
        abort('403');
    }
    // can you do it?

    $feature->update(['name' => 'New Feature Name 2']);

    echo $feature->name;
});
