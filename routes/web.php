<?php

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

/*
 *
 *  Test Routes
 *
 */



/*
 *
 *  Main Routes
 *
 */
/*
 *  Routes for authentication
 */
Auth::routes();

Route::get('/', 'MainController@index')->name('home');
Route::view('about', 'about');
Route::get('search/{type?}', 'MainController@search');

Route::post('/user-note/store', 'UserNoteController@store')->name('storeUserNote');


/*
 *
 *  Profile Routes
 *
 */
Route::get('/u/{username}', 'UserController@profile');


/*
 *
 *  Resource Routes
 *
 */
Route::prefix('resources')->group(function() {
    
    Route::get('/', 'ResourceController@index');
    
    /**
     *  Search Routes
     */
    Route::get('search/{type?}', 'MainController@search');
    
    /**
     * Get Routes
     */
    Route::prefix('get')->group(function() {
        Route::get('cards/{tags}', 'ResourceController@cards');
        Route::get('page/{guiId}/{pocId}/{pagId}', 'ResourceController@getPage')->name('getPage');
        Route::get('guide/{id}', 'ResourceController@getGuide')->name('getGuide');
    });
    
    /**
     *  Card Routes
     */
    Route::get('{type}s/{id}/{permalink}', 'ResourceController@view')->name('viewResource');
    Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function() {
        Route::prefix('cards')->group(function() {
            Route::post('store', 'UsersCardsProgressController@store')->name('storeCardProgress');
            Route::post('update', 'UsersCardsProgressController@update')->name('updateCardProgress');
        });
    });
    
    /**
     *  Report routes
     */
    Route::get('links/report', 'ResourceController@report');
    
    /**
     *  Guide Routes
     */
    Route::prefix('guides')->group(function() {
        Route::get('{guide}', 'ResourceController@guide')->name('guide');
        Route::get('{guide}/{id}/{pocket}', 'ResourceController@guidePocket')->name('guidePocket');
        Route::get('{guide}/{pocId}/{pocket}/{pagId}/{page}', 'ResourceController@guidePage')->name('guidePage');
        //Route::get('{guide}/{pocket}/{page}/complete', 'UsersCardProgressController@guidePage');
    });
    
});


/*
 *
 *  Journalling Routes
 *
 */
Route::prefix('journalling')->group(function() {
    
    Route::get('/', 'JournallingController@index');
});



/*
 *
 *  Dashboard Routes
 *
 */
/**
 *  View index page route
 */
Route::get('dash', 'DashController@index');

Route::prefix('dash')->group(function() {
        
});




/*
 *
 *  Admin Routes
 *
 */
Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function() {
    Route::prefix('admin')->group(function() {
        Route::get('/', 'AdminController@index')->name('admin');
        Route::prefix('create')->group(function() {
            // Cards
            Route::get('/card', 'AdminController@createCard')->name('createCard');
            Route::get('/card/parent/{parent_id}', 'AdminController@createCard')->name('createCardWithParent');
            Route::post('/card/store', 'CardController@store')->name('storeCard');
            // Ramble Prompts
            Route::get('/ramble-prompt', 'AdminController@createRamblePrompt')->name('createRamblePrompt');
            Route::post('/ramble-prompt/store', 'RamblePromptController@store')->name('storeRamblePrompt');
        });
        Route::prefix('edit')->group(function() {
            Route::post('/card/redirect', 'CardController@redirect')->name('redirectCard');
            Route::get('/card/{id}', 'AdminController@editCard')->name('editCard');
            Route::post('/card/{id}/post', 'CardController@update')->name('updateCard');
            Route::post('/cards/reorder','CardController@reorder')->name('reorderCards'); 
        });
    });
});



