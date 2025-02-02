<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class ClientShoppingController extends Controller
{
    public function index(){
        $listLatestProduct = DB::table('product')
                            ->orderBy('id','DESC')
                            ->limit(4)
                            ->get();
        
        $listPromotionProduct = DB::table('product')
                            ->whereRaw('sale_price < regular_price')
                            ->limit(4)
                            ->get();
        $PopularProduct = DB::table('product')
                            ->orderBy('views','DESC')
                            ->limit(4)
                            ->get();
        $showLogo = DB::table('logo')->get();
        // Return $listPromotionProduct 
        return view('frontend.home',['listLatestProduct'=>$listLatestProduct,'listPromotionProduct'=>$listPromotionProduct,'PopularProduct'=>$PopularProduct,'showLogo'=>$showLogo]);
    }
    public function shops(Request $request){
        $shop = DB::table('product')
                ->get();
        $showLogo = DB::table('logo')->get();
        // Sort by price
        $query = DB::table('product');
        if($request->has('price')){
            if($request->price == 'max'){
                $query = DB::table('product')->orderBy('regular_price', 'DESC');
            } else if($request->price =='min'){
                $query = DB::table('product')->orderBy('regular_price', 'ASC');
            }
        }
        // Sort by sale price
        if($request->has('sale_price')){
            if($request->price == 'max'){
                $query = DB::table('product')->orderBy('sale_price', 'DESC')->get();
            } else if($request->price == 'min'){
                $query = DB::table('product')->orderBy('sale_price', 'ASC')->get();
            }
        }
        return view('frontend.shop',['showLogo'=>$showLogo,'shop'=>$shop,'query'=>$query]);
    }
    public function product($id){
        DB::table('product')
                ->where('id', $id)
                ->increment('views',1);
        $row = DB::table('product')
                ->where('id', $id)  
                ->get();
        $relatedProduct = DB::table('product')
                ->where('id','<>',$id)
                ->where('category_id',$row[0]->category_id)
                ->get();
        $showLogo = DB::table('logo')->get();
        return view('frontend.product_detail',['row'=>$row,'relatedProduct'=>$relatedProduct,'showLogo'=>$showLogo]);
    }
    public function news(){
        $row = DB::table('news')
                ->orderBy('id','DESC')
                ->limit(4)
                ->get();
        $showLogo = DB::table('logo')->get();
        return view('frontend.news',['row'=>$row,'showLogo'=>$showLogo]);   
    }
    public function news_detail($id){
        DB::table('news')
            ->where('id',$id)
            ->increment('views',1);
        $row = DB::table('news')
            ->where('id',$id)
            ->get();
        $showLogo = DB::table('logo')->get();
        
        return view('frontend.news_detail',['row'=>$row,'showLogo'=>$showLogo]);
    }
    // Search product
    public function search(Request $request){
        $searchProduct = $request->input('name');
        $showLogo = DB::table('logo')->get();
        $search = DB::table('product')->whereLike('name','%'.$searchProduct.'%')->get();
        return view('frontend.search',['showLogo'=>$showLogo,'search'=>$search]);
    }
}
