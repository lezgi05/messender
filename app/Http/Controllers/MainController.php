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
        $user_details = UserDetails::where('user_id', '=', $id)->first();
        $user_details_count = UserDetails::where('user_id', '=', $id)->count();
        $my_dialog_count = Dialog::where([
            ['user_1', '=', auth()->user()->id],
            ['user_2', '=', $id]
        ])->orWhere([
            ['user_1', '=', $id],
            ['user_2', '=', auth()->user()->id]
        ])->count();
        $my_dialog = Dialog::where([
            ['user_1', '=', auth()->user()->id],
            ['user_2', '=', $id]
        ])->orWhere([
            ['user_1', '=', $id],
            ['user_2', '=', auth()->user()->id]
        ])->first();
        if($my_dialog_count != 0) {
            $mess = Message::where('location', '=', $my_dialog->id)->get();
            $read_mess = Message::where([['location', '=', $my_dialog->id], ['sender', '=', $id], ['read', '=', false]])->get();
            foreach($read_mess as $read) {
                $read->read = true;
                $read->save();
            }            
            return view('chat', ['users' => $users, 'user_details' => $user_details, 'user_details_count' => $user_details_count, 'my_dialog' => $my_dialog, 'my_dialog_count' => $my_dialog_count, 'mess' => $mess]);
        } else {
            return view('chat', ['users' => $users, 'user_details' => $user_details, 'user_details_count' => $user_details_count, 'my_dialog' => $my_dialog, 'my_dialog_count' => $my_dialog_count]);
        }
    }

    public function chat_message($id) {
        $my_dialog = Dialog::find($id);
        if($my_dialog->user_1 != auth()->user()->id){
            $users = User::find($my_dialog->user_1);
        } else {
            $users = User::find($my_dialog->user_2);
        }
        $my_dialog_count = Dialog::find($id)->count();
        if($my_dialog_count != 0) {
            $mess = Message::where('location', '=', $my_dialog->id)->get();
            return view('message', ['users' => $users, 'my_dialog_count' => $my_dialog_count, 'mess' => $mess, 'my_dialog' => $my_dialog, 'users' => $users]);
        } else {
            return view('message', ['users' => $users, 'my_dialog_count' => $my_dialog_count]);
        }
    }

    public function search_friends() {
        $users = new User();
        $user_details = new UserDetails();
        $my_friends = Friends::where('add_friends_id', '=', auth()->user()->id)->orWhere('app_friends_id', '=', auth()->user()->id);
        $f = new Friends();
        return view('search_friends', ['users' => $users->all(), 'user_details' => $user_details->all(), 'my_friends' => $my_friends, 'f' => $f]);
    }

    public function message($id, Request $data) {
        $valid = $data -> validate([
            'text' => ['required'],
        ]);

        $my_dialog_count1 = Dialog::where([
            ['user_1', '=', auth()->user()->id],
            ['user_2', '=', $id]
        ])->orWhere([
            ['user_1', '=', $id],
            ['user_2', '=', auth()->user()->id]
        ])->count();

        if($my_dialog_count1 == 0){
            $dialog = new Dialog();
            $dialog->user_1 = auth()->user()->id;
            $dialog->user_2 = $id;
            $dialog->save();
        }

        $my_dialog = Dialog::where([
            ['user_1', '=', auth()->user()->id],
            ['user_2', '=', $id]
        ])->orWhere([
            ['user_1', '=', $id],
            ['user_2', '=', auth()->user()->id]
        ])->first();

        $message = new Message();
        $message->sender = auth()->user()->id;
        $message->location = $my_dialog->id;
        $message->text = $data->input('text');
        $message->read = false; 
        $message->save();
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
        if($user_details_count != 0) {
            if($user_details->mounth != '') {
                $mounth_figure = $user_details->mounth;
                if($mounth_figure == 01) {
                    $mounth = 'января';
                } elseif($mounth_figure == 02) {
                    $mounth = 'февраля';
                } elseif($mounth_figure == 03) {
                    $mounth = 'марта';
                } elseif($mounth_figure == 04) {
                    $mounth = 'апреля';
                } elseif($mounth_figure == 05) {
                    $mounth = 'мая';
                } elseif($mounth_figure == 06) {
                    $mounth = 'июня';
                } elseif($mounth_figure == 07) {
                    $mounth = 'июля';
                } elseif($mounth_figure == 8) {
                    $mounth = 'августа';
                } elseif($mounth_figure == 9) {
                    $mounth = 'сентября';
                } elseif($mounth_figure == 10) {
                    $mounth = 'октября';
                } elseif($mounth_figure == 11) {
                    $mounth = 'ноября';
                } elseif($mounth_figure == 12) {
                    $mounth = 'декабря';
                }
                return view('other_profile', ['user' => $user, 'user_details' => $user_details, 'user_details_count' => $user_details_count, 'my_friends_count' => $my_friends_count, 'my_friends' => $my_friends, 'mounth' => $mounth]);
            } else {
                return view('other_profile', ['user' => $user, 'user_details' => $user_details, 'user_details_count' => $user_details_count, 'my_friends_count' => $my_friends_count, 'my_friends' => $my_friends]);
            }
        } else {
            return view('other_profile', ['user' => $user, 'user_details' => $user_details, 'user_details_count' => $user_details_count, 'my_friends_count' => $my_friends_count, 'my_friends' => $my_friends]);
        }
    }

    public function delete_friends($id) {
        Friends::where([['add_friends_id', '=', $id], ['app_friends_id', '=', auth()->user()->id]])->orWhere([['app_friends_id', '=', $id], ['add_friends_id', '=', auth()->user()->id]])->delete();
        return redirect()->route('other_profile', $id);
    }

    public function exit_mess($id, $exit_mess) {
        $exit_mess = Message::where('id', '=', $exit_mess)->first();
        $users = User::find($id);
        $user_details = UserDetails::where('user_id', '=', $id)->first();
        $user_details_count = UserDetails::where('user_id', '=', $id)->count();
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
            $read_mess = Message::where([['location', '=', $my_dialog->id], ['sender', '=', $id], ['read', '=', false]])->get();
            foreach($read_mess as $read) {
                $read->read = true;
                $read->save();
            }            
            return view('chat', ['users' => $users, 'user_details' => $user_details, 'user_details_count' => $user_details_count, 'my_dialog_count' => $my_dialog_count, 'mess' => $mess, 'exit_mess' => $exit_mess]);
        } else {
            return view('chat', ['users' => $users, 'user_details' => $user_details, 'user_details_count' => $user_details_count, 'my_dialog_count' => $my_dialog_count]);
        }
    }

    public function exit_mess_post($id, $exit_mess, Request $data) {
        $exit_mess = Message::where('id', '=', $exit_mess)->first();
        $exit_mess->text = $data->input('text');
        $exit_mess->save();
        return redirect()->route('chat', $id);
    }

    public function delete_mess($users, $id) {
        Message::find($id)->delete();

        $dialog = Dialog::where([
            ['user_1', '=', auth()->user()->id],
            ['user_2', '=', $users]
        ])->orWhere([
            ['user_1', '=', $users],
            ['user_2', '=', auth()->user()->id]
        ])->first();

        if(Message::where('location', '=', $dialog->id)->count() == 0){
            Dialog::find($dialog->id)->delete();
        }

        return redirect()->route('chat', $users);
    }
}
