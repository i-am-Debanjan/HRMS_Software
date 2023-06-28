<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
Use Alert;
use Hash;
use Illuminate\Support\Facades\Log;

class TempEmp extends Controller
{
    public function application_submission_check(Request $request){
        $status=array();
        date_default_timezone_set("Asia/Calcutta");
        $check_form_submission = DB::table('temp_employee_details')
        ->where('temp_emp_id',Session::get('temp_employee')->id)
        ->first();
        //Log::info(json_encode($check_form_submission));
        if(!$check_form_submission){
            $status['status']='0';
        }else{
            $status['status']='1';
        }
        return json_encode($status);
    }
    public function AddTodoItem(Request $request){
        $status=array();
        date_default_timezone_set("Asia/Calcutta");
        $add_todo = DB::table('temp_emp_todo_list')
        ->insert([
            'employee_id'=>Session::get('temp_employee')->id,
            'todo_details'=>$request->todo_content,
            'status'=> 0,
            'is_active'=> 1,
            'created_at'=> time(),
            'modified_at'=> time(),
        ]);
        $status['status']=1;
        $status['message']="To Do item Added Successfully"; 
        return json_encode($status);
    }
    public function fetch_todo_item(Request $request){
        $status=array();
        date_default_timezone_set("Asia/Calcutta");
        $fetch_todo_item = DB::table('temp_emp_todo_list')
                    ->where('is_active','=',1)
                    ->where('employee_id',Session::get('temp_employee')->id)
                    ->get();
        $status['status']=1;
        $status['data']=$fetch_todo_item; 
        return json_encode($status);
    }

    public function todo_item_checked(Request $request){
        $status=array();
        date_default_timezone_set("Asia/Calcutta");
        $fetch_todo_item = DB::table('temp_emp_todo_list')
        ->where('id', $request->id)
      ->update(['status' =>$request->check_value]);
        $status['status']=1;
        // $status['data']=$fetch_todo_item; 
        return json_encode($status);
    }

    public function todo_item_delete(Request $request){
        $status=array();
        date_default_timezone_set("Asia/Calcutta");
        $fetch_todo_item = DB::table('temp_emp_todo_list')
        ->where('id', $request->id)
        ->update(['is_active' =>0]);
        $status['status']=1; 
        return json_encode($status);
    }

    public function temp_emp_doc_check(Request $request){
         $status=array();
        date_default_timezone_set("Asia/Calcutta");
        $temp_emp_doc = DB::table('temp_emp_doc')
        ->where('doc_name_id', $request->selected_type)
        ->where('employee_id', Session::get('temp_employee')->id)
        ->where('is_active',1)
        ->get();
        $status['status']=1;
        $status['data']=$temp_emp_doc; 
        return json_encode($status);
    }
    public function upload_temp_emp_doc(Request $request){
         $response=array();
          date_default_timezone_set("Asia/Calcutta");
        $destinationPath = 'Employee_docs/'; // upload path
            $flag = 0;
            $exti = $request->file('emp_doc_file')->getClientOriginalExtension();
            $flag = $exti == 'pdf' ? 1 : 0;
            if (!$flag) {
                $response['status'] = 0;
                Alert::Error('Unaccepted file type only accept pdf');
                return redirect('/document_upload');
            }else{
            $files = $request->file('emp_doc_file');
            $file1 = $request->selected_type_name . "_".Session::get('temp_employee')->username."_" . date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $file1);
            $url = url('/') . '/' . $destinationPath . $file1;
                $inserted_images_id = DB::table('temp_emp_doc')
                    ->insert(
                        [
                            'employee_id' => Session::get('temp_employee')->id,
                            'doc_name_id' => $request->selected_type_id,
                            'doc_url' => $url,
                            'status'=> 0,
                            'is_active'=> 1,
                            'created_at'=> time(),
                            'modified_at'=> time(),

                        ]
                    );
            Alert::Success('Document of '.$request->selected_type_name,'Uploaded Successfully');
            return redirect('/document_upload');
            }
    }
    public function uploaded_document_check(){
        $doc_uploaded=DB::table('temp_emp_doc')
        ->select('*')
        ->where('employee_id',Session::get('temp_employee')->id)
        ->where('is_active',1)
        ->get();
        return json_encode($doc_uploaded);
    }

    public function BasicInfoFormSubmit(Request $request){
        date_default_timezone_set("Asia/Calcutta");
        $status=array();
        $insert_basic_details=DB::table('temp_employee_details')
                            ->insert([
                                'temp_emp_id'=>Session::get('temp_employee')->id,
                                'name_prefix'=>$request->name_prefix,
                                'f_name'=>$request->f_name,													
                                'l_name'=>$request->l_name,
                                'gender'=>$request->selected_gender,
                                'dob'=>strtotime($request->dob . " 00:00:00"),
                                'phone_number'=>$request->phone_no,
                                'emergency_number'=>$request->emergency_no,
                                'father_name'=>$request->father_name,
                                'mother_name'=>$request->mother_name,
                                'current_address'=>$request->current_address,
                                'parmanent_address'=>$request->parmanent_address,
                                'status'=> 0,
                                'is_active'=> 1,
                                'created_at'=> time(),
                                'modified_at'=> time(),
                                'modified_by'=>Session::get('temp_employee')->id,
                            ]);
        Alert::Success('Basic Information Details Submitted Successfully');
        return redirect('/basic_information_form');
    }

    //function EditTempEmployeeDetails(Request $request){
    //    
    //    $Temp_employees=DB::table('temp_employee_details')
    //    ->where('temp_emp_id','=',$request->temp_employee_id)
    //    ->select('*')
    //    ->get();
    //    foreach($Temp_employees as $employee){
    //      $employee->employee_docs=DB::table('temp_emp_doc')
    //    ->where('employee_id',$request->temp_employee_id)
    //    ->Join('emp_doc_category','emp_doc_category.id','=','temp_emp_doc.doc_name_id')
    //    ->select('temp_emp_doc.status as emp_doc_status','temp_emp_doc.id as emp_doc_id','emp_doc_category.doc_category_name','temp_emp_doc.doc_name_id','temp_emp_doc.doc_url','temp_emp_doc.employee_id')
    //    ->get();
    //    }
    //    return json_encode($Temp_employees);
    //}
    
    public function fetch_temp_emp_notification(){
        $status=array();
        $all_notification=DB::table('temp_emp_notification')
        ->where('temp_emp_id',Session::get('temp_employee')->id)
        ->where('temp_emp_notification.is_active',1)
        ->select('*')
        ->orderBy('id','desc')
        ->get();
        $status['status']=1; 
        $status['data']=$all_notification;
        return json_encode($status);
    }
}
