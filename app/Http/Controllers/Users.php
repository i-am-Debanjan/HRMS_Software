<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use Illuminate\Support\Facades\Log;
use Session;
Use Alert;

class Users extends Controller
{
    function AuthenticateEmp(Request $request)
    {
        $employee = DB::table('employees')
        ->where(['employees.username' => $request->emp_username, 'employees.is_active' => '1'])
        ->first();
        if (!$employee) {
            toast('Employee <span class="text-danger font-weight-bold">"'.$request->emp_username.'"</span> not found','error');
            return redirect('/emp_login');
        } else if (!Hash::check($request->emp_pass, $employee->password)) {
            toast("Password didn't match",'error');
            return redirect('/emp_login');
        } else {
            toast("Login Successful",'success');
            Session::put('employee', $employee);
            return redirect('/emp_dashboard');
        }
    }
   
    public function EmpLogout()
    {
        Session::forget('employee');
        toast("Logout Successful",'info');
        return redirect('/emp_login');
    }
    function AuthenticateTempEmp(Request $request)
    {
        $temp_employee = DB::table('temp_employee')
        ->where(['temp_employee.email' => $request->temp_emp_email, 'temp_employee.is_active' => '1'])
        ->first();
        if (!$temp_employee) {
            toast('Employee <span class="text-danger font-weight-bold">"'.$request->temp_emp_email.'"</span> not found','error');
            return redirect('/temp_emp_login');
        } else if (!Hash::check($request->temp_emp_pass, $temp_employee->password)) {
            toast("Password didn't match",'error');
            return redirect('/temp_emp_login');
        } else if($temp_employee->valid_till<=time()){
            return redirect('/user_account_locked');
        }
        else{
            toast("Login Successful",'success');
            Session::put('temp_employee', $temp_employee);
            return redirect('/temp_emp_dashboard');
        }
    }
   
    public function TempEmpLogout()
    {
        Session::forget('temp_employee');
        toast("Logout Successful",'info');
        return redirect('/temp_emp_login');
    }
}
