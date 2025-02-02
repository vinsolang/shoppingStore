<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct(){
        $row = DB::table('category')->orderByDesc('id')->get(['id','name']);
        return view('backend.product.add-product',['row'=>$row]);
    }
    public function viewProduct(){
        $row = DB::table('product')
            ->join('category','product.category_id', '=' , 'category.id')
            ->join('users','product.author_id', '=' , 'users.id')
            ->select('product.*','category.name AS cat_name','users.name AS user_name')
            ->orderBy('product.id' ,'DESC')
            ->get();
        return view('backend.product.view-product',['row'=>$row]);
    }
    public function submitProduct(Request $request){
       
        $name           = $request -> input('name');
        $qty            = $request -> input('qty');
        $regular_price  = $request -> input('regular_price');
        $sale_price     = $request -> input('sale_price');
        $size           = $request -> input('size');
        $color          = $request -> input('color');
        $category       = $request -> input('category');
        $thumbnail      = $request -> file('thumbnail');
        $desc           = $request -> input('description');

        $colorJson  	= json_encode($color);
        $sizeJson       = json_encode($size);

        $path  = './assets/image';
        $image = time().'-'.$thumbnail->getClientOriginalName();
        $thumbnail->move($path, $image);


        $result = DB::table('product')->insert([
            'name'          => $name,
            'regular_price' => $regular_price,
            'sale_price'    => $sale_price,
            'qty'           => $qty,
            'thumbnail'     => $image,
            'color'         => $colorJson,
            'size'          => $sizeJson,
            'description'   => $desc,
            'category_id'   => $category,
            'views'         => 0,
            'author_id'     => Auth::user()->id
        ]);
        if($result){
            return redirect()->route('product.view');
        }
    }
    // Update product 
    public function updateProduct($id){
        $row = DB::table('product')
            ->join('category','product.category_id','=', 'category.id')
            ->select('product.*','category.id AS cat_id','category.name AS cat_name')
            ->where('product.id',$id)
            ->get();
        $category = DB::table('category')->where('id', $id)->get();
        return view('backend.product.update-product',['row'=>$row, 'category'=>$category]);

    }
    public function submitUpdateProduct(Request $request){
        $update_id             = $request -> input('update_id');
        $update_name           = $request -> input('update_name');
        $update_regular_price  = $request -> input('update_regular_price');
        $update_sale_price     = $request -> input('update_sale_price');
        $update_qty            = $request -> input('update_qty');
        $update_color          = $request -> input('update_color');
        $update_size           = $request -> input('update_size');
        $update_description    = $request -> input('update_description');
        $update_category       = $request -> input('update_category');
        $update_thumbnail      = $request -> file('update_thumbnail');
        $old_thumbnail         = $request -> input('old_thumbnail');

        $update_colorJson      = json_encode($update_color);
        $update_sizeJson       = json_encode($update_size);
        
        // upload thumbnail to folder
        $path_thumbnail        = './assets/image';
        if($update_thumbnail){
            $image_thumbnail       = time().'-'.$update_thumbnail->getClientOriginalName();
            $update_thumbnail      -> move($path_thumbnail, $image_thumbnail);
        }elseif($old_thumbnail){
            $image_thumbnail = $old_thumbnail;
        }else{
            return back()->withErrors('error ', 'Upload image to file field');
        }

        $result                = DB::table('product')
                               ->where('id',$update_id)
                               ->update([
                                    'name'          => $update_name,
                                    'regular_price' => $update_regular_price,
                                    'sale_price'    => $update_sale_price,
                                    'qty'           => $update_qty,
                                    'thumbnail'     => $image_thumbnail,
                                    'color'         => $update_colorJson,
                                    'size'          => $update_sizeJson,
                                    'description'   => $update_description,
                                    'category_id'   => $update_category
                               ]);
        if($result){
            return redirect()->route('product.view');
        } 
    }
    // remove product
    public function submitRemove(Request $request){
        $remove_id = $request -> input('remove-id');

        $result = DB::table('product')
                ->where('id', $remove_id)
                ->delete();

        if($result){
            return redirect()->route('product.view');
        }
    }
}

