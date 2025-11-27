<?php 
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\QueryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServiceFormController;
use App\Http\Controllers\WarrantyController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\Subadmin\QueryController as SubadminQueryController;
use App\Http\Controllers\Admin\FollowupController as AdminFollowupController;
use App\Http\Controllers\Subadmin\FollowupController as SubadminFollowupController;

use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Subadmin\ReportController as SubadminReportController;

Route::prefix('subadmin/employee')->name('subadmin.employee.')->group(function() {
    Route::get('/create-multiple/{customer_id}', [App\Http\Controllers\Subadmin\EmployeeController::class, 'createMultiple'])->name('create_multiple');
    Route::post('/store-multiple', [App\Http\Controllers\Subadmin\EmployeeController::class, 'storeMultiple'])->name('storeMultiple');
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('employee/create-multiple/{customer}', [App\Http\Controllers\Admin\EmployeeController::class, 'createMultiple'])->name('employee.create_multiple');
    Route::post('employee/store-multiple', [App\Http\Controllers\Admin\EmployeeController::class, 'storeMultiple'])->name('employee.storeMultiple');
});


Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/allreport', [AdminReportController::class, 'index'])->name('admin.allreport');
});

// ✅ Subadmin report route
Route::prefix('subadmin')->middleware(['auth', 'role:subadmin'])->group(function () {
    Route::get('/allreport', [SubadminReportController::class, 'index'])->name('subadmin.allreport');
});


use App\Http\Controllers\Customer\CustomerUploadsController;

Route::post('/customer/report/save',[CustomerUploadsController::class,'saveReport'])->name('customer.report.store');
Route::post('/customer/feedback/save',[CustomerUploadsController::class,'saveFeedback'])->name('customer.feedback.store');

// view list
Route::get('/customer/uploads',[CustomerUploadsController::class,'index'])->name('customer.uploads.index');

// open create page for report upload
Route::get('/customer/report/create', function () {
    return view('customer.report.create');
})->name('customer.report.create');

// open create page for feedback upload
Route::get('/customer/feedback/create', function () {
    return view('customer.feedback.create');
})->name('customer.feedback.create');



use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ServiceRequestController;
use App\Http\Controllers\Admin\ContactMessageAdminController;

use App\Http\Controllers\Subadmin\CustomerController;
use App\Http\Controllers\Subadmin\WarrantyController as SubadminWarrantyController;
use App\Http\Controllers\Customer\WarrantyController as CustomerWarrantyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\EmployeeController as AdminEmployeeController;
use App\Http\Controllers\Subadmin\EmployeeController as SubadminEmployeeController;

use App\Http\Controllers\Admin\VisitController as AdminVisitController;
use App\Http\Controllers\Subadmin\VisitController as SubadminVisitController;
use App\Http\Controllers\Customer\VisitController as CustomerVisitController;



use App\Http\Controllers\Admin\CompaniesController as AdminCompaniesController;
use App\Http\Controllers\Subadmin\CompaniesController as SubadminCompaniesController;
use App\Http\Controllers\Customer\ProfileController;

// Controller Imports
use App\Http\Controllers\Admin\AmcController as AdminAmcController;
use App\Http\Controllers\Subadmin\AmcController as SubadminAmcController;

use App\Http\Controllers\Customer\AttendanceController as CustomerAttendanceController;


use App\Http\Controllers\Subadmin\AttendanceController as SubadminAttendanceController;

Route::prefix('subadmin')->name('subadmin.')->group(function () {
    Route::get('/attendance/list', [SubadminAttendanceController::class, 'showList'])->name('attendance.list');
});


use App\Http\Controllers\Admin\AttendanceController as AdminAttendanceController;



Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/attendance/list', [AdminAttendanceController::class, 'showList'])->name('attendance.list');
});



// Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('companyprofit/create', [App\Http\Controllers\Admin\CompanyProfitController::class, 'create'])->name('companyprofit.create');
    Route::post('companyprofit/store', [App\Http\Controllers\Admin\CompanyProfitController::class, 'store'])->name('companyprofit.store');
    Route::get('companyprofit/view', [App\Http\Controllers\Admin\CompanyProfitController::class, 'view'])->name('companyprofit.view');
});

