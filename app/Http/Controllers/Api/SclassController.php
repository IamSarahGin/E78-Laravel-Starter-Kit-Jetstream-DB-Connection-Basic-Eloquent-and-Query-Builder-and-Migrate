<?php

namespace App\Http\Controllers\Api;
use App\Models\Sclass;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SclassController extends Controller
{
    //get data using ORM
    public function Index(){
        $sclass=Sclass::latest()->get();
        return response()->json($sclass);
    }

    //for insert data
    public function Store(Request $request){
        //take data with validation
        $validateData=$request->validate([
            'class_name'=>'required|unique:sclasses|max:25'
            ]);
        //orm insert method
        Sclass::insert([
            'class_name'=>$request->class_name,
            
            ]);
            //return response
            return response('Student class inserted successfully');    
    }

    //get data by id
    public function Edit($id){
        $sclass=Sclass::findOrFail( $id );
        return response()->json($sclass);
    }

    //update data by id
    public function Update(Request $request, $id){
        Sclass::findOrFail( $id )->update([
            'class_name'=>$request->class_name,
            ]);
            return response('Student class updated!');
    }

    //get data by id
    public function Delete($id){
        $sclass=Sclass::findOrFail( $id )->delete();
        return response('Student class Deleted!');
    }

}
