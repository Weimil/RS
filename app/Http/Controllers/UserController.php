<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected function userPerfil($userID)
    {
        $user=User::where('id',$userID)->get();
        $images=Image::where('user_id',$userID)->get();
        return view('pages.userPerfil',['user'=>$user[0],'images'=>$images]);
    }
    protected function gente()
    {
        $users=User::orderBy('created_at','desc')->get();
        $friends=\Auth::user()->getFriends();
        $pending=\Auth::user()->getPendingFriendships();
        return view('pages.users',['users'=>$users,'friends'=>$friends,'pending'=>$pending]);
    }
    protected function search(Request $request)
    {
        $buscar=$request->input('buscar');
        $users=User::where('name', 'like', '%'.$buscar.'%')
            ->orWhere('user_name', 'like', '%'.$buscar.'%')
            ->orWhere('surname', 'like', '%'.$buscar.'%')->get();
        return view('pages.users',['users'=>$users]);
    }
    protected function send(Request $request)
    {
        $recipient=$request->input('recipient');
        $recipient=User::all()->find($recipient);
        \Auth::user()->befriend($recipient);
       return $this->gente();
    }
    protected function cancel(Request $request)
    {
        $recipient=$request->input('recipient');
        $sender=$request->input('sender');
        DB::table('friendships')
            ->where('recipient_id',$recipient)
            ->where('sender_id',$sender)
        ->delete();
        return $this->gente();
    }
    protected function aceptar(Request $request)
    {
        $senderid=$request->input('sender');
        $sender=User::all()->find($senderid);
        \Auth::user()->acceptFriendRequest($sender);
        return $this->gente();
    }
    protected function denegar(Request $request)
    {
        $senderid=$request->input('sender');
        $sender=User::all()->find($senderid);
        \Auth::user()->denyFriendRequest($sender);
        return $this->gente();
    }
}
