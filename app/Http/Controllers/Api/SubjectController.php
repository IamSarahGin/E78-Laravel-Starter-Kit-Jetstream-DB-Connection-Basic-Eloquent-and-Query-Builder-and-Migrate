<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
class SubjectController extends Controller
{
     //get data using ORM
     public function Index(){
        $subject=Subject::latest()->get();
        return response()->json($subject);
    }

    //for insert data
    public function Store(Request $request){
        //take data with validation
        $validateData=$request->validate([
            'class_id'=>'required',
            'subject_name'=>'required|unique:subjects|max:25',
            'subject_code'=>'required',
            ]);
        //orm insert method
        Subject::insert([
            'class_id'=>$request->class_id,
            'subject_name'=>$request->subject_name,
            'subject_code'=>$request->subject_code,
            ]);
            //return response
            return response('Student subject inserted successfully');    
    }

      //get data by id
      public function Edit($id){
        $subject=Subject::findOrFail( $id );
        return response()->json($subject);
    }

     //update data by id
     public function Update(Request $request, $id){
        Subject::findOrFail( $id )->update([
            'subject_name'=>$request->subject_name,
            ]);
            return response('Student subject updated!');
    }

    //get data by id
    public function Delete($id){
        $subject=Subject::findOrFail( $id )->delete();
        return response('Student subject Deleted!');
    }

}
