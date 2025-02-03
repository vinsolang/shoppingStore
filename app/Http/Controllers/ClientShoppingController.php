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
        // Get the 'cat' parameter and replace hyphens with spaces
        $categoryName = str_replace('-', ' ', $request->query('cat'));
        $priceOrder = $request->query('price');
        $promotion = $request->query('promotion');

        // Prepare lowercase parameters
        $lowercaseParams = [
            'cat' => $categoryName ? strtolower($categoryName) : null,
            'price' => $priceOrder ? strtolower($priceOrder) : null,
            'promotion' => $promotion ? strtolower($promotion) : null,
        ];

        // Redirect to a cleaned-up URL if necessary (to ensure lowercase params)
        if ($categoryName && $categoryName !== $lowercaseParams['cat']) {
            return redirect()->route('shop', array_filter($lowercaseParams));
        }

        // Base query for products
        $query = DB::table('product')
            ->join('category', 'product.Category_id', '=', 'category.id')
            ->select('product.*');

        // Filter by category
        if ($lowercaseParams['cat']) {
            $query->where(DB::raw('LOWER(category.name)'), '=', $lowercaseParams['cat']);
        }

        // Sorting by price
        if ($lowercaseParams['price'] === 'max') {
            $query->orderBy('product.regular_price', 'DESC');
        } elseif ($lowercaseParams['price'] === 'min') {
            $query->orderBy('product.regular_price', 'ASC');
        } else {
            $query->orderBy('product.id', 'DESC');
        }

        // Filter for promotion products if 'promotion' is true
        if ($lowercaseParams['promotion'] === 'true') {
            $query->whereColumn('product.sale_price', '<', 'product.regular_price');
        }

        $products = $query->paginate(9);

        $categories = DB::table('category')->get();
        return view('frontend.shop',['showLogo'=>$showLogo,'shop'=>$shop,'query'=>$query,'products'=>$products,'categories'=>$categories,'currentCategory'=>$lowercaseParams['cat']]);
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
