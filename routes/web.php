<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Department;
use App\Http\Controllers\Designation;
use App\Http\Controllers\Employee;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Users;
use App\Http\Controllers\EmpPagesController;
use App\Http\Controllers\Settings;
use App\Http\Controllers\TempEmp;
use App\Http\Controllers\HRController;
use App\Http\Controllers\PDFController;
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

Route::get('/', [PagesController::class, 'Index']);
Route::get('/hr_login', [PagesController::class, 'HRLogin']);
Route::post('/authenticate_hr', [HRController::class, 'AuthenticateHR']);
Route::get('/hr_logout', [HRController::class, 'HRLogout']);
Route::get('/print_pdf', [HRController::class, 'print_pdf']);
Route::group(['middleware' => ['hr_session']], function () {
    Route::get('/hr_dashboard', [PagesController::class, 'Dashboard']);
    Route::post('/send_offer_letter', [HRController::class, 'send_offer_letter']);
    Route::post('/check_temp_emp_letters', [HRController::class, 'check_temp_emp_letters']);
    Route::post('/approved_emp_doc',[HRController::class,'approved_emp_doc']);
    Route::post('/reject_emp_doc',[HRController::class,'reject_emp_doc']);
    //============ Employee =================================================
Route::get('/employees', [PagesController::class, 'Employees']);
Route::post('/create_temp_employee', [Employee::class, 'CreateTempEmployee']);
Route::post('/fetch_temp_emp_details',[HRController::class,'fetch_temp_emp_details']);
Route::post('/extend_temp_emp_time',[HRController::class,'extend_temp_emp_time']);
Route::post('/create_employee', [Employee::class, 'CreateEmployee']);
Route::post('/checking_username', [Employee::class, 'CheckUsername']);
//============ End of Employee ==========================================
//============ Manage Employee =================================================
Route::get('/manage_emp', [PagesController::class, 'ManageEmp']);
Route::post('/edit_employee_details', [Employee::class, 'EditEmployeeDetails']);
Route::post('/assign_leaders', [Employee::class, 'AssignLeaders']);
//============ End of Employee ==========================================
Route::get('/manage_temp_emp', [PagesController::class, 'manage_temp_emp']);
//***************************************************************************************
Route::post('/edit_temp_employee_details', [HRController::class, 'EditTempEmployeeDetails']);
Route::post('/reset_temp_emp_password', [HRController::class, 'reset_temp_emp_password']);
Route::post('/update_temp_emp_basic_info', [HRController::class, 'update_temp_emp_basic_info']);
//***************************************************************************************
//============ Department ===============================================
Route::get('/departments', [PagesController::class, 'Departments']);
// Route::get('/add_department', [PagesController::class, 'AddDepartment']);
Route::Post('/create_department', [Department::class, 'CreateDepartment']);
Route::Post('/update_department', [Department::class, 'UpdateDepartment']);
//============ End of Department =========================================
//============ Designation ===============================================
Route::get('/designations', [PagesController::class, 'Designations']);
// Route::get('/add_designation', [PagesController::class, 'AddDesignation']);
Route::Post('/create_designation', [Designation::class, 'CreateDesignation']);
Route::get('/update_designation', [Designation::class, 'UpdateDesignation']);
//============ End of Designation ========================================
Route::get('/doc_categories', [PagesController::class, 'DocCategories']);
Route::Post('/create_emp_doc_category', [Settings::class, 'CreateEmpDocCategory']);
Route::get('/emp_posts', [PagesController::class, 'EmpPosts']);
});


//==========================Employee Section================================
Route::post('/authenticate_emp', [Users::class, 'AuthenticateEmp']);
Route::get('/emp_login', [EmpPagesController::class, 'EmpLogin']);
Route::get('/temp_emp_login', [EmpPagesController::class, 'Temp_EmpLogin']);
Route::get('/user_account_locked', [EmpPagesController::class, 'user_account_locked']);
Route::get('/emp_forgot_password', [EmpPagesController::class, 'emp_forgot_password']);

//Route::post('/user_account_validation_check', [Users::class, 'user_account_validation_check']);
Route::post('/authenticate_temp_emp', [Users::class, 'AuthenticateTempEmp']);

Route::group(['middleware' => ['temp_emp_session']], function () {
    Route::post('/application_submission_check', [TempEmp::class, 'application_submission_check']);
    Route::get('/temp_emp_dashboard', [EmpPagesController::class, 'TempEmpDashboard']);
    Route::get('/temp_emp_logout', [Users::class, 'TempEmpLogout']);
    Route::post('/add_todo_item', [TempEmp::class, 'AddTodoItem']);
    Route::post('/fetch_todo_item', [TempEmp::class, 'fetch_todo_item']);
    Route::post('/todo_item_checked', [TempEmp::class, 'todo_item_checked']);
    Route::post('/todo_item_delete', [TempEmp::class, 'todo_item_delete']);
    Route::get('/document_upload', [EmpPagesController::class, 'DocumentUpload']);
    Route::post('/temp_emp_doc_check', [TempEmp::class, 'temp_emp_doc_check']);
    Route::post('/upload_temp_emp_doc', [TempEmp::class, 'upload_temp_emp_doc']);
    Route::post('/uploaded_document_check', [TempEmp::class, 'uploaded_document_check']);
    Route::get('/basic_information_form', [EmpPagesController::class, 'JobApplicationForm']);
    Route::post('/basic_info_form_submit', [TempEmp::class, 'BasicInfoFormSubmit']);
    Route::post('/fetch_temp_emp_notification', [TempEmp::class, 'fetch_temp_emp_notification']);
    Route::get('/all_temp_emp_notification', [EmpPagesController::class, 'all_temp_emp_notification']);
});
Route::group(['middleware' => ['emp_session']], function () {
    Route::get('/emp_logout', [Users::class, 'EmpLogout']);
    Route::get('/emp_dashboard', [EmpPagesController::class, 'EmpDashboard']);
});

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
Route::get('/sendemail', [MailController::class, 'sendemail']);
Route::get('generatepdf', [PDFController::class, 'generatepdf']);
