<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
Use Alert;
use Hash;
use PDF;
use Storage;
use File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOfferLetter;
use App\Mail\NewNotificationAlert;
use App\Mail\PasswordReset;
use Crypt;
class HRController extends Controller
{
    function AuthenticateHR(Request $request)
    {
        // Log::info(json_encode($request->emp_username));
        $hr = DB::table('hr_table')
        ->where(['hr_table.email' => $request->hr_email, 'hr_table.is_active' => '1'])
        ->first();
        if (!$hr) {
            toast('HR <span class="text-danger font-weight-bold">"'.$request->hr_email.'"</span> not found','error');
            return redirect('/hr_login');
        } else if (!Hash::check($request->hr_pass, $hr->password)) {
            toast("Password didn't match",'error');
            return redirect('/hr_login');
        } else {
            toast("Login Successful",'success');
            Session::put('hr', $hr);
            return redirect('/hr_dashboard');
        }
    }
    public function HRLogout()
    {
        Session::forget('hr');
        toast("Logout Successful",'info');
        return redirect('/hr_login');
    }
    public function print_pdf(){
        $hr = DB::table('hr_table')
        ->select('is_active')
        ->get();
        date_default_timezone_set("Asia/Calcutta");
        $date_name=date("d", strtotime('2022-08-10 00:00:00'));
        $monthName = date("F", strtotime('2022-08-10 00:00:00'));
        $year = date("Y", strtotime('2022-08-10 00:00:00'));
        $id=1;
        $name="Debanjan";
        foreach($hr as $h){
            $h->name_prefix="Dr.";
            $h->f_name="Sourish Ghosh,";
            $h->l_name="Baidya";
            $h->current_address="S/O: Shankari Prasad Ghosh \n Circus Maidan \n P.O: Katwa \n Dist:Barddhaman \n Pin:713130\n";
            $h->phone_number="8637599298";
            $h->date_name=$date_name;
            $h->post="Consultant Bio-Chemist";
            $h->month="August";
            $h->year="2022";
            $h->salary="5000";
            $h->date="10"."/"."08"."/"."2022";
            $h->reference='DDPL\HR\OL\0001';
        }
        $pdf = PDF::loadView('pdf.wh_offer_letter', ['all_data' => $hr]);
        //File::put('Employee_letter/'.$name.'_'.$id.'_offer_leter.pdf', $pdf->output());
        return $pdf->stream('pdf_file.pdf');
    }
    public function send_offer_letter(Request $request){
        $pdf_data = DB::table('temp_employee_details')
        ->where('temp_employee_details.temp_emp_id',$request->selected_temp_emp_id)
        ->select('*')
        ->get();
        $temp_employee_data=DB::table('temp_employee')
        ->where('temp_employee.id',$request->selected_temp_emp_id)
        ->select('*')
        ->first();
            date_default_timezone_set("Asia/Calcutta");
            $date_name=date("d", strtotime( $request->emp_tdj));
            $monthName = date("F", strtotime( $request->emp_tdj));
            $year = date("Y", strtotime( $request->emp_tdj));
            $id=$request->selected_temp_emp_id;
            $name=str_replace(" ","_",$request->selected_temp_emp_name);
            foreach($pdf_data as $pdf_d){
                $pdf_d->post=$request->post_apply_for;
                $pdf_d->date_name=$date_name;
                $pdf_d->month=$monthName;
                $pdf_d->year=$year;
                $pdf_d->salary=$request->emp_salary;
                $pdf_d->date=date("d/m/Y");
                $pdf_d->reference='DDPL\HR\OL'.str_pad($id, 4, '0', STR_PAD_LEFT);

            }
            $pdf = PDF::loadView('pdf.wh_offer_letter', ['all_data' => $pdf_data]);
            File::put('Employee_letter/'.$name.'_'.$id.'_offer_leter.pdf', $pdf->output());
            
            $insert_letter_details = DB::table('emp_letter_details')
            ->insert([
                'temp_emp_id'=>$request->selected_temp_emp_id,
                'letter_name'=>"Offer Letter",
                'Reference_no'=>'DDPL\HR\OL'.str_pad($id, 4, '0', STR_PAD_LEFT),
                'emp_post'=> $request->post_apply_for,
                'emp_tdj'=>strtotime($request->emp_tdj),
                'emp_salary'=>$request->emp_salary,
                'letter_url'=>url('/').'/Employee_letter/'.$name.'_'.$id.'_offer_leter.pdf',
                'status'=>1,
                'is_active'=> 1,
                'created_at'=> time(),
                'modified_at'=> time(),

            ]);
            $MAIL_BODY = '';
            $MAIL_LINK = url('/').'/Employee_letter/'.$name.'_'.$id.'_offer_leter.pdf';
            Mail::send(
            new SendOfferLetter($temp_employee_data->email, $temp_employee_data->username, 'Offer Letter', $MAIL_BODY,$MAIL_LINK)
            );
            Alert::success('Mail Sent Successfully');
            return redirect('/manage_temp_emp');
    }
    public function check_temp_emp_letters(Request $request){
        $response=array();
        $temp_emp_letters = DB::table('emp_letter_details')
        ->where('emp_letter_details.temp_emp_id',$request->temp_employee_id)
        ->select('*')
        ->get();
        $response['status']=1;
        $response['data']=$temp_emp_letters;
        return json_encode($response);
    }
    
