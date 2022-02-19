<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\Dialog;
use App\Models\Message;
use App\Models\Friends;

use Illuminate\Support\Facades\Route;

class MainController extends Controller
{
    public function welcome() {
        $mess = new Message();
        $dialog = Dialog::where('user_1', '=', auth()->user()->id)->orWhere('user_2', '=', auth()->user()->id)->orderBy('id', 'desc')->get();
        $dialog_count = Dialog::where('user_1', '=', auth()->user()->id)->orWhere('user_2', '=', auth()->user()->id)->count();
        $users = new User();
        $user_details = new UserDetails();
        $message = new Message();
        $date_str = date('h').':'.date('i')-1;
        if(strlen($date_str) == 4) {
            $date_full = substr_replace($date_str, '0', 3, 0);
            $date = $date_full.':'.date('s');
        } else {
            $date = date('h').':'.date('i').':'.date('s');
        }
        return view('welcome', ['dialog' => $dialog, 'users' => $users->all(), 'user_details' => $user_details, 'dialog_count' => $dialog_count, 'message' => $message, 'date' => $date]);
    }
    
    public function friends() {
        $my_friends = Friends::where('add_friends_id', '=', auth()->user()->id)->orWhere('app_friends_id', '=', auth()->user()->id)->get();
        $my_friends_count = Friends::where('add_friends_id', '=', auth()->user()->id)->orWhere('app_friends_id', '=', auth()->user()->id)->count();
        $users = new User();
        $user_details = new UserDetails();
        return view('friends', ['my_friends' => $my_friends, 'users' => $users->all(), 'user_details' => $user_details, 'my_friends_count' => $my_friends_count]);        
    }

    public function chat($id) {
        $users = User::find($id);
        $my_dialog_count = Dialog::where([
            ['user_1', '=', auth()->user()->id],
            ['user_2', '=', $id]
        ])->orWhere([
            ['user_1', '=', $id],
            ['user_2', '=', auth()->user()->id]
        ])->count();
        if($my_dialog_count != 0) {
            $my_dialog = Dialog::where([
                ['user_1', '=', auth()->user()->id],
                ['user_2', '=', $id]
            ])->orWhere([
                ['user_1', '=', $id],
                ['user_2', '=', auth()->user()->id]
            ])->first();
            $mess = Message::where('location', '=', $my_dialog->id)->get();
            return view('chat', ['users' => $users->find($id), 'my_dialog_count' => $my_dialog_count, 'mess' => $mess]);
        } else {
            return view('chat', ['users' => $users->find($id), 'my_dialog_count' => $my_dialog_count]);
        }
        
    }

    public function chat_message($id) {
        $users = User::find($id);
        $my_dialog_count = Dialog::where([
            ['user_1', '=', auth()->user()->id],
            ['user_2', '=', $id]
        ])->orWhere([
            ['user_1', '=', $id],
            ['user_2', '=', auth()->user()->id]
        ])->count();
        if($my_dialog_count != 0) {
            $my_dialog = Dialog::where([
                ['user_1', '=', auth()->user()->id],
                ['user_2', '=', $id]
            ])->orWhere([
                ['user_1', '=', $id],
                ['user_2', '=', auth()->user()->id]
            ])->first();
            $mess = Message::where('location', '=', $my_dialog->id)->get();
            return view('message', ['users' => $users->find($id), 'my_dialog_count' => $my_dialog_count, 'mess' => $mess]);
        } else {
            return view('message', ['users' => $users->find($id), 'my_dialog_count' => $my_dialog_count]);
        }
    }

    public function search_friends() {
        $users = new User();
        $user_details = new UserDetails();
        $my_friends = Friends::where('add_friends_id', '=', auth()->user()->id)->orWhere('app_friends_id', '=', auth()->user()->id);
        $f = new Friends();
        return view('search_friends', ['users' => $users->all(), 'user_details' => $user_details->all(), 'my_friends' => $my_friends, 'f' => $f]);
    }

    public function message(Request $data) {
        $valid = $data -> validate([
            'text' => ['required'],
        ]);

        $my_dialog_count1 = Dialog::where([
            ['user_1', '=', auth()->user()->id],
            ['user_2', '=', $data->input('user_2')]
        ])->orWhere([
            ['user_1', '=', $data->input('user_2')],
            ['user_2', '=', auth()->user()->id]
        ])->count();

        if($my_dialog_count1 == 0){
            $dialog = new Dialog();
            $dialog->user_1 = auth()->user()->id;
            $dialog->user_2 = $data->input('user_2');
            $dialog->save();
        }

        $my_dialog = Dialog::where([
            ['user_1', '=', auth()->user()->id],
            ['user_2', '=', $data->input('user_2')]
        ])->orWhere([
            ['user_1', '=', $data->input('user_2')],
            ['user_2', '=', auth()->user()->id]
        ])->first();

        $message = new Message();
        $message->sender = auth()->user()->id;
        $message->location = $my_dialog->id;
        $message->text = $data->input('text');
        $message->save();
        return redirect()->route('chat', $data->input('user_2'));
    }

    public function new_friends($id) {
        $friends = new Friends();
        $friends->add_friends_id = auth()->user()->id;
        $friends->app_friends_id = $id;
        $friends->save();
        
        return redirect()->route('search_friends');
    }

    public function new_friends_profile($id) {
        $friends = new Friends();
        $friends->add_friends_id = auth()->user()->id;
        $friends->app_friends_id = $id;
        $friends->save();
        
        return redirect()->route('other_profile', $id);
    }

    public function settings() {
        return view('settings');
    }

    public function other_profile($id) {
        $user = User::find($id);
        $user_details = UserDetails::where('user_id', '=', $id)->first();
        $user_details_count = UserDetails::where('user_id', '=', $id)->count();
        $my_friends_count = Friends::where('add_friends_id', '=', $id)->orWhere('app_friends_id', '=', $id)->count();
        $my_friends = Friends::where([['add_friends_id', '=', $id], ['app_friends_id', '=', auth()->user()->id]])->orWhere([['app_friends_id', '=', $id], ['add_friends_id', '=', auth()->user()->id]])->count();
        return view('other_profile', ['user' => $user, 'user_details' => $user_details, 'user_details_count' => $user_details_count, 'my_friends_count' => $my_friends_count, 'my_friends' => $my_friends]);
    }

    public function delete_friends($id) {
        Friends::where([['add_friends_id', '=', $id], ['app_friends_id', '=', auth()->user()->id]])->orWhere([['app_friends_id', '=', $id], ['add_friends_id', '=', auth()->user()->id]])->delete();
        return redirect()->route('other_profile', $id);
    }
}
