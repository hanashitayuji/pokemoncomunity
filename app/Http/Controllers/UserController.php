<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use DateTime;
use Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
    public function user() {
        $id = rtrim($_SERVER["REQUEST_URI"], '/');
        $id = substr($id, strrpos($id, '/') + 1);
        $myid = Auth::id();
        
        $items = DB::table('users')->leftJoin('good','users.id','=','good.user_id')
            ->where('users.id','=',"$id")
            ->get();

        $count = DB::table('good')->where('user_id','=',"$id")
            ->count();
        $good = DB::table('good')->where('valuer_id','=',"$myid")
            ->count();
        if($myid == $id) {
            return view('master')->with('count',"$count");
        } else {
            return view('user',['items' => $items])->with('count',$count)->with('good',$good);
        }
    }

    public function good($itemId) {
        $id = rtrim($_SERVER["HTTP_REFERER"], '/');
        $id = substr($id, strrpos($id, '/') + 1);
        $valuer_id = Auth::id();
        $good = DB::table('good')->where('valuer_id','=',"$valuer_id")
            ->where('user_id','=',"$id")
            ->count();
        if($good == 0) {
            DB::table('good')->insert([
                'user_id' => "$id",
                'valuer_id' => "$valuer_id",
                'created_id' => new DateTime()
            ]);
            
        } else {
            DB::table('good')->where('user_id','=',"$id")
                ->where('valuer_id','=',"$valuer_id")
                ->delete();
            $good = DB::table('good')->where('valuer_id','=',"$valuer_id")
                ->where('user_id','=',"$id")
                ->count();  
        }
        $json = DB::table('good')->where('user_id','=',"$id")
        ->count();
        return response()->json(['count' => $json]);
    }      
    

    public function multi() {
        $id = rtrim($_SERVER["HTTP_REFERER"], '/');
        $id = substr($id, strrpos($id, '/') + 1);
        $items = DB::table('multi')->where('user_id','=',"$id")
            ->where('del_flg','=','0')
            ->get();
        return view('master_multi',['items' => $items])->with('id',$id);   
    }

    public function mastermulti() {
        //if()
        $id = Auth::id();
        $items = DB::table('multi')->where('user_id','=',"$id")
            ->where('del_flg','=','0')
            ->get();
        return view('master_multi',['items' => $items]);   
    }

    public function trade() {
        $id = rtrim($_SERVER["HTTP_REFERER"], '/');
        $id = substr($id, strrpos($id, '/') + 1);
        $items = DB::table('exchange')->where('user_id','=',"$id")
            ->where('del_flg','=','0')
            ->get();
        return view('master_trade',['items' => $items])->with('id',$id);   
    }

    public function mastertrade() {
        $id = Auth::id();
        $items = DB::table('exchange')->where('user_id','=',"$id")
            ->where('del_flg','=','0')
            ->get();
        return view('master_trade',['items' => $items]);   
    }

    public function masterComent() {
        $id = Auth::id();
        $items = DB::table('coments')->leftJoin('exchange','coments.trade_id','=','exchange.id')
            ->leftJoin('multi','coments.multi_id','=','multi.id')
            ->select('coments.*','exchange.id as e_id','exchange.title as e_title','multi.id as m_id','multi.title as m_title')
            ->where('coments.user_id','=',"$id")
            ->where('coments.del_flg','=','0')
            ->get();
        return view('coment_list',['items' => $items]);
    }

    public function coment() {
        $id = rtrim($_SERVER["HTTP_REFERER"], '/');
        $id = substr($id, strrpos($id, '/') + 1);
        $items = DB::table('coments')->leftJoin('exchange','coments.trade_id','=','exchange.id')
            ->leftJoin('multi','coments.multi_id','=','multi.id')
            ->select('coments.*','exchange.id as e_id','exchange.title as e_title','multi.id as m_id','multi.title as m_title')
            ->where('coments.user_id','=',"$id")
            ->where('coments.del_flg','=','0')
            ->get();
        return view('coment_list',['items' => $items])->with('id',$id);
    }
}