// Subadmin
Route::prefix('subadmin')->name('subadmin.')->group(function () {
    Route::get('companyprofit/create', [App\Http\Controllers\Subadmin\CompanyProfitController::class, 'create'])->name('companyprofit.create');
    Route::post('companyprofit/store', [App\Http\Controllers\Subadmin\CompanyProfitController::class, 'store'])->name('companyprofit.store');
    Route::get('companyprofit/view', [App\Http\Controllers\Subadmin\CompanyProfitController::class, 'view'])->name('companyprofit.view');
});





Route::middleware(['auth'])->group(function () {
    
    Route::get('/performance/summary', [HomeController::class, 'summary'])->name('performance.summary');
});


use App\Http\Controllers\Customer\PerformanceController;

Route::get('/customer/performance', [PerformanceController::class, 'index'])
    ->name('customer.performance');
Route::get('/customer/attendance/logout', [CustomerAttendanceController::class, 'logoutForm'])->name('attendance.logout.form');

// Handle logout attendance submission
Route::post('/customer/attendance/logout', [CustomerAttendanceController::class, 'logoutStore'])->name('attendance.logout');


Route::get('/attendance', [CustomerAttendanceController::class, 'index'])->name('customer.attendance.attendance');
Route::post('/attendance/store', [CustomerAttendanceController::class, 'store'])->name('attendance.store');
Route::get('/attendance/list', [CustomerAttendanceController::class, 'showList'])->name('attendance.list');


// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('amcvisit', [AdminAmcController::class, 'index'])->name('amcvisit.index');
    Route::get('amcvisit/create', [AdminAmcController::class, 'create'])->name('amcvisit.create');
    Route::post('amcvisit', [AdminAmcController::class, 'store'])->name('amcvisit.store');
    Route::get('amcvisit/{id}/edit', [AdminAmcController::class, 'edit'])->name('amcvisit.edit');
    Route::put('amcvisit/{id}', [AdminAmcController::class, 'update'])->name('amcvisit.update');
    Route::delete('amcvisit/{id}', [AdminAmcController::class, 'destroy'])->name('amcvisit.destroy');
});

// Subadmin Routes
Route::prefix('subadmin')->name('subadmin.')->middleware(['auth', 'is_subadmin'])->group(function () {
    Route::get('amcvisit', [SubadminAmcController::class, 'index'])->name('amcvisit.index');
    Route::get('amcvisit/create', [SubadminAmcController::class, 'create'])->name('amcvisit.create');
    Route::post('amcvisit', [SubadminAmcController::class, 'store'])->name('amcvisit.store');
    Route::get('amcvisit/{id}/edit', [SubadminAmcController::class, 'edit'])->name('amcvisit.edit');
    Route::put('amcvisit/{id}', [SubadminAmcController::class, 'update'])->name('amcvisit.update');
    Route::delete('amcvisit/{id}', [SubadminAmcController::class, 'destroy'])->name('amcvisit.destroy');
});

Route::prefix('customer')->name('customer.')->middleware('auth')->group(function () {
    Route::get('/id', [ProfileController::class, 'show'])->name('id');
});



Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('companies', [AdminCompaniesController::class, 'index'])->name('companies.index');
    Route::get('companies/create', [AdminCompaniesController::class, 'create'])->name('companies.create');
    Route::post('companies', [AdminCompaniesController::class, 'store'])->name('companies.store');
    Route::get('companies/{id}/edit', [AdminCompaniesController::class, 'edit'])->name('companies.edit');
    Route::put('companies/{id}', [AdminCompaniesController::class, 'update'])->name('companies.update');
    Route::delete('companies/{id}', [AdminCompaniesController::class, 'destroy'])->name('companies.destroy');
});

