<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\V1\User\UserCatalogueController;
use Inertia\Inertia;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user_catalogue', function () {
        return Inertia::render('user/user_catalogue/index');
    })->name('user_catalogue.index');

    Route::get('/user_catalogue/create', function () {
        return Inertia::render('user/user_catalogue/save');
    })->name('user_catalogue.create');

    Route::get('/user_catalogue/{id}/edit', function ($id) {
        return Inertia::render('user/user_catalogue/save', ['id' => $id]);
    })->name('user_catalogue.edit');
});

