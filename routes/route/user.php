<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\V1\User\UserCatalogueController;

Route::middleware(['auth', 'verified'])->group(function () {
     Route::resource('/user_catalogue', UserCatalogueController::class);
});

