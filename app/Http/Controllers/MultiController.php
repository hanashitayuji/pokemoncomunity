<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Multi;
use DateTime;
use Validator;
use Illuminate\Support\Facades\Auth;

class MultiController extends Controller
{
    public function recruit(Request $request) {
        $rules = [
            'title' => 'required|max:100|',
            'content' => 'required|max:100|',
            'password' => 'required|max:100|',
        ];

        $emessage = [
            'title' => 'タイトルは必須入力です。100文字以内でご入力ください。',
            'content' => '内容は必須入力です。100文字以内でご入力ください。',
            'password' => 'あいことばは必須入力です。数字でご入力ください。',
        ];

        $request->session()->put('title', $request->title);
        $request->session()->put('content', $request->content);
        $request->session()->put('password', $request->password);
        $request->session()->put('vorsion', $request->vorsion);

        $inputs = $request->all();//フォームから受け取ったすべてのinputの値を取得
        $validator = Validator::make($request->all(),$rules,$emessage);
        $userid = Auth::id();

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        } else {
            DB::table('multi')->insert([
                'user_id' => $userid,
                'title' => session('title'),
                'content' => session('content'),
                'password' => session('password'),
                'vorsion' => session('vorsion'),
                'created_id' => new DateTime()
            ]);
            session()->flush();
            return view('recuruit_complete');
        }
    }

    public function multi() {
        $items = DB::table('multi')->where('del_flg','=','0')
        ->get();
        return view('multi_list',['items' => $items,]);
    }

    public function detail() {
        $id = rtrim($_SERVER["REQUEST_URI"], '/');
        $id = substr($id, strrpos($id, '/') + 1);
        $items = DB::table('multi')->leftJoin('users','multi.user_id','=','users.id')
            ->leftJoin('coments','multi.id','=','coments.trade_id')
            ->select('multi.*','users.id as u_id','users.name as name','coments.id as c_id','coments.user_id as c_u_id','coments.text as text','coments.trade_id as t_id','coments.coment_id as c_c_id')
            ->where('multi.id','=',"$id")
            ->get();
        $coments = DB::table('coments')->leftJoin('users','coments.user_id','=','users.id')
            ->select('coments.*','users.name')
            ->where('multi_id','=',"$id")
            ->where('coments.del_flg','=','0')
            ->get();
        return view('multi',['items' => $items])->with(['coments' => $coments]);
    }

    public function update() {
        $id = rtrim($_SERVER["REQUEST_URI"], '/');
        $id = substr($id, strrpos($id, '/') + 1);
        $items = DB::table('multi')->where('multi.id','=',"$id")
            ->get();
        return view('multi_update',['items' => $items]);
    }

    public function complete(Request $request) {
        
        $rules = [
            'title' => 'required|max:100|',
            'content' => 'required|max:100|',
            'password' => 'required|max:100|',
        ];

        $emessage = [
            'title' => 'タイトルは必須入力です。100文字以内でご入力ください。',
            'content' => '内容は必須入力です。100文字以内でご入力ください。',
            'password' => 'あいことばは必須入力です。数字でご入力ください。',
        ];

        $request->session()->put('title', $request->title);
        $request->session()->put('content', $request->content);
        $request->session()->put('password', $request->password);
        $request->session()->put('vorsion', $request->vorsion);
        
        
        $id = $request->id;
        $inputs = $request->all();//フォームから受け取ったすべてのinputの値を取得
        $validator = Validator::make($request->all(),$rules,$emessage);
        
        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        } else {
            
            DB::table('multi')->where('id','=',"$id")
            ->update([
                'title' => session('title'),
                'content' => session('content'),
                'password' => session('password'),
                'vorsion' => session('vorsion'),
                'created_id' => new DateTime()
            ]);
            session()->flush();
            return view('multi_update_complete');
        }
    }

    public function delete() {
        $id = rtrim($_SERVER["HTTP_REFERER"], '/');
        $id = substr($id, strrpos($id, '/') + 1);

        DB::table('multi')->where('id','=',"$id")
        ->update(['del_flg' => 1]);

        return view("trade_delete");

    }

    public function coment(Request $request) {
        $id = rtrim($_SERVER["REQUEST_URI"], '/');
        $id = substr($id, strrpos($id, '/') + 1);

        $rules = [
            'text' => 'required|max:100|',
        ];

        $emessage = [
            'text' => 'コメントは必須入力です。100文字以内でご入力ください。',
        ];

        $request->session()->put('text', $request->text);
        $request->session()->put('response', $request->response);
        $inputs = $request->all();//フォームから受け取ったすべてのinputの値を取得
        $validator = Validator::make($request->all(),$rules,$emessage);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        } else {
            DB::table('coments')->insert([
                'user_id' => Auth::id(),
                'text' => session('text'),
                'multi_id' => $id,
                'coment_id' => session('response'),
                'created_id' => new DateTime()
            ]);
            session()->flush();
            return view('coment_complete');
        }
    }

    public function comentDelete() {
        $id = rtrim($_SERVER["REQUEST_URI"], '/');
        $id = substr($id, strrpos($id, '/') + 1);

        DB::table('coments')->where('id','=',"$id")
        ->update(['del_flg' => 1]);

        return view("coment_delete");
    }
}
