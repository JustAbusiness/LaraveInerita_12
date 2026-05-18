<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\V1\User\UserCatalogueController;

Route::prefix('v1')->group(function () {
    Route::post('user_catalogue/bulk-destroy', [UserCatalogueController::class, 'bulkDestroy']);
    Route::apiResource('user_catalogue', UserCatalogueController::class);
});
