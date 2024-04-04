<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class CategoryController extends Controller
{
    //calls index page
    public function AllCat(){
        //$categories = Category::all();
        //$categories = Category::latest()->get();
        //pagination
        //$categories=Category::latest()->paginate(4);
        //relationship usingQueryBuilder
        $categories = DB::table("categories")
        ->join('users','categories.user_id', 'users.id')
        ->select('categories.*','users.name')
        ->latest()->paginate(4);
        //$categories=DB::table("categories")->latest()->paginate(4);
        //$categories=DB::table("categories")->latest()->get();
        return view("admin.category.index",compact("categories"));
    }
    //add category
    public function AddCat(Request $request){
        //$validatedData= $request->validate(
          //  [
            //    'category_name'=> 'required|unique:categories|max:20',   
            //],            
            //);
            //customized validation
            $validatedData= $request->validate(
            [
                'category_name'=> 'required|unique:categories|max:20',   
            ],
            [
                'category_name.required'=>'Please enter category name',
                'category_name.max'=>'Maximum character is 15',    
            ]
            );
            //eloquent insertion
            //Category::insert([
              //  'category_name'=> $request->category_name,
                //'user_id'=>Auth::user()->id,
                //'created_at'=>Carbon::now(),
                //]);
            //another eloquent    
            //$category = new Category;
            //$category->category_name=$request->category_name ;     
            //$category->user_id=Auth::user()->id;
            //$category->save();    
            
            
            //Query Builder
            $data=array();
            $data['category_name']=$request->category_name ;
            $data['user_id']=Auth::user()->id;
            $data['created_at']=Carbon::now();
            DB::table('categories')->insert($data);

            //adds redirect and go back to page with session
            return Redirect()->back()->with('success','Category Inserted Successfully');
    }
}
