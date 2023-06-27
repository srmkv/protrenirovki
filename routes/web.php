<?php

use App\Http\Controllers\Admin\ParseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TrainerController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\TarifController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Auth\UserManagementController;
use App\Http\Controllers\Admin\ExercisesController;

Route::get(
    '/linkstorage',
    function () {
        return Artisan::call('storage:link');
    }
);

Route::controller(HomeController::class)->group(
    function () {
        Route::get('/', 'home')->name('home');
        Route::post('/contact/store', 'contactStore')->name('contact.store');
        Route::post('/comment/store', 'commentStore')->name('comment.store');
    }
);
/* login Register 3A routes */
Route::controller(LoginRegisterController::class)->group(
    function () {
        Route::middleware('guest')->group(function () {
            Route::get('/register', 'register')->name('register');
            Route::post('/store', 'store')->name('store');
            Route::get('/login', 'login')->name('login');
            Route::post('/authenticate', 'authenticate')->name('authenticate');
        });
        Route::middleware('auth')->group(function () {
            Route::get('/dashboard', 'dashboard')->name('dashboard');
            Route::post('/logout', 'logout')->name('logout');
        });
    }
);
/* Admin routes */
Route::get('locale/{locale}', [\App\Http\Controllers\LanguageController::class, 'langChange'])
    ->name('locale');
Route::middleware(['set_locale'])->group(
    function () {
        Route::group(
            [
                'prefix' => 'admin'
            ],
            function () {
                Route::controller(AdminController::class)->group(
                    function () {
                        Route::get('/', 'login')->name('adminLogin');
                        Route::get('/admin/dashboard', 'adminDashboard')->name('adminDashboard');
                        Route::post('/admin/authenticate', 'adminAuthenticate')->name('adminAuthenticate');
                        Route::get('/dishes', 'dishes')->name('dish.index');
                    }
                );
                Route::post("parse-dishes", ParseController::class)->name('parse.dishes');
                Route::resource('trainers', TrainerController::class);
                Route::resource('comments', CommentController::class);
                Route::resource('tarifs', TarifController::class);
                Route::resource('users', UserController::class);
                Route::resource('contacts', ContactController::class);

                Route::controller(TrainerController::class)->group(
                    function () {
                        Route::get('/trainers/up/{id}', 'up')->name('trainers.up');
                        Route::get('/trainers/down/{id}', 'down')->name('trainers.down');
                    }
                );
                Route::controller(CommentController::class)->group(
                    function () {
                        Route::get('/comments/up/{id}', 'up')->name('comments.up');
                        Route::get('/comments/down/{id}', 'down')->name('comments.down');
                    }
                );
                Route::controller(TarifController::class)->group(
                    function () {
                        Route::get('/tarifs/up/{id}', 'up')->name('tarifs.up');
                        Route::get('/tarifs/down/{id}', 'down')->name('tarifs.down');
                    }
                );
                Route::controller(ExercisesController::class)->group(
                    function () {
                        Route::get('/exercises', 'index')->name('exercises.index');
                        Route::get('/exercises/create', 'create')->name('exercises.create');
                        Route::post('/import', 'import')->name('exercises.import');
                        Route::get('/export', 'export')->name('exercises.export');
                    }
                );


            }
        );
    }
);

/* Auth  routes */
Route::middleware("auth")->controller(UserManagementController::class)->group(
    function () {
        Route::get('/user/progress', 'progress')->name('progress');
        Route::get('/user/profile', 'profile')->name('profile');
        Route::post('/user/photo/store', 'photoStore')->name('photo.store');
        Route::post('/user/weight/store', 'weightStore')->name('weight.store');
        Route::post('/user/waist/store', 'waistStore')->name('waist.store');
        Route::post('/user/profile/store', 'profileStore')->name('profile.store');
        Route::post('/user/password/change', 'passwordChange')->name('password.change');
        Route::post('/user/profile/photo/store', 'profilePhotoStore')->name('profile.photo.store');
        Route::post('/user/statistics/store', 'statisticStore')->name('statistics.store');
        Route::post('/user/value/store', 'valueStore')->name('value.store');
        Route::get('/user/tools', 'tools')->name('tools');
        Route::get('/user/consultations', 'consultations')->name('consultations');
        Route::get('/user/rates', 'rates')->name('rates');
        Route::get('/user/workouts', 'workouts')->name('workouts');
        Route::get('/user/nutrition', 'nutrition')->name('nutrition');
        Route::get('/user/rates/change/{id}', 'ratesChange')->name('rates.change');
        Route::post('/user/bzu/calc', 'bzu_calc')->name('bzu.calc');

        // routes for food
        Route::get('/user/food', 'food')->name('food');
        Route::post('/user/food/day/store', 'DayForFoodStore')->name('DayForFood.store');
        Route::get('/user/food/day/{id}', 'foodDay')->name('food.day');
        Route::post('/user/food/day/{id}/store', 'periodDay')->name('PeriodDay.store');
        Route::post('/user/food/day/{id}/dish/store', 'dishStore')->name('dish.store');
        Route::get('/user/add/random/food/{id}', 'addRandomFood')->name('add.random.food');
        Route::get('/user/change/random/food/{id}', 'changeRandomFood')->name('change.random.food');

        // routes for training
        Route::get('/user/training', 'training')->name('training');
        Route::post('/user/training/day/store', 'DayTrainingStore')->name('DayTraining.store');
        Route::get('/user/training/day/{id}', 'trainingDay')->name('training.day');
        Route::post('/user/training/day/{id}/store', 'periodTrainingStore')->name('periodTraining.store');
        Route::post('/user/training/day/{id}/approach/store', 'approachStore')->name('approach.store');
    }
);
