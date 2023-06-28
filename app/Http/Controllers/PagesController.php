<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
Use Alert;
use Hash;
use Illuminate\Support\Facades\Log;

class PagesController extends Controller
{
    function Index(){
        return view('select_login');
    }
    function HRLogin(){
        Session::forget('hr');
        return view('HR.hr_login');
    }
    function Dashboard(){
        return view('dashboard');
    }
    function Employees(){
        $department=DB::table('department')
        ->select('*')
        ->get();
        $designation=DB::table('designation')
        ->select('*')
        ->get();
        $temp_employees=DB::table('temp_employee')
        ->select('*')
        ->get();
        $all_employees=DB::table('employees')
        ->join('department','department.id','=','employees.department_id')
        ->select('employees.id as employee_id','employees.f_name','employees.l_name','employees.email','employees.phone_number','employees.emergency_number','employees.status','department.name as department_name')
        ->get();
        return view('HR.employees')->with(['all_department'=>$department,'all_designation'=>$designation,'all_employees'=>$all_employees,'temp_employees'=>$temp_employees]);
    }
    function ManageEmp(){
        $all_employees=DB::table('employees')
        ->select('*')
        ->get();
        $department=DB::table('department')
        ->select('*')
        ->get();
        $designation=DB::table('designation')
        ->select('*')
        ->get();

        return view('HR.manage_emp')->with(['all_department'=>$department,'all_designation'=>$designation,'all_employees'=>$all_employees]);
    }
    function Departments(){
        $department=DB::table('department')
        ->select('*')
        ->get();
        // toast('Success Toast','success');
        // Alert::success('Success Title', 'Success Message');

        return view('Settings.departments')->with(['department_details'=>$department]);
    }

    function Designations(){
        $designation=DB::table('designation')
        ->select('*')
        ->get();
        return view('Settings.designations')->with(['designation_details'=>$designation]);
    }
    function DocCategories(){
        $emp_doc_category=DB::table('emp_doc_category')
        ->select('*')
        ->get();
        return view('Settings.doc_category')->with(['doc_categories_details'=>$emp_doc_category]);
    }

    function EmpPosts(){
        //$EmpPosts=DB::table('emp_posts')
        //->select('*')
        //->get();
        return view('Settings.emp_posts');
    }


    function manage_temp_emp(){
        $emp_doc_list=DB::table('temp_emp_doc')
        ->where('employee_id',1)
        ->Join('emp_doc_category','emp_doc_category.id','=','temp_emp_doc.doc_name_id')
        ->select('*')
        ->get();
         $all_temp_employees=DB::table('temp_employee')
        ->select('*')
        ->get();
         return view('HR.manage_temp_emp')->with(['all_temp_employees'=>$all_temp_employees,'emp_doc_list'=>$emp_doc_list]);
    }
    
}
