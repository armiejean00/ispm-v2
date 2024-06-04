<?php

use App\Http\Controllers\AvailableDeskController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DeskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FloorPlanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Desk;
use App\Models\Booking;
use App\Http\Controllers\ActivityLogController;
use Illuminate\Support\Facades\Artisan;
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

// Common Resource Routes:
// index - Show all items
// show - Show single item
// create - Show form to create new item
// store - Store new item
// edit - Show form to edit item
// update - Update item
// destroy - Delete item

Route::get('/', function () {
    return view('landing');
});

Route::get('/users/forgotpassword', function () {
    return view('/users/forgotpassword');
});

Route::get('/hold', [UserController::class, 'hold']);

Route::middleware('guest')->group(function () {
    Route::get('/users/register', [UserController::class, 'register']);

    Route::post('/register', [UserController::class, 'store']);

    Route::get('/users/sign_in', [UserController::class, 'sign_in'])->name('login');

    Route::post('/sign_in', [UserController::class, 'authenticate']);
});

// * AUTH MIDDLEWARE
Route::middleware('auth')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);

    Route::get('/faqs', function () {
        return view('faqs', [
            'cssPaths' => [
                'resources/css/main/content.css',
                'resources/css/main/content2.css',
                'resources/css/main/faqs.css',
            ],
            'title' => 'Frequently Asked Questions | ApexHubSpot'
        ]);
    });

    Route::post('/report-issue', [IssueController::class, 'reportIssue'])->name('report.issue');
    // Route::get('/verify-otp', 'UserController@showVerifyOtpForm')->name('verify.otp.form');
    // Route::post('/verify-otp', 'UserController@verifyOtp')->name('verify.otp');
    Route::get('/verify-otp', [UserController::class, 'showVerifyOtpForm'])->name('verify.otp.form');
    Route::post('/verify-otp', [UserController::class, 'verifyOtp'])->name('verify.otp');

    Route::post('/bookings/{id}/accept', [BookingController::class, 'acceptBooking'])->name('bookings.accept');
    Route::get('/admin/bookings', [BookingController::class, 'adminIndex'])->name('bookings.admin')->middleware('auth', 'admin');

    Route::get('/guide', function () {
        return view('guide', [
            'cssPaths' => [
                'resources/css/main/content.css',
                'resources/css/main/content2.css',
                'resources/css/main/faqs.css',
                'resources/css/main/guide.css',
            ],
            'title' => 'User Guide | ApexHubSpot'
        ]);
    });

    // * HOLD MIDDLEWARE
    Route::middleware('hold')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::get('/office_map', function () {
            return view('office_map', [
                'cssPaths' => [
                    'resources/css/main/office_map.css',
                ],
                'title' => 'Office Map | ApexHubSpot'
            ]);
        });
        
        Route::put('/profile/update-image', [UserController::class, 'updateProfileImage'])->name('profile.updateImage');

         Route::get('/office_map/availabledesks', function () {
            return view('availabledesks', [
                'cssPaths' => [
                    'resources/css/main/office_map.css',
                ],
                'title' => 'Office Map | ApexHubSpot'
            ]);
        });

        Route::get('/feedback', function () {
            return view('feedback', [
                'cssPaths' => [
                    'resources/css/main/content.css',
                    'resources/css/main/content2.css',
                    'resources/css/main/faqs.css',
                    'resources/css/main/guide.css',
                ],
                'title' => 'Feedback | ApexHubSpot'
            ]);
        });


    //    Route::get('/logs', [BookingController::class, 'showLogs'])->name('logs');


        Route::get('/office_map/availabledesks', [DeskController::class, 'availableDesks'])->name('availabledesks');

        // * ADMIN MIDDLEWARE
        Route::middleware('admin')->group(function () {
            // UserController
           Route::get('/users', [UserController::class, 'index'])->middleware(['admin']);

            // for creating item
            Route::get('/users/create', [UserController::class, 'create'])->middleware(['admin']);

            // for editing item
            Route::get('/users/{user}/edit', [UserController::class, 'edit'])->middleware(['admin']);

            Route::put('/users/{user}/edit', [UserController::class, 'update'])->middleware(['admin']);

            Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware(['admin']);
        });


        

        // * OFFICE_MANAGER MIDDLEWARE
        Route::middleware('office_manager')->group(function () {
            // UserController
            // storing user
            Route::post('/users', [UserController::class, 'admin_store']);

            // user approval (modify user->is_approved)
            Route::put('/users/{user}', [UserController::class, 'approve']);

            // DeskController
            Route::get('/desks', [DeskController::class, 'index']);
          
            Route::get('/desks/create', [DeskController::class, 'create']);

            Route::post('/desks', [DeskController::class, 'store']);

            Route::put('/desks/{desk}', [DeskController::class, 'availability']);

            Route::delete('/desks/{desk}', [DeskController::class, 'destroy']);

            // BookingController
            Route::get('/bookings', [BookingController::class, 'index']);
            Route::post('/bookings/toggle-auto-accept', [BookingController::class, 'toggleAutoAccept'])->name('bookings.toggleAutoAccept');
               Route::get('/bookings/analytics', [BookingController::class, 'getBookingsData']);

            //  Route::get('/bookings/analytics', [BookingController::class, 'analytics']);


            Route::delete('/bookings/{booking}', [BookingController::class, 'destroy']);
        });

        Route::put('/book/{available_desk}', [BookingController::class, 'book']);

        Route::get('/profile', [BookingController::class, 'profile']);
        // Route::get('/dashboard', [BookingController::class, 'dashboard']);

        Route::delete('/profile/bookings/{booking}', [BookingController::class, 'destroy_self']);
    });
});

Route::get('/desks/available', [AvailableDeskController::class, 'index'])->middleware(['auth', 'hold']);

Route::get('/desks/available/search', [AvailableDeskController::class, 'show'])->middleware(['auth', 'hold']);

Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword')->middleware('auth');
//  Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

Route::get('/profile/customize', [UserController::class, 'editProfile'])->name('profile.edit')->middleware('auth');

Route::put('/profile/customize', [UserController::class, 'updateProfile'])->name('profile.customize')->middleware('auth');



 Route::get('/test-send-booking-notifications', function () {
    Artisan::call('send:booking-notifications');
    return 'Booking notifications command executed.';
});
// ! EDIT
// AvailableDeskController
// Route::get('/desks/available', [AvailableDeskController::class, 'index'])->middleware(['auth', 'hold']);

// Route::get('/desks/available/search', [AvailableDeskController::class, 'show'])->middleware('auth', 'hold']);

// * UNUSED ROUTES

// Route::get('/roles', function () {
//     return view('roles', [
//         'cssPaths' => [
//             'resources/css/main/content.css',
//             'resources/css/main/content2.css',
//             'resources/css/main/roles.css',
//         ],
//         'title' => 'Manage Roles | ApexHubSpot'
//     ]);
// })->middleware('auth');

// Route::get('/bookings/history', [BookingController::class, 'history'])->middleware('auth');

// Show route should be always at the last line after preceeding paths
// Route::get('/users/{user}', [UserController::class, 'show'])->middleware('auth');



// Auth::routes();
Auth::routes([
'register' => false, // Disable registration route
'login' => false, // Disable login route in au
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
