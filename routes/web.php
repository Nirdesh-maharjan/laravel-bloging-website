<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\NotificationController;


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');


Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

Route::view('/home', 'home');
Route::view('/about', 'about');
Route::view('/contact', 'contact');

/*
|--------------------------------------------------------------------------
| Dashboard (Protected)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Posts (Protected)
|--------------------------------------------------------------------------
*/
Route::get('/posts', [PostController::class, 'index'])
    ->middleware('auth')
    ->name('posts.index');

Route::get('/posts/create', [PostController::class, 'create'])
    ->middleware('auth')
    ->name('posts.create');

Route::post('/posts', [PostController::class, 'store'])
    ->middleware('auth')
    ->name('posts.store');

Route::get('/posts/{post}', [PostController::class, 'show'])
    ->middleware('auth')
    ->name('posts.show');

/*
|--------------------------------------------------------------------------
| Profile (Protected)
|-------------------------------------------------- ------------------------
*/
Route::view('/profile', 'profile')->middleware('auth')->name('profile');

Route::post('/profile', function(Request $request){
    $request->validate([
        'name' => ['required','string','max:80'],
        'email' => ['required','email','max:120'],
        'bio' => ['nullable','string','max:160'],
    ]);

    $user = auth()->user();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->bio = $request->bio;
    $user->save();

    return back()->with('success','Profile updated ✅');
})->middleware('auth');

Route::post('/profile/password', function(Request $request){
    $request->validate([
        'current_password' => ['required'],
        'password' => ['required','confirmed','min:8'],
    ]);

    $user = auth()->user();

    if(!Hash::check($request->current_password, $user->password)){
        return back()->withErrors(['current_password' => 'Current password is incorrect.']);
    }

    $user->password = Hash::make($request->password);
    $user->save();

    return back()->with('success','Password updated ✅');
})->middleware('auth');

use App\Http\Controllers\CategoryController;

Route::get('/categories', [CategoryController::class, 'index'])
    ->middleware('auth')
    ->name('categories.index');

Route::get('/categories/{category}', [CategoryController::class, 'show'])
    ->middleware('auth')
    ->name('categories.show');


/*
|--------------------------------------------------------------------------
| Other UserController Routes (keep if you still use them)
|--------------------------------------------------------------------------
*/
Route::get('user', [UserController::class, 'userName']);
Route::get('Aboutuser', [UserController::class, 'aboutUser']);
Route::get('user/{name}', [UserController::class, 'getUserName']);

Route::get('/user-home', [UserController::class, 'userHome']);
Route::get('/user-about/{name}', [UserController::class, 'userAbout']);
Route::get('/admin-login', [UserController::class, 'adminLogin']);


Route::get('/my-posts', [PostController::class, 'myPosts'])
    ->middleware('auth')
    ->name('posts.mine');

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])
    ->middleware('auth')
    ->name('posts.edit');

Route::put('/posts/{post}', [PostController::class, 'update'])
    ->middleware('auth')
    ->name('posts.update');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])
    ->middleware('auth')
    ->name('posts.destroy');


Route::get('/settings', [SettingsController::class, 'edit'])
    ->middleware('auth')
    ->name('settings');

Route::post('/settings', [SettingsController::class, 'update'])
    ->middleware('auth')
    ->name('settings.update');


Route::get('/media', [MediaController::class, 'index'])
    ->middleware('auth')
    ->name('media.index');

Route::post('/media', [MediaController::class, 'store'])
    ->middleware('auth')
    ->name('media.store');

Route::delete('/media/{medium}', [MediaController::class, 'destroy'])
    ->middleware('auth')
    ->name('media.destroy');


Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('notifications.readAll');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markRead'])->name('notifications.read');
});
