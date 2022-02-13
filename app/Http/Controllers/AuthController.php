<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\Friends;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function sign_in() {
        return view('sign_in');
    }

    public function registr() {
        return view('registr');
    }

    public function name_surname() {
        return view('name_surname');
    }

    public function add_name_surname($id, Request $data) {
        $valid = $data->validate([
            'name' => ['required'],
            'surname' => ['required'],
        ]);

        $user = User::find($id);
        $user->name = $data->input('name');
        $user->surname = $data->input('surname');
        $user->save();

        return redirect()->route('home');
    }

    public function reg(Request $data) {
        
        $valid = $data->validate([
            'tel' => ['required', 'string', 'min:9'],
            'password' => ['required', 'confirmed', 'min:8'],
            'password_confirmation' => ['required']
        ]);

        $user = User::create([
            'tel' => $data['tel'],
            'name' => '',
            'surname' => '',
            'password' => bcrypt($data['password']),
        ]);

        if ($user) {
            auth('web')->login($user);
        }
        
        return redirect()->route('add_name');
    }

    public function login(Request $request) {
        $data = $request->validate([
            'tel' => ['required', 'string', 'min:9'],
            'password' => ['required', 'min:8']
        ]);
    
        if (auth('web')->attempt($data)) {
            return redirect()->route('home');
        } else {
            return redirect()->route('sign_in')->withErrors([
                'tel' => 'Телефон или пароль не совпадают'
            ]);
        }
    }

    public function exit()
    {
        auth('web')->logout();
        return redirect()->route('home');
    }

    public function personal() {
        $user_details = UserDetails::where('user_id', '=', auth()->user()->id)->first();
        $user_details_count = UserDetails::where('user_id', '=', auth()->user()->id)->count();
        $my_friends_count = Friends::where('add_friends_id', '=', auth()->user()->id)->orWhere('app_friends_id', '=', auth()->user()->id)->count();
        return view('personal', ['user_details' => $user_details, 'user_details_count' => $user_details_count, 'my_friends_count' => $my_friends_count]);
    }

    public function exit_personal() {
        $user_details = UserDetails::where('user_id', '=', auth()->user()->id)->first();
        $user_details_count = UserDetails::where('user_id', '=', auth()->user()->id)->count();
        return view('exit_personal', ['user_details' => $user_details, 'user_details_count' => $user_details_count]);
    }

    public function main_exit_personal($id, Request $data) {
        $valid = $data->validate([
            'name' => ['required'],
            'surname' => ['required'],
        ]);

        $user_details = UserDetails::where('user_id', '=', auth()->user()->id)->count();

        $user = User::find($id);
        $user->name = $data->input('name');
        $user->surname = $data->input('surname');
        $user->save();

        if($user_details == 0) {
            $user_details = new UserDetails();
            $user_details->user_id = auth()->user()->id;
            $user_details->avatar = '';
            $user_details->day = $data->input('day');
            $user_details->mounth = $data->input('mounth');
            $user_details->year = $data->input('year');
            $user_details->gender = $data->input('gender');
            $user_details->save();
        } else {
            $user_details = UserDetails::find($id);
            $user_details->day = $data->input('day');
            $user_details->mounth = $data->input('mounth');
            $user_details->year = $data->input('year');
            $user_details->gender = $data->input('gender');
            $user_details->save();
        }
        return redirect()->route('personal');
    }

    public function avatar_exit_personal($id, Request $data) {
        $valid = $data->validate([
            'avatar' => ['required', 'image', 'mimetypes:image/jpeg,image/png,image/webp']
         ]);        

         $user_details = UserDetails::where('user_id', '=', auth()->user()->id)->count();

         if($user_details == 0) {
            $user_details = new UserDetails();
            $file = $data->file('avatar');
            $upload_folder = 'public/avatar/'.auth()->user()->id; //Создается автоматически
            $filename = $file->getClientOriginalName(); //Сохраняем исходное название изображения
            Storage::delete($upload_folder.'/'.$user_details->avatar);
            Storage::putFileAs($upload_folder, $file, $filename);        
            $user_details->user_id=auth()->user()->id;
            $user_details->avatar=$filename;
            $user_details->day='';
            $user_details->mounth='';
            $user_details->year='';
            $user_details->gender='';
            $user_details->save();
         } else {
            $user_details = UserDetails::find($id);
            $file = $data->file('avatar');
            $upload_folder = 'public/avatar/'.auth()->user()->id; //Создается автоматически
            $filename = $file->getClientOriginalName(); //Сохраняем исходное название изображения
            Storage::delete($upload_folder.'/'.$user_details->avatar);
            Storage::putFileAs($upload_folder, $file, $filename);
            $user_details->avatar=$filename;
            $user_details->save();
         }
         return redirect()->route('personal');
    }
}
