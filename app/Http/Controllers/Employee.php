<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Alert;
use Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\GeneralEmail;

class Employee extends Controller
{
    function CreateTempEmployee(Request $request){
        date_default_timezone_set("Asia/Calcutta");
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789!_";
        $password = substr(str_shuffle($chars), 0, 6);
        $hashed_password = Hash::make($password);
        $check_username =  DB::table('temp_employee')
        ->where('temp_employee.email','=',$request->temp_employee_email)
        ->first();
        if(!$check_username >0){
            $add_employee = DB::table('temp_employee')
            ->insert([
                'email'=>strtolower($request->temp_employee_email),
                'username'=>$request->temp_login_username,
                'mobile_no'=>$request->mobile_no,
                'gender'=>$request->gender,
                'password'=>$hashed_password,
                'valid_till'=>strtotime('+3 days', time()),
                'status'=> 1,
                'is_active'=> 1,
                'created_at'=> time(),
                'modified_at'=> time(),

            ]);
            $MAIL_BODY = $password;
            $MAIL_LINK = 'http://hrms.diptodiagnostic.com/temp_emp_login';
            Alert::success('Employee Added Successfully');
            Mail::send(
            new GeneralEmail($request->temp_employee_email, $request->temp_login_username, 'Account credentials', $MAIL_BODY,$MAIL_LINK)
            );
            return redirect('/employees');
        }else{
            toast('Employee email is Already Taken Please Try Something new','warning');
            return redirect('/employees');
        }
    }
    function CreateEmployee(Request $request){
        date_default_timezone_set("Asia/Calcutta");
        $password=$request->login_pass;
        $hash_pass=Hash::make($password);
        $check_designation =  DB::table('employees')
        ->where('employees.username','=',$request->login_username)
        ->first();
        if(!$check_designation >0){
        $add_employee = DB::table('employees')
            ->insertGetId([
                'f_name' => $request->f_name,
                'l_name'=>$request->l_name,
                'email'=>strtolower($request->employee_email),
                'phone_number'=>$request->employee_ph,
                'emergency_no'=>$request->employee_emergency_ph,
                'username'=>$request->login_username,
                'password'=>$hash_pass,
                'designation_id'=>$request->selected_designation,
                'department_id'=>$request->selected_department,
                'joining_date'=>strtotime($request->employee_joining_date . " 00:00:00"),
                'status'=> 1,
                'is_active'=> 1,
                'created_at'=> time(),
                'modified_at'=> time(),

            ]);
            if($add_employee >0){
                $add_employee = DB::table('emp_leaders')
                ->insert([
                    'emp_id' => $add_employee,
                    'created_at'=> time(),
                    'modified_at'=> time(),
                ]);  
            }  
            toast('Employee <span class="text-danger font-weight-bold">" '.$request->f_name.' '.$request->l_name.' "</span> Added Successfully','success');
            return redirect('/employees');
        }else{
            toast('Employee Username is Already Taken Please Try Something new','warning');
            return redirect('/employees');
        }
    }
    function CheckUsername(Request $request){
        $status = array();
        $check_designation =  DB::table('employees')
        ->where('employees.username','=',$request->username)
        ->first();
        if(!$check_designation >0){
            $status['status']=1;
            $status['msg']="Available";
            return json_encode($status);
        }else{
            $status['status']=0;
            $status['msg']="Already taken";
            return json_encode($status);
        }

    }
    
    function EditEmployeeDetails(Request $request){
        $employees=DB::table('employees')
        ->join('department','department.id','=','employees.department_id')
        ->join('designation','designation.id','=','employees.designation_id')
        ->join('emp_leaders','emp_leaders.emp_id','=','employees.id')
        ->where('employees.id','=',$request->employee_id)
        ->select('employees.id as employee_id','employees.f_name','employees.l_name','employees.email',
        'employees.phone_number','employees.emergency_no','employees.status','employees.username','employees.password','employees.joining_date',
        'designation.name as designation_name','designation.id as designation_id',
        'department.name as department_name','department.id as department_id',
        'emp_leaders.emp_l1','emp_leaders.emp_l2','emp_leaders.emp_l3')
        ->get();
        return json_encode($employees);
    }
    function AssignLeaders(Request $request){
        date_default_timezone_set("Asia/Calcutta");
        $assign_leaders = DB::table('emp_leaders')
        ->where('emp_leaders.id','=',$request->emp_id)
            ->Update([
                'emp_l1'=>$request->selected_l1,
                'emp_l2'=>$request->selected_l2,
                'emp_l3'=>$request->selected_l3,
                'created_at'=> time(),
                'modified_at'=> time(),
            ]);
            toast('Employee <span class="text-danger font-weight-bold">" Leader "</span> Updated Successfully','success');
            return redirect('/manage_emp?id='.$request->emp_id);
    }

}
