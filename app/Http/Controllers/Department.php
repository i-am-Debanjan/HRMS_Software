<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
Use Alert;

class Department extends Controller
{
    function CreateDepartment(Request $request){
        $add_department = DB::table('department')
            ->insert([
                'name' => $request->department_name,
                'is_active'=> 1,
                'created_at'=> time(),
                'modified_at'=> time(),

            ]);
            toast('Department <span class="text-danger font-weight-bold"> "'.$request->department_name.'" </span> Added Successfully','success');
            return redirect('/departments');
    }
    function UpdateDepartment(Request $request){
        $add_department = DB::table('department')
            ->where('department.id','=',$request->e_department_id)
            ->Update([
                'name' => $request->e_department_name,
                'modified_at'=> time(),

            ])
           ;
            toast('Department Updated to <span class="text-danger font-weight-bold">'.$request->e_department_name.' </span>','info');
            return redirect('/departments');
    }
}
