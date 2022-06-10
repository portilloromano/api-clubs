<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'club',
], function () {
    Route::post('/', \Api\ClubsAdmin\Presentation\REST\Club\ClubCreateController::class);
    Route::patch('/budget/{uuid}', \Api\ClubsAdmin\Presentation\REST\Club\ClubUpdateBudgetController::class);
    Route::get('/', \Api\ClubsAdmin\Presentation\REST\Club\ClubSearchAllController::class);
    Route::get('/{uuid}', \Api\ClubsAdmin\Presentation\REST\Club\ClubSearchController::class);
});
