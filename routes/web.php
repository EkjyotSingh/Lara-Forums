<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\Auth\LoginController;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\ForumController::class, 'index'])->name('forum');

Route::middleware(['auth'])->group(function(){
Route::get('/discussion/create', [App\Http\Controllers\DiscussionController::class, 'create'])->name('discussion.create');
Route::post('/discussion/store', [App\Http\Controllers\DiscussionController::class, 'store'])->name('discussion.store');
Route::put('/discussions/closed/{id}', [App\Http\Controllers\DiscussionController::class, 'discussion_closed'])->name('discussion.closed');

Route::post('/reply/{id}', [App\Http\Controllers\ReplyController::class, 'store'])->name('reply.store');
Route::put('/reply/best/{rid}/{did}', [App\Http\Controllers\ReplyController::class, 'best_reply'])->name('reply.best');

Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'show'])->name('notificaion.show');

Route::post('/discussion/watch/{did}', [App\Http\Controllers\WatcherController::class, 'create'])->name('watch.create');
Route::delete('/discussion/unwatch/{did}', [App\Http\Controllers\WatcherController::class, 'destroy'])->name('watch.destroy');
});

Route::get('/discussions/{discussion}', [App\Http\Controllers\DiscussionController::class, 'show'])->name('discussion.show');


Route::middleware(['auth','admin'])->group(function(){
    Route::resource('channel',ChannelController::class);
});


        ///////Socialite Routes///////
        
Route::get('login/{provider}',[LoginController::class,'redirect'])->name('github');


Route::get('login/{provider}/callback',[LoginController::class,'callback']);
