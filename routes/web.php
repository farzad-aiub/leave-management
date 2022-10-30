<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OparetorController;
use App\Http\Controllers\RegistrationController;
use App\Events\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SignatureController;
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
Route::get('/', function () {
return view('login.index');
});
Route::get('/login', [LoginController::class, 'index']);
//Route::get('/login', 'LoginController@index');
Route::post('/login',[LoginController::class, 'verify']);
Route::get('/recover/password', [LoginController::class,'forgot']);
Route::get('/logout', [LogoutController::class, 'index']);
Route::post('/send/code',[LoginController::class,'sendcode']);
Route::post('/verify/code',[LoginController::class,'verifycode']);
Route::post('/create/pass',[LoginController::class,'createpass']);
Route::post('/register', [RegistrationController::class,'verify']);


Route::group(['middleware'=>['sess']] , function(){
	Route::get('/emp/leave/list', [AdminController::class,'LeaveList'])->name('superadmin.leavelist');
    Route::get('/emp/join/list', [AdminController::class,'JoinList'])->name('superadmin.joinlist');
	Route::get('/admin/pending/application', [AdminController::class,'PendingApplication'])->name('admin.pending.application');
	Route::get('/admin/approve/{id}', [AdminController::class,'ApproveApplication'])->name('admin.approve.application');
	Route::get('/admin/reject/{id}', [AdminController::class,'RejectApplication'])->name('admin.reject.application');
	Route::post('/approve/{id}', [OparetorController::class,'ApproveApplication'])->name('approve.application');
	Route::get('/application/approve/{id}', [OparetorController::class,'ApproveApplicationstore'])->name('approve.application.store');
	Route::post('/reject/{id}', [OparetorController::class,'RejectApplication'])->name('reject.application');
	Route::get('/confirm/approve/{id}', [OparetorController::class,'ConfirmApproveApplication'])->name('confirm.approve.application');
	Route::get('/confirm/reject/{id}', [OparetorController::class,'ConfirmRejectApplication'])->name('confirm.reject.application');
	Route::get('/pending/application', [OparetorController::class,'PendingApplication'])->name('pending.application');
	Route::get('/pending/leave/application', [OparetorController::class,'LeavePendingApplication'])->name('leave.pending.application');
	Route::get('/admin/application/list/{id}', [OparetorController::class,'ApplicationList'])->name('admin.applicationlist');
	Route::get('/admin-app/{app_id}', [AdminController::class,'AdminShow']);
	Route::get('/oparetor/profile/details/{id}', [AdminController::class,'UserProfileDetails']);
	Route::get('/employee/profile/details/{id}', [AdminController::class,'employeeProfileDetails']);


    Route::post('image-upload', [ SignatureController::class, 'signatureUploadPost' ])->name('image.upload.post');
    //---------------------- Advance Report  ---------------------------------------------//
    Route::get('/report', [ReportController::class,'index'])->name('report');
    Route::post('/report', [ReportController::class,'data'])->name('get.report');

	//----------------------employee route start---------------------------------------------//
Route::get('/create/employee', [AdminController::class,'CreateEmployee'])->name('create_employee');
Route::post('/create/employee', [AdminController::class,'AddEmployee'])->name('employee_add');
Route::get('/Admin/employeelist', [AdminController::class,'Employeelist'])->name('admin.employeelist');
Route::get('/employee/profile/{id}', [AdminController::class,'Employeeprofile'])->name('admin.employeeprofile');
Route::get('/emp/edit/{id}',    [AdminController::class,'Employeeedit'])->name('admin.employeeedit');
Route::post('/emp/edit/{id}',  [AdminController::class,'Employee_update'])->name('admin.employee_update');
Route::get('/employee/delete/{id}', [AdminController::class,'Employeedestroy'])->name('admin.employeedestroy');
Route::get('/application/delete/{id}', [OparetorController::class,'ApplicationDelete'])->name('application.delete');
Route::get('/application/details/{id}', [OparetorController::class,'ApplicationDetails'])->name('application.details');
Route::get('/create/oparetor', [AdminController::class,'create_oparetor'])->name('admin.create');
	Route::post('/create/oparetor', [AdminController::class,'add_oparetor'])->name('admin.add');
	Route::get('/Admin/oparetorlist', [AdminController::class,'oparetorlist'])->name('admin.oparetorlist');
	Route::get('/oparetor/profile/{id}', [AdminController::class,'oparetorprofile'])->name('admin.oparetorprofile');
	Route::get('/oparetor/edit/{id}', [AdminController::class,'oparetoredit'])->name('admin.oparetoredit');
	Route::post('/oparetor/edit/{id}', [AdminController::class,'oparetor_update'])->name('admin.oparetor_update');
	Route::post('/op/update/{id}', [AdminController::class,'oparetor_update_store'])->name('admin.oparetor_update_store');
	Route::get('/oparetor/delete/{id}', [AdminController::class,'Oparetordestroy'])->name('admin.Oparetordestroy');
	Route::get('/oparetor/suspend/{id}', [AdminController::class,'Oparetorsuspend'])->name('admin.Operatorsuspend');
	Route::get('/oparetor/active/{id}', [AdminController::class,'Oparetoractive'])->name('admin.Operatoractive');
	//----------------------employee route end---------------------------------------------//
Route::group(['middleware'=>['type']] , function(){

	//----------------------admin route start---------------------------------------------//
Route::resource('/admin', 'AdminController')->only(['index']);
Route::get('/Admin/dashboard', [AdminController::class,'dashboard'])->name('admin.dashboard');
	//----------------------oparetor route start---------------------------------------------//

		//----------------------oparetor route end---------------------------------------------//

	//----------------------admin route end---------------------------------------------//




	Route::get('/leave-list/{id}', [AdminController::class,'leaveShow']);//for ajax request
	//for ajax request
	Route::get('/emp/leave-list/{id}', [AdminController::class,'leaveShowEmp']);//for ajax request

});
Route::group(['middleware'=>['type2']] , function(){
Route::resource('/oparetor', 'OparetorController');
// profile start
Route::get('admin/profile', [AdminController::class,'adminprofile'])->name('admin.profile');
Route::get('/user/edit/{id}', [AdminController::class,'pro_update'])->name('admin.pro_update');
Route::post('/admin/edit/{id}', [AdminController::class,'profile_update'])->name('admin.update');
// profile end
 // application pending start////////////



 Route::get('/application/return/{id}', [OparetorController::class,'ApplicationReturn'])->name('application.return');
 Route::post('/application/return/{id}', [OparetorController::class,'ApplicationReturnSend'])->name('application.return.send');


//  	//----------------------employee route start---------------------------------------------//
// Route::get('/create/employee', [AdminController::class,'CreateEmployee'])->name('create_employee');
// Route::post('/create/employee', [AdminController::class,'AddEmployee'])->name('employee_add');
 Route::get('/employee/list', [AdminController::class,'Employeelist'])->name('employee.list');
// Route::get('/employee/profile/{id}', [AdminController::class,'Employeeprofile'])->name('admin.employeeprofile');
// Route::get('/emp/edit/{id}',    [AdminController::class,'Employeeedit'])->name('admin.employeeedit');
// Route::post('/emp/edit/{id}',  [AdminController::class,'Employee_update'])->name('admin.employee_update');
// Route::get('/employee/delete/{id}', [AdminController::class,'Employeedestroy'])->name('admin.employeedestroy');
// 	//----------------------employee route end---------------------------------------------//


	 Route::get('/leave/list', [AdminController::class,'LeaveList'])->name('admin.leavelist');
    Route::get('/join/list', [AdminController::class,'JoinList'])->name('admin.joinlist');



	Route::get('/admin/send/application', [AdminController::class,'SendApplication'])->name('admin.application');
	Route::post('/admin/application/store', [AdminController::class,'ApplicationStore'])->name('admin.application.store');

});

Route::group(['middleware'=>['type3']] , function(){
	Route::resource('/employee', 'EmployeeController')->only(['index']);
    // profile start
Route::get('employee/profile', [EmployeeController::class,'adminprofile'])->name('employee.profile');
Route::get('/employee/edit/{id}', [EmployeeController::class,'pro_update'])->name('employee.pro_update');
Route::post('/employee/edit/{id}', [EmployeeController::class,'profile_update'])->name('employee.update');
// profile end
	Route::get('/send/application', [EmployeeController::class,'SendApplication'])->name('send.application');
	Route::get('/application/list/{id}', [EmployeeController::class,'ApplicationList'])->name('application.list');
	Route::get('/application/returnlist/{id}', [EmployeeController::class,'ApplicationReturnList'])->name('application.returnlist');
	Route::get('/application/return/Details/{id}', [EmployeeController::class,'ApplicationReturnDetails'])->name('application.returndetails');
	Route::post('/application/store', [EmployeeController::class,'ApplicationStore'])->name('application.store');
    Route::post('/weekday-count', [EmployeeController::class,'WeekDayCount'])->name('WeekDayCount');

	});
Route::group(['middleware'=>['type4']] , function(){


});
});
