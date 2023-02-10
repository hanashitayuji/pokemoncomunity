<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Trade;
use DateTime;
use Validator;
use Illuminate\Support\Facades\Auth;

class TradeController extends Controller
{
    public function recruit(Request $request) {
        $rules = [
            'title' => 'required|max:100|',
            'want' => 'required|max:100|',
            'give' => 'required|max:100|',
            'body' => 'max:100',
        ];

        $emessage = [
            'title' => 'タイトルは必須入力です。100文字以内でご入力ください。',
            'want' => '欲しいポケモンは必須入力です。100文字以内でご入力ください。',
            'give' => '上げるポケモンは必須入力です。100文字以内でご入力ください。',
            'body' => '内容は100文字以内でご入力ください。',
        ];

        $request->session()->put('title', $request->title);
        $request->session()->put('want', $request->want);
        $request->session()->put('give', $request->give);
        $request->session()->put('vorsion', $request->vorsion);
        $request->session()->put('body', $request->body);

        $inputs = $request->all();//フォームから受け取ったすべてのinputの値を取得
        $validator = Validator::make($request->all(),$rules,$emessage);
        $userid = Auth::id();
        
        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        } else {
            DB::table('exchange')->insert([
                'user_id' => $userid,
                'title' => session('title'),
                'want' => session('want'),
                'give' => session('give'),
                'vorsion' => session('vorsion'),
                'body' => session('body'),
                'created_id' => new DateTime()
            ]);
            session()->flush();
            return view('recuruit_complete');
        }
    }

    public function trade() {
        $items = DB::table('exchange')->where('del_flg','=','0')
        ->get();
        return view('trade_list',['items' => $items,]);
    }

    public function detail() {
        $id = rtrim($_SERVER["REQUEST_URI"], '/');
        $id = substr($id, strrpos($id, '/') + 1);
        $items = DB::table('exchange')->leftJoin('users','exchange.user_id','=','users.id')
            ->select('exchange.*','users.id as u_id','users.name as name')
            ->where('exchange.id','=',"$id")
            ->get();
        $coments = DB::table('coments')->leftJoin('users','coments.user_id','=','users.id')
            ->select('coments.*','users.name')
            ->where('trade_id','=',"$id")
            ->where('coments.del_flg','=','0')
            ->get();
        $users = DB::table('coments')->leftJoin('users','coments.coment_id','=','users.id')
            ->select('coments.*','users.name')
            ->where('trade_id','=',"$id")
            ->where('coments.del_flg','=','0')
            ->get();
        return view('trade',['items' => $items])->with(['coments' => $coments])
            ->with(['users' => $users]);
            
    }

    public function update() {
        $id = rtrim($_SERVER["REQUEST_URI"], '/');
        $id = substr($id, strrpos($id, '/') + 1);
        $items = DB::table('exchange')->where('exchange.id','=',"$id")
            ->get();
        return view('trade_update',['items' => $items]);
    }

    public function complete(Request $request) {
        
        $rules = [
            'title' => 'required|max:100|',
            'want' => 'required|max:100|',
            'give' => 'required|max:100|',
            'body' => 'max:100',
        ];

        $emessage = [
            'title' => 'タイトルは必須入力です。100文字以内でご入力ください。',
            'want' => '欲しいポケモンは必須入力です。100文字以内でご入力ください。',
            'give' => '上げるポケモンは必須入力です。100文字以内でご入力ください。',
            'body' => '内容は100文字以内でご入力ください。',
        ];

        $request->session()->put('title', $request->title);
        $request->session()->put('want', $request->want);
        $request->session()->put('give', $request->give);
        $request->session()->put('vorsion', $request->vorsion);
        $request->session()->put('body', $request->body);
        
        $id = $request->id;
        $inputs = $request->all();//フォームから受け取ったすべてのinputの値を取得
        $validator = Validator::make($request->all(),$rules,$emessage);
        
        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        } else {
            
            DB::table('exchange')->where('id','=',"$id")
            ->update([
                'title' => session('title'),
                'want' => session('want'),
                'give' => session('give'),
                'vorsion' => session('vorsion'),
                'body' => session('body'),
                'created_id' => new DateTime()
            ]);
            session()->flush();
            return view('update_complete');
        }
    }

    public function delete() {
        $id = rtrim($_SERVER["HTTP_REFERER"], '/');
        $id = substr($id, strrpos($id, '/') + 1);

        DB::table('exchange')->where('id','=',"$id")
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
                'trade_id' => $id,
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
