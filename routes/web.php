<?php

use App\Http\Controllers\Admin\AuthorController as AdminAuthorController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ChapterController as AdminChapterController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GenreController as AdminGenreController;
use App\Http\Controllers\Admin\NovelController as AdminNovelController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\NovelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Tanpa Login)
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Explore / Browse Novels
Route::get('/explore', [ExploreController::class, 'index'])->name('explore');

// Novel Detail
Route::get('/novel/{novel}', [NovelController::class, 'show'])->name('novel.show');

// Chapter Reader
Route::get('/novel/{novel}/chapter/{chapter}', [ReaderController::class, 'show'])
    ->name('reader.show')
    ->middleware(\App\Http\Middleware\CheckPremium::class);

/*
|--------------------------------------------------------------------------
| Authenticated User Routes (Memerlukan Login)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Profile (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Library
    Route::get('/library', [LibraryController::class, 'index'])->name('library.index');

    // Bookmark actions
    Route::post('/novel/{novel}/bookmark', [LibraryController::class, 'addBookmark'])->name('library.bookmark.add');
    Route::delete('/novel/{novel}/bookmark', [LibraryController::class, 'removeBookmark'])->name('library.bookmark.remove');

    // Readlist actions
    Route::post('/novel/{novel}/readlist', [LibraryController::class, 'addReadlist'])->name('library.readlist.add');
    Route::delete('/novel/{novel}/readlist', [LibraryController::class, 'removeReadlist'])->name('library.readlist.remove');

    // History actions
    Route::delete('/novel/{novel}/history', [LibraryController::class, 'removeHistory'])->name('library.history.remove');

    // Review actions
    Route::post('/novel/{novel}/review', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/review/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Chat (AJAX)
    Route::get('/chat/init', [ChatController::class, 'getOrCreateChat'])->name('chat.init');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/messages', [ChatController::class, 'fetchMessages'])->name('chat.messages');

    // Dashboard Redirection
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('library.index');
    })->name('dashboard');

    // Subscription & Payment
    Route::get('/subscription', [\App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscription.index');
    Route::post('/subscription/pay', [\App\Http\Controllers\SubscriptionController::class, 'subscribe'])->name('subscription.pay');
});

// Midtrans Callback (Outside auth middleware)
Route::post('/payment/callback', [\App\Http\Controllers\SubscriptionController::class, 'callback'])->name('payment.callback');

/*
|--------------------------------------------------------------------------
| Admin Routes (Memerlukan Login + Role Admin)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Authors CRUD
        Route::resource('authors', AdminAuthorController::class)->except(['show']);

        // Genres CRUD
        Route::resource('genres', AdminGenreController::class)->except(['show']);

        // Categories CRUD
        Route::resource('categories', AdminCategoryController::class)->except(['show']);

        // Novels CRUD
        Route::resource('novels', AdminNovelController::class);

        // Chapter Upload & Management
        Route::get('/novels/{novel}/chapters/upload', [AdminChapterController::class, 'create'])->name('chapters.create');
        Route::post('/novels/{novel}/chapters', [AdminChapterController::class, 'store'])->name('chapters.store');
        Route::get('/novels/{novel}/chapters/{chapter}/edit', [AdminChapterController::class, 'edit'])->name('chapters.edit');
        Route::put('/novels/{novel}/chapters/{chapter}', [AdminChapterController::class, 'update'])->name('chapters.update');
        Route::delete('/novels/{novel}/chapters/{chapter}', [AdminChapterController::class, 'destroy'])->name('chapters.destroy');

        // Reports
        Route::get('/reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/print', [\App\Http\Controllers\Admin\ReportController::class, 'print'])->name('reports.print');

        // Live Chat
        Route::get('/chats', [\App\Http\Controllers\Admin\ChatController::class, 'index'])->name('chats.index');
        Route::get('/chats/{chat}', [\App\Http\Controllers\Admin\ChatController::class, 'show'])->name('chats.show');
        Route::post('/chats/{chat}/reply', [\App\Http\Controllers\Admin\ChatController::class, 'reply'])->name('chats.reply');
        Route::patch('/chats/{chat}/close', [\App\Http\Controllers\Admin\ChatController::class, 'close'])->name('chats.close');
        Route::get('/chats/{chat}/messages', [\App\Http\Controllers\Admin\ChatController::class, 'fetchMessages'])->name('chats.messages');
    });

require __DIR__ . '/auth.php';
