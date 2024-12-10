<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{

    DashboardController,
    AnnouncementController,
    EventController,
    SuggestedEventController,
    UserAccountController,
    ProfileAccountController,
    EventCommentController
};
use App\Http\Controllers\User\{

    UserDashboardController,
    UserProfileAccountController,
    SuggestEventController,
    UserAnnouncementController,
    FeedbackController
};
use App\Http\Controllers\RegistrationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/registration', [RegistrationController::class, 'index'])->name('registration.index');
Route::post('/registration/store', [RegistrationController::class, 'store'])->name('registration.store');


Route::get('/', [UserDashboardController::class, 'index'])->name('user.dashboard.index');
Route::get('user-announcement/', [UserAnnouncementController::class, 'index'])->name('user-announcement.index');


//For User
Route::middleware(['auth', 'role:user'])->group(function () {

    Route::prefix('user-profile-account')->name('user-profile-account.')->group(function () {
        Route::get('/', [UserProfileAccountController::class, 'index'])->name('index');
        Route::post('/update', [UserProfileAccountController::class, 'update'])->name('update');
    });

    Route::prefix('suggest-event')->name('suggest-event.')->group(function () {
        Route::get('/', [SuggestEventController::class, 'index'])->name('index');
        Route::post('/store', [SuggestEventController::class, 'store'])->name('store');
        Route::get('/record', [SuggestEventController::class, 'SuggestEventRecord'])->name('record');
    });

    Route::prefix('feedback')->name('feedback.')->group(function () {
        Route::post('/events/{event}/comment', [FeedbackController::class, 'StoreComment'])->name('events.comment');
        Route::post('/events/{event}/rate', [FeedbackController::class, 'StoreRating'])->name('events.rate');
    });
    
});


//For Administrator
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::get('/event-calendar', [DashboardController::class, 'EventCalendar'])->name('event-calendar');
    });

    Route::prefix('announcement')->name('admin-announcement.')->group(function () {
        Route::get('/', [AnnouncementController::class, 'index'])->name('index');
        Route::post('/store', [AnnouncementController::class, 'store'])->name('store');
        Route::get('/record', [AnnouncementController::class, 'AllAnnouncementRecord'])->name('announcement-record');
        Route::get('/view', [AnnouncementController::class, 'view'])->name('view');
        Route::get('/edit', [AnnouncementController::class, 'edit'])->name('edit');
        Route::post('/update', [AnnouncementController::class, 'update'])->name('update');
        Route::delete('/delete', [AnnouncementController::class, 'delete'])->name('delete');
    });

    Route::prefix('events')->name('admin-event.')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('index');
        Route::post('/store', [EventController::class, 'store'])->name('store');
        Route::get('/record', [EventController::class, 'allrecord'])->name('allrecord');
        Route::get('/view', [EventController::class, 'view'])->name('view');
        Route::get('/edit', [EventController::class, 'edit'])->name('edit');
        Route::post('/update', [EventController::class, 'update'])->name('update');
        Route::delete('/delete', [EventController::class, 'delete'])->name('delete');
    });

    Route::prefix('event-comment')->name('event.')->group(function () {
        Route::post('{event}/comment', [EventCommentController::class, 'Comment'])->name('comment');
    });


    Route::prefix('user-account')->name('user-account.')->group(function () {
        Route::get('/', [UserAccountController::class, 'index'])->name('index');
        Route::get('/record', [UserAccountController::class, 'UserRecord'])->name('record');
        Route::get('/edit', [UserAccountController::class, 'edit'])->name('edit');
        Route::post('/update', [UserAccountController::class, 'update'])->name('update');
    });

    Route::prefix('profile-account')->name('profile-account.')->group(function () {
        Route::get('/', [ProfileAccountController::class, 'index'])->name('index');
        Route::post('/update', [ProfileAccountController::class, 'update'])->name('update');
    });

    Route::prefix('suggested-event')->name('suggested-event.')->group(function () {
        Route::get('/', [SuggestedEventController::class, 'index'])->name('index');
        Route::get('/record', [SuggestedEventController::class, 'record'])->name('record');
        Route::post('/update', [SuggestedEventController::class, 'update'])->name('update');
        Route::get('/edit', [SuggestedEventController::class, 'edit'])->name('edit');
        Route::delete('/delete', [SuggestedEventController::class, 'delete'])->name('delete');
    });



});



require __DIR__.'/auth.php';