    function fetch_temp_emp_details(Request $request){
        $temp_employee=DB::table('temp_employee')
        ->where('id','=',$request->temp_emp_id)
        ->select('*')
        ->get();
        return json_encode($temp_employee);
    }
    
    function EditTempEmployeeDetails(Request $request){
        
        $Temp_employees=DB::table('temp_employee_details')
        ->where('temp_emp_id','=',$request->temp_employee_id)
        ->select('*')
        ->get();
        foreach($Temp_employees as $employee){
          $employee->employee_docs=DB::table('temp_emp_doc')
        ->where('employee_id',$request->temp_employee_id)
        //->where('temp_emp_doc.is_active',1)
        ->Join('emp_doc_category','emp_doc_category.id','=','temp_emp_doc.doc_name_id')
        ->select('temp_emp_doc.is_active as temp_emp_doc_is_active','temp_emp_doc.status as emp_doc_status','temp_emp_doc.id as emp_doc_id','emp_doc_category.doc_category_name','temp_emp_doc.doc_name_id','temp_emp_doc.doc_url','temp_emp_doc.employee_id')
        ->get();
        }
        return json_encode($Temp_employees);
    }
    
    function extend_temp_emp_time(Request $request){
        date_default_timezone_set("Asia/Calcutta");
        $temp_employee=DB::table('temp_employee')
        ->where('id','=',$request->temp_emp_id)
        ->update(['valid_till'=>strtotime($request->extended_time)]);
        $temp_employee=DB::table('temp_emp_notification')
        ->insert([
            'temp_emp_id'=>$request->temp_emp_id,
            'notification_title'=>'Time Extended to '.str_replace("T"," ",$request->extended_time),
            'notification_content'=>$request->change_message,
            'status'=>0,
            'is_active'=>1,
            'created_at'=>time()
            ]);

        $MAIL_BODY = '';
        $MAIL_LINK = url('/').'/temp_emp_dashboard';
        Mail::send(
            new NewNotificationAlert($request->temp_emp_email, $request->temp_emp_username, 'New Notification', $MAIL_BODY,$MAIL_LINK)
        );
        toast('Time extended Successfully','success');
        return redirect('/employees');
    }
    function approved_emp_doc(Request $request){
        $response=array();
        date_default_timezone_set("Asia/Calcutta");
        $temp_employee=DB::table('temp_emp_doc')
        ->where([
                    ['id','=',$request->id],
                    ['employee_id','=',$request->temp_employee_id],
                    ['is_active','=',1],
                ])    
        ->update(['status'=>1]);

        $temp_employee_notification=DB::table('temp_emp_notification')
        ->insert([
            'temp_emp_id'=>$request->temp_employee_id,
            'notification_title'=>'Document('.$request->doc_name.') is Approved',
            'notification_content'=>$request->message,
            'status'=>0,
            'is_active'=>1,
            'created_at'=>time()
            ]);

        $get_mail_id=DB::table('temp_employee')
        ->where('id',$request->temp_employee_id)
        ->first();
        $MAIL_BODY = '';
        $MAIL_LINK = url('/').'/temp_emp_dashboard';
        Mail::send(
            new NewNotificationAlert($get_mail_id->email, $get_mail_id->username, 'New Notification', $MAIL_BODY,$MAIL_LINK)
        );
        toast('Document Approved Successfully','success');
        $response['status']=1;
        return json_encode($response);
    }
    