/*
|--------------------------------------------------------------------------
| Subadmin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('subadmin')->name('subadmin.')->middleware(['auth', 'is_subadmin'])->group(function () {
    Route::get('companies', [SubadminCompaniesController::class, 'index'])->name('companies.index');
    Route::get('companies/create', [SubadminCompaniesController::class, 'create'])->name('companies.create');
    Route::post('companies', [SubadminCompaniesController::class, 'store'])->name('companies.store');
    Route::get('companies/{id}/edit', [SubadminCompaniesController::class, 'edit'])->name('companies.edit');
    Route::put('companies/{id}', [SubadminCompaniesController::class, 'update'])->name('companies.update');
    Route::delete('companies/{id}', [SubadminCompaniesController::class, 'destroy'])->name('companies.destroy');
});











Route::middleware(['auth'])->group(function () {

    // ðŸ”¸ Admin Routes
    // Admin Visit Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('visits', [AdminVisitController::class, 'index'])->name('visits.index');
    Route::get('visits/create', [AdminVisitController::class, 'create'])->name('visits.create');
    Route::post('visits', [AdminVisitController::class, 'store'])->name('visits.store');
    Route::get('visits/{id}/edit', [AdminVisitController::class, 'edit'])->name('visits.edit');
    Route::put('visits/{id}', [AdminVisitController::class, 'update'])->name('visits.update');

    // âœ… Add this line:
    Route::delete('visits/{id}', [AdminVisitController::class, 'destroy'])->name('visits.destroy');
});

    

Route::prefix('subadmin')->name('subadmin.')->group(function () {
    Route::get('visits', [SubadminVisitController::class, 'index'])->name('visits.index');
    Route::get('visits/create', [SubadminVisitController::class, 'create'])->name('visits.create');
    Route::post('visits', [SubadminVisitController::class, 'store'])->name('visits.store');
    Route::get('visits/{id}/edit', [SubadminVisitController::class, 'edit'])->name('visits.edit');
    Route::put('visits/{id}', [SubadminVisitController::class, 'update'])->name('visits.update');

    // âœ… Add this line:
    Route::delete('visits/{id}', [AdminVisitController::class, 'destroy'])->name('visits.destroy');
});

   
    // ðŸ”¸ Customer Routes (View Only)
    Route::get('customer/visits', [CustomerVisitController::class, 'index'])->name('customer.visits.index');
   
    Route::get('customer/visits/create', [CustomerVisitController::class, 'create'])->name('customer.visits.create');
    Route::post('customer/visits', [CustomerVisitController::class, 'store'])->name('customer.visits.store');
    Route::get('customer/visits/{id}/edit', [CustomerVisitController::class, 'edit'])->name('customer.visits.edit');
    Route::put('customer/visits/{id}', [CustomerVisitController::class, 'update'])->name('customer.visits.update');
});



Route::get('/migrate-blog', function () {
    Artisan::call('migrate');
    return 'Blog table created!';
});



// Subadmin routes
Route::middleware(['auth', 'role:subadmin'])->group(function () {
    Route::get('/subadmin/employee/create/{customer_id}', [SubadminEmployeeController::class, 'create'])->name('subadmin.employee.create');
    Route::post('/subadmin/employee/store', [SubadminEmployeeController::class, 'store'])->name('subadmin.employee.store');

    Route::put('subadmin/employee/update/{id}', [SubadminEmployeeController::class, 'update'])->name('subadmin.employee.update');
    Route::get('subadmin/employee-report/{id}', [SubadminEmployeeController::class, 'employeeReport'])->name('subadmin.employee.employee_report');
    Route::get('subadmin/employee/view/{id}', [SubadminEmployeeController::class, 'view'])->name('subadmin.employee.view');



    Route::get('subadmin/employee/edit/{id}', [SubadminEmployeeController::class, 'edit'])->name('subadmin.employee.edit');
    Route::delete('subadmin/employee/delete/{id}', [SubadminEmployeeController::class, 'destroy'])->name('subadmin.employee.delete');
     Route::put('/employee/{id}/status', [EmployeeController::class, 'updateStatus'])
        ->name('employee.updateStatus');
        
        
});


// admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/employee/create/{customer_id}', [AdminEmployeeController::class, 'create'])->name('admin.employee.create');
    Route::post('/admin/employee/store', [AdminEmployeeController::class, 'store'])->name('admin.employee.store');


    Route::put('admin/employee/update/{id}', [AdminEmployeeController::class, 'update'])->name('admin.employee.update');
    Route::get('admin/employee-report/{id}', [AdminEmployeeController::class, 'employeeReport'])->name('admin.employee.employee_report');


    Route::get('admin/employee/view/{id}', [AdminEmployeeController::class, 'view'])->name('admin.employee.view');
    Route::get('admin/employee/edit/{id}', [AdminEmployeeController::class, 'edit'])->name('admin.employee.edit');
    Route::delete('admin/employee/delete/{id}', [AdminEmployeeController::class, 'destroy'])->name('admin.employee.delete');
    
     Route::put('admin/employee/{id}/status', [AdminEmployeeController::class, 'updateStatus'])
        ->name('adminemployee.updateStatus');
    
});



Route::get('/warranties/{id}/view', [WarrantyController::class, 'view'])->name('admin.warranties.view');


// Admin routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('followups', [AdminFollowupController::class, 'index'])->name('followups.index');
    Route::get('followups/query/{queryId}/view', [AdminFollowupController::class, 'view'])->name('followups.view');
    Route::get('followups/create/{query_id}', [AdminFollowupController::class, 'create'])->name('followups.create');
    Route::post('followups', [AdminFollowupController::class, 'store'])->name('followups.store');
    Route::get('followups/{id}/edit', [AdminFollowupController::class, 'edit'])->name('followups.edit');
    Route::put('followups/{id}', [AdminFollowupController::class, 'update'])->name('followups.update');
});

// Subadmin routes
Route::prefix('subadmin')->name('subadmin.')->middleware('auth')->group(function () {
    Route::get('followups', [SubadminFollowupController::class, 'index'])->name('followups.index');
    Route::get('followups/query/{queryId}/view', [SubadminFollowupController::class, 'view'])->name('followups.view');
    Route::get('followups/create/{query_id}', [SubadminFollowupController::class, 'create'])->name('followups.create');
    Route::post('followups', [SubadminFollowupController::class, 'store'])->name('followups.store');
    Route::get('followups/{id}/edit', [SubadminFollowupController::class, 'edit'])->name('followups.edit');
    Route::put('followups/{id}', [SubadminFollowupController::class, 'update'])->name('followups.update');
});


Route::prefix('subadmin')->name('subadmin.')->middleware(['auth'])->group(function () {
    Route::resource('queries', SubadminQueryController::class);
});
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('queries', QueryController::class);
});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::resource('blogs', \App\Http\Controllers\Admin\BlogController::class);
});


Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('blog', BlogController::class)->names([
        'index' => 'admin.blog.index',
        'create' => 'admin.blog.create',
        'store' => 'admin.blog.store',
        'edit' => 'admin.blog.edit',
        'update' => 'admin.blog.update',
        'destroy' => 'admin.blog.destroy',
    ]);
});


Route::get('/', function () {
    return view('welcome');
});

Route::post('/contact-submit', [ContactController::class, 'store'])->name('contact.submit');
Route::post('/submit-service', [ServiceFormController::class, 'submit'])->name('service.submit');
Route::post('/contact-message-submit', [ContactMessageController::class, 'store'])->name('contact.message.submit');


Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('users', UserController::class); 
    Route::resource('warranties', WarrantyController::class); 
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
    Route::get('/service-requests', [ServiceRequestController::class, 'index'])->name('service-requests');
    Route::get('/contact-messages', [ContactMessageAdminController::class, 'index'])->name('contact.messages');
});
Route::middleware(['auth', 'role:subadmin'])->prefix('subadmin')->name('subadmin.')->group(function () {
    Route::get('/', fn () => view('subadmin.dashboard'))->name('dashboard');

    Route::resource('customers', CustomerController::class);
    Route::resource('warranties', SubadminWarrantyController::class);  
});


Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::resource('warranties', \App\Http\Controllers\Customer\WarrantyController::class);
});
Route::get('admin/users', [App\Http\Controllers\Admin\UserController::class, 'index'])
    ->name('admin.users.index');


Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('employees', [App\Http\Controllers\Customer\EmployeeController::class, 'index'])
        ->name('employees.index');

    Route::put('employees/{id}/status', [App\Http\Controllers\Customer\EmployeeController::class, 'updateStatus'])
        ->name('employees.updateStatus');
});


