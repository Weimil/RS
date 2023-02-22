<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
        return view('pages.subirImage');
    }

    public function mostrar()
    {
        $images = [];
        foreach (Storage::disk('images_DB')->files() as $file) {
            $images[] = asset(Storage::disk('images_DB')->url($file));
        }
        return $images;
    }

    public function save(Request $request)
    {

        $image_path = $request->file('image');
        $descripcion = $request->input('descripcion');

        $user = Auth::user();

        $image = new Image();
        $image->user_id = $user->id;
        $image->description = $descripcion;
        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images_DB')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }
        $image->save();
        return redirect()->route('dashboard');
    }

    public function detalle($id)
    {
        $image=Image::where('id',$id)->first();
        return view('pages.detalleImg',['image'=>$image]);
    }
    public function delete(Request $request){
        $imageID=$request->input('imageID');
        Like::where('image_id',$imageID)->delete();
        Comment::where('image_id',$imageID)->delete();
        Image::where('id',$imageID)->delete();
        return redirect()->route('perfil');
    }
}
