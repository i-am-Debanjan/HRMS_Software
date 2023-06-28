<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
Use Alert;
use Hash;
use Illuminate\Support\Facades\Log;

class Settings extends Controller
{
    function CreateEmpDocCategory(Request $request){
        $CreateEmpDocCategory = DB::table('emp_doc_category')
            ->insert([
                'doc_category_name' => $request->doc_category_name,
                'doc_category_details' => $request->doc_category_details,
                'is_active'=> 1,
                'created_at'=> time(),
                'modified_at'=> time(),

            ]);
            toast('Document Category <span class="text-danger font-weight-bold"> "'.$request->doc_category_name.'" </span> Added Successfully','success');
            return redirect('/doc_categories');
    }
}
