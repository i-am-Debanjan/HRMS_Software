<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
Use Alert;
use Hash;
use Illuminate\Support\Facades\Log;

class EmpPagesController extends Controller
{
    function user_account_locked(){
        Session::forget('temp_employee');
         Alert::info("Your Account Locked","Please Contact HR")->showConfirmButton('Understand', '#009541');
        return view('user_account_locked');
    }
    function emp_forgot_password(){
        return view('emp_forgot_password');
    }
    

    function Temp_EmpLogin(){
        Session::forget('temp_employee');
        return view('Temp_Employee.temp_employee_login');
    }

    function TempEmpDashboard(){
        $emp_doc_list=DB::table('temp_emp_doc')
        ->where('employee_id',Session::get('temp_employee')->id)
        ->where('temp_emp_doc.is_active',1)
        ->Join('emp_doc_category','emp_doc_category.id','=','temp_emp_doc.doc_name_id')
        ->select('*')
        ->get();
        $doc_category_list=DB::table('emp_doc_category')
        ->where('is_active',1)
        ->select('*')
        ->get();
        return view('Temp_Employee.temp_emp_dashboard')->with(['emp_doc_list'=>$emp_doc_list,'doc_category_list'=>$doc_category_list]);
    }

    function JobApplicationForm(){
        $designation=DB::table('designation')
        ->where('is_active',1)
        ->select('*')
        ->get();
        $temp_employee_details=DB::table('temp_employee_details')
        ->where('is_active',1)
        ->select('*')
        ->where('temp_emp_id',Session::get('temp_employee')->id)
        ->get();
        return view('Temp_Employee.job_application_form')->with(['designation_list'=>$designation,'basic_details'=>$temp_employee_details]);
    }

     function DocumentUpload(){
        $emp_doc_category=DB::table('emp_doc_category')
        ->where('is_active',1)
        ->select('*')
        ->orderBy('doc_category_name','asc')
        ->get();
        return view('Temp_Employee.emp_document_upload')->with(['emp_doc_category'=>$emp_doc_category]);
    }

    function EmpLogin(){
        Session::forget('employee');
        return view('emp_login');
    }

    function EmpDashboard(){
        return view('employee.emp_dashboard');
    }
    
    function all_temp_emp_notification(){
        $temp_emp_notification=DB::table('temp_emp_notification')
        ->where('temp_emp_id',Session::get('temp_employee')->id)
        ->where('is_active',1)
        ->select('*')
        ->orderBy('id','desc')
        ->get();
        return view('Temp_Employee.all_temp_emp_notification')->with(['temp_emp_notification'=>$temp_emp_notification]);
    }

    
}
