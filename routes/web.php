<?php

use App\Http\Controllers\IClockController;
use App\Livewire\Activity\ActivityForm;
use App\Livewire\Activity\ActivityImport;
use App\Livewire\Activity\ActivityIndex;
use App\Livewire\Announcement\AnnouncementForm;
use App\Livewire\Announcement\AnnouncementIndex;
use App\Livewire\Area\AreaIndex;
use App\Livewire\Attendance\AttendanceIndex;
use App\Livewire\Auth\Login;
use App\Livewire\CategoryDependency\CategoryDependencyIndex;
use App\Livewire\Dashboard\DashboardActivity;
use App\Livewire\Dashboard\DashboardIndex;
use App\Livewire\Employee\EmployeeIndex;
use App\Livewire\Group\GroupIndex;
use App\Livewire\MonitoringPresent\MonitoringPresentIndex;
use App\Livewire\Position\PositionIndex;
use App\Livewire\Profile\ProfileIndex;
use App\Livewire\Report\Progress\ReportProgressIndex;
use App\Livewire\Report\ReportIndex;
use App\Livewire\ReportAttendance\ReportAttendanceIndex;
use App\Livewire\Scope\ScopeIndex;
use App\Livewire\ShiftEmployee\ShiftEmployeeIndex;
use App\Livewire\User\UserIndex;
use App\Livewire\CollectionImage\CollectionImageIndex;
use Illuminate\Support\Facades\Route;

Route::get('/', Login::class)->name('login')->middleware('guest');
Route::get('/login', Login::class)->name('login')->middleware('guest');

// Route::get('/iclock/cdata', [IClockController::class, 'handshake']);
// Route::post('/iclock/cdata', [IClockController::class, 'receiveRecords']);
Route::post('/test-attendance', [IClockController::class, 'testAttendance']);

// Route::get('/iclock/test', [IClockController::class, 'test']);
// Route::get('/iclock/getrequest', [IClockController::class, 'getrequest']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', DashboardIndex::class)->name('dashboard');
    Route::get('/dashboard-activity', DashboardActivity::class)->name('dashboard.activity');
    Route::get('/profile', ProfileIndex::class)->name('profile');
    Route::get('/users', UserIndex::class)->name('master.users');
    Route::get('/groups', GroupIndex::class)->name('master.groups');
    Route::get('/positions', PositionIndex::class)->name('master.positions');
    Route::get('/employees', EmployeeIndex::class)->name('master.employees');
    Route::get('/scopes', ScopeIndex::class)->name('master.scopes');
    Route::get('/areas', AreaIndex::class)->name('master.areas');
    Route::get('/category-dependencies', CategoryDependencyIndex::class)->name('master.category-dependencies');
    Route::get('/shifts', ShiftEmployeeIndex::class)->name('master.shifts');
    Route::get('/collection-images', CollectionImageIndex::class)->name('collection.images');

    Route::get('/attendances', AttendanceIndex::class)->name('attendance');
    Route::get('/activities', ActivityIndex::class)->name('activity');
    Route::get('/activities/create', ActivityForm::class)->name('activity.create');
    Route::get('/activities/import', ActivityImport::class)->name('activity.import');
    Route::get('/activities/edit/{activity_id}', ActivityForm::class)->name('activity.edit');
    Route::get('/monitoring-present', MonitoringPresentIndex::class)->name('monitoring.present');

    Route::get('/announcements', AnnouncementIndex::class)->name('announcement');
    Route::get('/announcements/create', AnnouncementForm::class)->name('announcement.create');

    Route::get('/report', ReportIndex::class)->name('activity.report');
    Route::get('/report-progress', ReportProgressIndex::class)->name('activity.report.progress');
    Route::get('/report/attendance', ReportAttendanceIndex::class)->name('attendance.report');
});
