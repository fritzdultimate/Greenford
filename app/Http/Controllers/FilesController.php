<?php

namespace App\Http\Controllers;
use App\Models\Properties;
use App\Models\PropertyPictures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function properties(Request $request) {

        // return 'here';
        // $request->validate([
        //     'picture_url' => 'required',
        //     'picture_url.*' => 'required|mimes:jpg,jpeg,png,tif|max:2048',
        // ]);
      
        $files = [];
        if ($request->file('picture_url')){
            // return 'yes';
            foreach($request->file('picture_url') as $key => $file)
            {
                $fileName = time().rand(1,99).'.'.$file->extension();  
                $file->move(public_path('properties'), $fileName);
                $files[]['picture_url'] = $fileName;
            }
        }

        $slug_data = $request->property_name . ' ' .  time().rand(1,4) . ' ' . date('Y m d h s');
        // return Str::slug($slug_data);
        $property = Properties::create(
            [
                'name' => $request->property_name,
                'location' => $request->location,
                'status' => $request->status,
                'type' => $request->type,
                'size' => $request->size,
                'baths' => $request->baths,
                'rooms' => $request->rooms,
                'beds' => $request->beds,
                'garages' => $request->garages,
                'year_built' => $request->year_built,
                'lot_area' => $request->lot_area,
                'home_area' => $request->home_area,
                'lot_dimention' => $request->lot_dimension,
                'price' => $request->price,
                'description' => $request->description,
                'youtube_video' => $request->youtube_video,
                'video_tour' => $request->video_tour,
                'slug' => Str::slug($slug_data)
            ]
        );
  
        foreach ($files as $key => $file) {
            // return $property->id;
            PropertyPictures::create([
                'property_id' => $property->id,
                'picture_url' => $file['picture_url'],
            ]);
        }

        return 'stored';
     
        // return back()
            // ->with('success','You have successfully upload file.');
    }

}
