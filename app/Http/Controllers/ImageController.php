<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
        return view('pages.upload_image');
    }

    public function show()
    {
        $images = [];

        foreach (Storage::disk('images_DB')->files() as $file) {
            $images[] = asset(Storage::disk('images_DB')->url($file));
        }

        return $images;
    }

    public function save(Request $request)
    {
        $path = $request->file('image');
        $image = new Image();

        $image->{Image::USER_ID} = Auth::user()->{User::ID};
        $image->{Image::DESCRIPTION} = $request->input('description');

        if ($path) {
            $pathName = time() . $path->getClientOriginalName();
            Storage::disk('images_DB')->put($pathName, File::get($path));
            $image->{Image::IMAGE_PATH} = $pathName;
        }


        $image->save();

        return redirect()->route('dashboard');
    }

    public function detail($id)
    {
        return view('pages.detail_image', ['image' => Image::query()->where(Image::ID, $id)->first()]);
    }

    public function delete(Request $request)
    {
        $imageId = $request->input('image_id');

        Like::query()->where(Like::IMAGE_ID, $imageId)->delete();
        Comment::query()->where(Comment::IMAGE_ID, $imageId)->delete();
        Image::query()->where(Image::ID, $imageId)->delete();

        return redirect()->route('profile');
    }
}
