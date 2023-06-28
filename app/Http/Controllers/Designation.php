<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
Use Alert;

class Designation extends Controller
{
    function CreateDesignation(Request $request){
        $check_designation =  DB::table('designation')
        ->where('designation.name','=',$request->designation_name)
        ->first();
        if(!$check_designation >0){
        $add_designation = DB::table('designation')
            ->insert([
                'name' => $request->designation_name,
                'is_active'=> 1,
                'created_at'=> time(),
                'modified_at'=> time(),

            ]);
            toast('Designation <span class="text-danger font-weight-bold">" '.$request->designation_name.' "</span> Added Successfully','success');
            return redirect('/designations');
        }else{
            toast('Designation is Already Available','warning');
            return redirect('/designations');
        }
    }
    function UpdateDesignation(Request $request){
        $check_designation =  DB::table('designation')
        ->where('designation.name','=',$request->e_designation_name)
        ->first();
        if(!$check_designation >0){
        $edit_designation = DB::table('designation')
            ->where('designation.id','=',$request->e_designation_id)
            ->Update([
                'name' => $request->e_designation_name,
                'modified_at'=> time(),

            ])
           ;
            toast('Designation Updated to <span class="text-danger font-weight-bold">'.$request->e_designation_name.' </spam>','info');
            return redirect('/designations');
        }else{
            toast('Designation is Already Available','error');
            return redirect('/designations');
        }
    }
}
