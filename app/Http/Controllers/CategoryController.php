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
        $categories=Category::latest()->paginate(5);
//get deleted items
        $trashes = Category::onlyTrashed()->paginate(3);

        //relationship usingQueryBuilder
        //$categories = DB::table("categories")
        //->join('users','categories.user_id', 'users.id')
        //->select('categories.*','users.name')
        //->latest()->paginate(4);
        //$categories=DB::table("categories")->latest()->paginate(4);
        //$categories=DB::table("categories")->latest()->get();
        return view("admin.category.index",compact("categories","trashes"));
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

    public function Edit($id){
        $categories=DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit',compact('categories'));
    }

    //update function 
    public function Update(Request $request, $id){
        $data = array();
        $data['category_name']=$request->category_name;
        $data['user_id']=Auth::user()->id;
        DB::table('categories')->where('id',$id)->update($data);
        return Redirect()->route('all.category')->with('success','category Updated Successfully');
    }

    public function SoftDelete($id){
        $delete=Category::find($id)->delete();
        return Redirect()->back()->with('success',' Successfully moved to trash!');

    }

    public function Restore($id){
    $delete=Category::withTrashed()->find($id)->restore();
    return Redirect()->back()->with('success',' Successfully restored item!');
}

public function Delete($id){
    $delete=Category::onlyTrashed()->find($id)->forceDelete();
    return Redirect()->back()->with('success',' Successfully deleted item!');
}
}