<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;


class ImageController extends Controller
{
    public function store(Request $request){
        $this->validate($request,[
            'title' => 'required',
            'path' => 'required'
        ]);
                
        $image = new Image();
        $file = $request->file('image');
        $fileName = $file->getClientOriginalName() ;
        $file->move(public_path().'/images/',$fileName);
        $image->user_id = Auth()->id();
        $image->title = $request['title'];
        $image->path = '/public/images/'.$fileName;
        $image->save();
        return redirect('/')->with('success' , 'save ax halle :))) ');
    }
    public function show($id){
        $image = Image::find($id);
        return view('show')->with('image' , $image);
    }
    public function destroy($id){
        $image = Image::find($id);

        if(Storage::delete('public/images/'.$image->path)) {
            $image->delete();        
            return redirect('/')->with('success' , 'hazfe ax halle :))) ');
        } 
    }
}
