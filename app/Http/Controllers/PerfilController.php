<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $images=Image::where('user_id',$user->id)
            ->orderBy('created_at','desc')->get();
        $friends=\Auth::user()->getFriends();
        $peticiones=\Auth::user()->getPendingFriendships();
        $users=User::all();
        return view('pages.perfil',['images'=>$images,'user'=>$user,'friends'=>$friends,'peticiones'=>$peticiones,'users'=>$users]);
    }
}
