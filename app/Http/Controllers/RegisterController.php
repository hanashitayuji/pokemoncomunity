<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Item;
use DateTime;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Password;


class RegisterController extends Controller
{   
    //新規登録
    public function register(Request $request) {
        $rules = [
            'name' => 'required|max:50',
            'email' => 'required|email:strict,dns|max:100|',
            'password' => 'required|max:100|',
        ];

        $emessage = [
            'name' => '氏名は必須入力です。10文字以内でご入力ください。',
            'email' => 'メールアドレスは必須入力です。メールアドレスは正しくご入力ください。',
            'password' => 'パスワードは必須入力です。',
        ];

        $request->session()->put('name', $request->name);
        $request->session()->put('email', $request->email);
        $request->session()->put('password', $request->password);
        $request->session()->put('body', $request->body);

        $inputs = $request->all();//フォームから受け取ったすべてのinputの値を取得
        $validator = Validator::make($request->all(),$rules,$emessage);
        
        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        } else {
            DB::table('users')->insert([
                'name' => session('name'),
                'email' => session('email'),
                'password' => Hash::make(session('password')),
                'body' => session('body'),
            ]);
            session()->flush();
            return view('complete');
        }
        
    }

    
    //ログイン
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        // ログインに成功したとき
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            $id = Auth::id();
            $count = DB::table('good')->where('user_id','=',"$id")
                ->count();
            return view('master',compact('user'))->with('count',"$count");
        }

        // 上記のif文でログインに成功した人以外(=ログインに失敗した人)がここに来る
        return back()->with('flash_message', 'メールアドレスかパスワードが間違っています');
    
   
    }
    //ログアウト
    public function logout(Request $request) {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
        
        return redirect('login')->with('flash_message', 'ログアウトしました');;
    } 
    //ログインしているか
    public function master() {
        $auths = Auth::user();
        if (Auth::check()) {
            $id = Auth::id();
            $count = DB::table('good')->where('user_id','=',"$id")
                ->count();
            return view('master')->with('count',"$count");
        } else {
            return redirect('login')->with('flash_message', 'ログインしてください');
        }
    }
    //パスワードリセット
    public function reset(Request $request) {
        $credentials = $request->validate([
            'email' => ['required'],
        ]);
        $email = $request->email;
        $count = DB::table('users')
            ->where("email",'=',"$email")
            ->count();
        
        if ($count > 0) {
            return view('reset_password',compact('email'));
        } else {
            return back()->with('flash_message', 'メールアドレスが間違っています');
        }

    }
    
    public function complete(Request $request) {
        $credentials = $request->validate([
            'password' => ['required'],
        ]);
        $password = $request->password;
        $email = $request->email;
        DB::table('users')->where("email",'=',"$email")->update(['password' =>Hash::make("$password")]);
        return view('/reset_complete');
    }
}