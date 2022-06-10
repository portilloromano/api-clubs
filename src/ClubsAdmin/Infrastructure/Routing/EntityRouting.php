<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'entity',
], function () {
    Route::post('/', \Api\ClubsAdmin\Presentation\REST\Entity\EntityCreateController::class);
    Route::get('/', \Api\ClubsAdmin\Presentation\REST\Entity\EntitySearchAllController::class);
    Route::get('/{uuid}', \Api\ClubsAdmin\Presentation\REST\Entity\EntitySearchController::class);
    Route::get('/club/{uuidClub}', \Api\ClubsAdmin\Presentation\REST\Entity\EntitySearchAllByClubController::class);
    Route::patch('/associate/{uuid}', \Api\ClubsAdmin\Presentation\REST\Entity\EntityAssociateClubController::class);
    Route::patch('/disassociate/{uuid}', \Api\ClubsAdmin\Presentation\REST\Entity\EntityDisassociateClubController::class);
});
