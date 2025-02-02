<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Response;

class NewsController extends Controller
{
    public function news(){
        return view('backend.news.add-news');
    }
    public function viewNews(){
        $row = DB::table('news')->get();
        return view('backend.news.view-news',['row'=>$row]);
    }
    // Submit News Blog
    public function submitNews(Request $request){
        $title  	= $request -> input('title');
        $thumbnail  = $request -> file('thumbnail');
        $description       = $request -> input('description');

        $path       = './assets/image';
        $image      = time().'-'.$thumbnail->getClientOriginalName();
        $thumbnail  -> move($path, $image);

        $result     = DB::table('news')->insert([
            'title'       => $title,
            'thumbnail'   => $image,
            'description' => $description
        ]);

        if($result){
            return redirect()->route('news.view');
        }
    }
    public function updateNews($id){
        $row = DB::table('news')
             ->where('id', $id)
             ->get();

        return view('backend.news.update-news',['row'=>$row]);
    }
    public function submitUpdateNews(Request $request){
        $update_id          = $request -> input('update_id');
        $update_title       = $request -> input('update_title');
        $update_thumbnail   = $request -> file('update_thumbnail');
        $old_thumbnail      = $request -> input('old_thumbnail');
        $update_description = $request -> input('update_description');

        $ImagePath          = './assets/image';
        if($update_thumbnail){
            $imageThumbnail     = time().'-'.$update_thumbnail->getClientOriginalName();
            $update_thumbnail   -> move($ImagePath, $imageThumbnail);
        }elseif($old_thumbnail){
            $imageThumbnail = $old_thumbnail;
        }else{
            return back()->withErrors('Error', 'Upload to file field');
        }

        $result             = DB::table('news')
                            -> where('id', $update_id)
                            -> update([
                                'title'       => $update_title,
                                'description' => $update_description,
                                'thumbnail'   => $imageThumbnail
                            ]);
        if($result){
            return redirect()->route('news.view');
        }
                            
    }
    // Remove News Blog
    public function submitRemoveNews(Request $request){
        $id = $request -> input('remove-id');

        $result = DB::table('news')->where('id', $id)->delete();

        if($result){
            return redirect()->route('news.view');
        }
    }
}
