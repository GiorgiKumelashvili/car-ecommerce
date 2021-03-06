<?php

use App\Http\Controllers\CarDetailsController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\home\ContactController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\profile\AnnouncmentsController;
use App\Http\Controllers\profile\FavouritesController;
use App\Http\Controllers\profile\LettersController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;


Auth::routes();

// without auth view
Route::get('/', [CarController::class, 'index'])->name('home');
Route::get('/home', [CarController::class, 'index'])->name('home');
Route::get('/home/catalogue', [CarController::class, 'catalogue'])->name('carCatalogue');
Route::get('/car/{id}', [CarDetailsController::class, 'index'])->name('carDetailedView');
Route::get('/contact', [ContactController::class, 'index'])->name('contactUs');
Route::post('/contact/send', [MailController::class, 'send'])->name('sendMail');
Route::view('/help', 'help')->name('help');

// only authenticated can use this
Route::group(['middleware' => 'auth'], function () {
    // announcments
    Route::get('/profile/announcements', [AnnouncmentsController::class, 'index'])->name('announcements.index');
    Route::get('/profile/announcements/create', [AnnouncmentsController::class, 'create'])->name('announcement.create');
    Route::post('/profile/announcements', [AnnouncmentsController::class, 'store'])->name('announcement.store');
    Route::get('/profile/announcements/create/images/{detailID}/{carID}', [AnnouncmentsController::class, 'createImages'])->name('announcement.create.images');
    Route::delete('/profile/announcements/delete', [AnnouncmentsController::class, 'destroy'])->name('announcement.destroy');

    // favourites
    Route::get('/profile/favourites', [FavouritesController::class, 'index'])->name('favourites.index');

    // letters
    Route::get('/profile/letters', [LettersController::class, 'index'])->name('letters.index');

    // edit (e.g. profile details)
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/seed-users-temp', function () {
    $arr = [
        [
            "email" => "luka@luka.com",
            "username" => "luka",
            "password" => "luka123"
        ],
        [
            "email" => "ana@ana.com",
            "username" => "ana",
            "password" => "ana123"
        ],
        [
            "email" => "levani@levani.com",
            "username" => "levani",
            "password" => "levani123"
        ],
        [
            "email" => "nika@nika.com",
            "username" => "nika",
            "password" => "nika123"
        ],
        [
            "email" => "ricardo@ricardo.com",
            "username" => "ricardo",
            "password" => "ricardo123"
        ],
        [
            "email" => "sandro@sandro.com",
            "username" => "sandro",
            "password" => "sandro123"
        ],
        [
            "email" => "mari@mari.com",
            "username" => "mari",
            "password" => "mari123"
        ],
        [
            "email" => "alexi@alexi.com",
            "username" => "alexi",
            "password" => "alexi123"
        ],
        [
            "email" => "jemali@jemali.com",
            "username" => "jemali",
            "password" => "jemali123"
        ]
    ];


    foreach ($arr as $value) {
        User::create([
            'name' => $value['username'],
            'email' => $value['email'],
            'password' => Hash::make($value['password']),
        ]);
    }

});

/*
 * todo delete images from firebase as well
 * todo (responsivnes: home page, car details, car catalogue[+], user profile)
 * todo dafavoriteba
 *
 * em: giorgi@giorgi.com
 * ps: giorgi123
 *
 * https://www.myauto.ge/ka/
 * https://undraw.co/illustrations
 *
 * Bodystyle Search ro aris maqedan daascrape
 * https://www.cars.com/shopping/
 *
 * (top)
 * https://dribbble.com/shots/14756705-Carbase-Redesign-Car-shop
 *
 * (bottom)
 * https://dribbble.com/shots/14764444-Car-Catalogue-Carent-purple-ver
 */


/*

 */
