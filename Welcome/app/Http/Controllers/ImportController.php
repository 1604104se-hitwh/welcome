<?php

namespace App\Http\Controllers;

use App\Imports\MajorImport;
use App\Imports\StudentsImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function studentExcelImport(Request $request){
        if($request->hasFile('newsInfo') && $request->file('newsInfo')->isValid()){
            Excel::import(new StudentsImport, $request->file('newsInfo'));
            $array=array(
                "code" => 200,
                "msg" => "Saved!"
            );
            return response()->jsonp($request->input('callback'),$array);
        }
    }

    public function majorExcelImport(Request $request){
        if($request->hasFile('majorInfo') && $request->file('majorInfo')->isValid()){
            Excel::import(new MajorImport, $request->file('majorInfo'));
            $array=array(
                "code" => 200,
                "msg" => "Saved!"
            );
            return response()->jsonp($request->input('callback'),$array);
        }
    }
}
