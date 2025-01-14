<?php

use App\Livewire\Activity\ActivityIndex;
use App\Livewire\Auth\Login;
use App\Livewire\CategoryDependency\CategoryDependencyIndex;
use App\Livewire\Dashboard\DashboardIndex;
use App\Livewire\Employee\EmployeeIndex;
use App\Livewire\Group\GroupIndex;
use App\Livewire\Position\PositionIndex;
use App\Livewire\Report\ReportIndex;
use App\Livewire\Scope\ScopeIndex;
use App\Livewire\User\UserIndex;
use Illuminate\Support\Facades\Route;

Route::get('/', Login::class)->name('login')->middleware('guest');
Route::get('/login', Login::class)->name('login')->middleware('guest');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', DashboardIndex::class)->name('dashboard');
    Route::get('/users', UserIndex::class)->name('master.users');
    Route::get('/groups', GroupIndex::class)->name('master.groups');
    Route::get('/positions', PositionIndex::class)->name('master.positions');
    Route::get('/employees', EmployeeIndex::class)->name('master.employees');
    Route::get('/scopes', ScopeIndex::class)->name('master.scopes');
    Route::get('/category-dependencies', CategoryDependencyIndex::class)->name('master.category-dependencies');

    Route::get('/activities', ActivityIndex::class)->name('activity');
    Route::get('/report', ReportIndex::class)->name('activity.report');
});
