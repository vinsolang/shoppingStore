<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $row = DB::table('category')->get();
        return view('backend.category.view-category',['row'=>$row]);
    }
    public function addCategory(){
        return view('backend.category.add-category');
    }
    public function sunmitCategory(Request $request){
        $name = $request -> input('name');
        $result = DB::table('category')->insert([
            'name' => $name
        ]);
        if($result){
            return redirect()->route('category.view');
        }
    }
    //=============  Update Category ============
    public function updateCategory($id){
        $row = DB::table('category')
                ->where('id',$id)
                ->get();
        return view('backend.category.update-category',['row'=>$row]);
    }
    public function submitUpdateCategory(Request $request){
        $id   = $request -> input('update_id');
        $name = $request -> input('update_name'); 

        $result = DB::table('category')
                ->where('id', $id)
                ->update(
                    ['name'=>$name]
                );
        if($result){
            return redirect()->route('category.view');
        }
    }
    //=============  Remove Category ============
    public function SubmiteRemoveCategory(Request $request){
        $remove_id = $request -> input('remove-id');
        
        $result = DB::table('category')
                ->where('id',$remove_id)
                ->delete();
        if($result){
            return redirect()->route('category.view');
        }
    }
}
