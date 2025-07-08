<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    Auth::loginUsingId(1);

    return redirect('/admin');
});

Route::get('/tinker', function () {

    $search = 'Doe';

    return collect([
        ['id' => 1, 'name' => 'John Doe'],
        ['id' => 2, 'name' => 'Jane Doe'],
        ['id' => 3, 'name' => 'Acme Company'],
    ])
        ->filter(fn($item) => str_contains($item['name'], $search))
        ->pluck('name', 'id')
        ->toArray() ?? [];
});
