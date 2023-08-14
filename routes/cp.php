<?php

use Morethingsdigital\VercelStatamic\Http\Controllers\AliasController;
use Morethingsdigital\VercelStatamic\Http\Controllers\DashboardController;
use Morethingsdigital\VercelStatamic\Http\Controllers\DeploymentController;
use Morethingsdigital\VercelStatamic\Http\Controllers\EnvController;
use Nette\NotImplementedException;

Route::prefix('vercel')->name('vercel-statamic.')->group(function () {
    Route::get('', [DashboardController::class, 'index'])->name('index');
    Route::post('purge', [DashboardController::class, 'purgeCache'])->name('purge');


    Route::prefix('deployments')->name('deployments.')->group(function () {
        Route::get('', [DeploymentController::class, 'index'])->name('index');
        Route::post('{id}', [DeploymentController::class, 'redeploy'])->name('redeploy');
        Route::get('{id}', [DeploymentController::class, 'show'])->name('show');
    });

    Route::prefix('aliase')->name('aliase.')->group(function () {
        Route::get('', [AliasController::class, 'index'])->name('index');
    });

    Route::prefix('envs')->name('envs.')->group(function () {
        Route::get('', [EnvController::class, 'index'])->name('index');
    });

    Route::prefix('logs')->name('logs.')->group(function () {
        Route::get('', function () {
            throw new NotImplementedException();
        })->name('index');
    });

    Route::prefix('webhooks')->name('webhooks.')->group(function () {
        Route::get('', function () {
            throw new NotImplementedException();
        })->name('index');
    });
});