    function reject_emp_doc(Request $request){
        $response=array();
        date_default_timezone_set("Asia/Calcutta");
        $temp_employee=DB::table('temp_emp_doc')
        ->where([
                    ['id','=',$request->id],
                    ['employee_id','=',$request->temp_employee_id],
                    ['is_active','=',1],
                ])         
        ->update(['is_active'=>0]);
        $temp_employee=DB::table('temp_emp_notification')
        ->insert([
            'temp_emp_id'=>$request->temp_employee_id,
            'notification_title'=>'Document('.$request->doc_name.') is Rejected, Please Resubmit it',
            'notification_content'=>$request->message,
            'status'=>0,
            'is_active'=>1,
            'created_at'=>time()
            ]);
        $get_mail_id=DB::table('temp_employee')
        ->where('id',$request->temp_employee_id)
        ->first();
        $MAIL_BODY = '';
        $MAIL_LINK = url('/').'/temp_emp_dashboard';
        Mail::send(
            new NewNotificationAlert($get_mail_id->email, $get_mail_id->username, 'New Notification', $MAIL_BODY,$MAIL_LINK)
        );
        toast('Document Rejected Successfully','success');
        $response['status']=1;
        return json_encode($response);
    }

    function reset_temp_emp_password(Request $request){
        $response=array();
        date_default_timezone_set("Asia/Calcutta");
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789!_";
        $password = substr(str_shuffle($chars), 0, 6);
        $hashed_password = Hash::make($password);
        $temp_employee=DB::table('temp_employee')
        ->where([
                    ['id','=',$request->temp_employee_id],
                    ['is_active','=',1],
                ])         
        ->update(['password'=>$hashed_password]);
        $temp_employee=DB::table('temp_emp_notification')
        ->insert([
            'temp_emp_id'=>$request->temp_employee_id,
            'notification_title'=>'Your Password Has Been Reset',
            'notification_content'=>'Please check mail',
            'status'=>0,
            'is_active'=>1,
            'created_at'=>time()
            ]);
        $get_mail_id=DB::table('temp_employee')
        ->where([
            ['id','=',$request->temp_employee_id],
            ['is_active','=',1],
        ])    
        ->first();
        $MAIL_BODY = $password;
        $MAIL_LINK = url('/').'/temp_emp_dashboard';
        Mail::send(
            new PasswordReset($get_mail_id->email, $get_mail_id->username, 'Password Reset', $MAIL_BODY,$MAIL_LINK)
        );
        //toast('Document Rejected Successfully','success');
        $response['status']=1;
        return json_encode($response);
    }

    function update_temp_emp_basic_info(Request $request){
        date_default_timezone_set("Asia/Calcutta");
        $status=array();
        $insert_basic_details=DB::table('temp_employee_details')
        ->where('temp_emp_id',$request->selected_temp_emp)
        ->where('is_active',1)
                            ->update([
                                'name_prefix'=>$request->e_name_prefix,
                                'f_name'=>$request->e_f_name,													
                                'l_name'=>$request->e_l_name,
                                'gender'=>$request->e_selected_gender,
                                'dob'=>strtotime($request->e_dob . " 00:00:00"),
                                'phone_number'=>$request->e_phone_no,
                                'emergency_number'=>$request->e_emergency_no,
                                'father_name'=>$request->e_father_name,
                                'mother_name'=>$request->e_mother_name,
                                'current_address'=>$request->e_current_address,
                                'parmanent_address'=>$request->e_parmanent_address,
                                'modified_at'=> time(),
                                'modified_by'=>Session::get('hr')->id,
                            ]);
        Alert::Success('Basic information details Updated Successfully')->position('top');
        return redirect('/manage_temp_emp?id='.Crypt::encrypt($request->selected_temp_emp));
    }
    
}
