<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;



class LogoController extends Controller
{
    
    public function viewLogo(){
        $row = DB::table('logo')
                ->get();
        return view('backend.logo.view-logo',['row'=>$row]);
    }
    public function logoAdd(){
        return view('backend.logo.add-logo');
    }
    public function submitLogo(Request $request){
        $name      = $request -> input('name');
        $thumbnail = $request -> file('thumbnail');

        $path  = './assets/image';
        $image = time().'-'.$thumbnail->getClientOriginalName();
        $thumbnail->move($path, $image);
        
        $result = DB::table('logo')->insert([
            'name'      => $name,
            'thumbnail' => $image
        ]);
        if($result){
            return redirect()->route('logo.view');
        }
    }
    // Update Logo
    public function updateLogo($id){
        $row = DB::table('logo')
                ->where('id', $id)
                ->get();
        return view('backend.logo.update-logo',['row'=>$row]);
    }
    public function submitUpdateLogo(Request $request){
        $update_id          = $request -> input('update_id');
        $update_name        = $request -> input('update_name');
        $update_thumbnail   = $request -> file('update_thumbnail');
        $old_thumbnail      = $request -> input('old_thumbnail');
        
        $ImagePath = './assets/image';
        if($update_thumbnail){
            $image_thumbnail = time().'-'.$update_thumbnail->getClientOriginalName();
            $update_thumbnail->move($ImagePath, $image_thumbnail);
        }elseif($old_thumbnail){
            $image_thumbnail = $old_thumbnail;
        }

        $result = DB::table('logo')
                ->where('id', $update_id)
                ->update([
                    'name' => $update_name,
                    'thumbnail' => $image_thumbnail
                ]);
        if($result){
            return redirect()->route('logo.view');
        }

    }
    public function submitRemoveLogo(Request $request){
        $remove_id = $request -> input('remove-id');

        $result    = DB::table('logo')
                    ->where('id',$remove_id)
                    ->delete();
        if($result){
            return redirect()->route('logo.view');
        }
    }
}
