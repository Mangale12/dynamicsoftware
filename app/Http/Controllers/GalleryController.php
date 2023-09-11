<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Gallery;

class GalleryController extends Controller
{
    //
    public function index(){
        $medias = Gallery::get();
        return view('admin.media.gallery',compact('medias'));
    }

    public function create(){
        $categories = Category::get();
        return view('admin.media.create',compact('categories'));
    }
    public function store(Request $request){
        $gallery = new Gallery();
        if($request->hasFile('gallery_image')){
            foreach($request->file('gallery_image') as $key=>$image){
                $imageName  = time().$key.'.'.$image->extension();
                $image->move(public_path('uploads/category'),$imageName);
                Gallery::create([
                    'image'=>$imageName,
                    'category_id'=>$request->category,
                ]);
            }
        }
        return redirect()->route("gallery.index")->with("message","Images Addded Successfully");
    }

    public function edit(Gallery $gallery){

    }

    public function update(Gallery $gallery, Request $request){

    }
    public function destroy(Gallery $gallery){

    }

    public function delete(Request $request){
        $ids = $request->ids;
        $posts=Gallery::whereIn('id',$ids)->get();
        foreach ($posts as $key => $post) {
            $dell = Gallery::where('id', $post->id)->first();
            $featured = public_path('uploads/category/' . $post->image);
            if(file_exists($featured)){
                unlink($featured);
            }
        }
        return back()->with('message',"Image Deleted successfully.");
    }
    public function show(Gallery $gallery){

    }
}
