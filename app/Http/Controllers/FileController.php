<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image; //our db
use App\Models\File;

class FileController extends Controller
{
    //
    public function createForm(){
        $images = Image::all();
        return view('image-upload.create', compact('images'));
      }
    
    public function fileUpload(Request $req){
        $req->validate([
          'nama' => 'required',
          'imageFile' => 'required',
          'imageFile.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048'
        ]);
        if($req->hasfile('imageFile')) {
            foreach($req->file('imageFile') as $file)
            {
                $name = $file->getClientOriginalName();
                $file->move(public_path().'/uploads/', $name);  
                $imgData[] = $name;  
            }
            $fileModal = new Image();
            $fileModal->name = json_encode($imgData);
            $fileModal->image_path = json_encode($imgData);
            
           
            $fileModal->save();
           return back()->with('success', 'File has successfully uploaded!');
        }
    }

    /**
     * 
     * image upload versi 2
     * 
     */
    public function uploadsDua() {
        $images = File::all();
        return view('image-upload.create-images', compact('images'));
    }

    public function storeImages(Request $request) 
    {
        //
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'images' => 'required|array'
        ]);

        $images = [];

        foreach ($data['images'] as $image) {
            $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image_path =  $image->storeAs('images', $fileName,'public');

            array_push($images, $image_path);
        }
        
        $data['images'] = $images;

        File::create($data);
        return redirect()->route('create.images');
    }
}
