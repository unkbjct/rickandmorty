<?php

use App\Http\Controllers\admin\account\menageController;
use App\Http\Controllers\admin\episodeController;
use App\Http\Controllers\User\viewController as userViewController;
use App\Http\Controllers\admin\viewController as adminViewController;
use App\Http\Controllers\User\commentCorntroller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['namespace' => 'user'], function () {

    Route::get('/', [userViewController::class, 'welcomeView'])->name('welcome');

    Route::get('/s{season}e{episode}', [userViewController::class, 'watchView'])->name('watch');

    Route::group(['prefix' => 's{season}e{episode}/comments'], function () {
        Route::post('/create', [commentCorntroller::class, 'create'])->name('comment.create');
    });

    Route::get('/video/season-{season}/episode-{episode}', [userViewController::class, 'videoView'])->name('video');

    Route::group(['prefix' => 'news'], function () {

        Route::get('/', [userViewController::class, 'newsWelcomeView'])->name('news');

        Route::get('/timetable', [userViewController::class, 'timetableView'])->name('news.timetable');
        
        Route::get('/donations', function () {
            return view('donations');
        })->name('donations');

    });

    Route::get('/account/login', [adminViewController::class, 'loginView'])->middleware('guest')->name('account.views.login');

    Route::post('/account/menage/login', [menageController::class, 'login'])->middleware('guest')->name('account.menage.login');

});


Route::group(['namespace' => 'admin', 'prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::get('/', [adminViewController::class, 'adminView'])->name('admin');

    Route::group(['prefix' => 'news', 'namespace' => 'news'], function ()
    {
        Route::get('/', [adminViewController::class, 'newsView'])->name('admin.news.view');

    });

    Route::group(['prefix' => 'episodes'], function ()
    {
        Route::get('/', [adminViewController::class, 'episodesView'])->name('admin.episodes');

        Route::group(['prefix' => '{episode}'], function ()
        {
            Route::get('/', [adminViewController::class, 'currentEpisodeView'])->name('admin.episode.current');

            Route::post('/change', [episodeController::class, 'change'])->name('admin.episode.change');

            Route::post('/publish', [episodeController::class, 'publish'])->name('admin.episode.publish');
        });

        Route::post('/remove', [episodeController::class, 'remove'])->name('admin.episode.remove');

    });

    Route::group(['prefix' => 'account'], function () {

        Route::get('/create', [adminViewController::class, 'createView'])->name('account.views.create');

        Route::get('logout', function ()
        {
            Auth::logout();
            return redirect()->back();
        })->name('account.logout');
        
        Route::prefix('menage')->group(function () {

            Route::post('create', [menageController::class, 'create'])->name('account.menage.create');

            Route::post('change/password', [menageController::class, 'changePassword'])->name('account.change.password');
            
            Route::post('change/email', [menageController::class, 'changeEmail'])->name('account.change.email');
        });
    });
});
