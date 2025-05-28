<?php

use App\Http\Controllers\Api\NewsApiController;
use Illuminate\Support\Facades\Route;

// API Routes
Route::prefix('api')->group(function () {
    // News API Routes
    Route::prefix('news')->group(function () {
        Route::get('/latest', [NewsApiController::class, 'getLatest'])->name('api.news.latest');
        Route::get('/featured', [NewsApiController::class, 'getFeatured'])->name('api.news.featured');
        Route::get('/{id}', [NewsApiController::class, 'getNewsItem'])->name('api.news.detail');
    });
});
