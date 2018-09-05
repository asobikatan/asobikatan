<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MiscController extends Controller
{
    public function category($category, Request $request){
        //カテゴリ番号を受け取って条件分岐
        if($request->page == null){
            $request->page = 0;
        }
        switch($category){
            case "c1":
                $category = "1人のあそび";
                $count = DB::select("select count(*) as count from asobikatas where number_safe_min <= 1 and status = 1");
                $asobikatas = DB::table('asobikatas')->join('users', 'asobikatas.user_id', '=', 'users.id')->where('number_safe_min', '<=', 1)->where('asobikatas.status', 1)->orderBy('asobikatas.id', 'desc')->skip($request->page * 20)->take(20)->get(["users.name as user_name", "asobikatas.name as a_name", "users.id as uid", "asobikatas.id as id", "asobikatas.outline as outline", "asobikatas.point_1 as point_1", "asobikatas.user_id as user_id", "users.login_id as login_id", "asobikatas.number_safe_min as number_safe_min", "asobikatas.number_safe_max as number_safe_max", "asobikatas.price as price", "asobikatas.one_time as one_time", "asobikatas.place_type as place_type", "asobikatas.detail_3_4 as detail_3_4", "asobikatas.detail_3_5 as detail_3_5", "asobikatas.age_min as age_min", "asobikatas.main_pic as main_pic"]);
                break;

            case "c2":
                $category = "大勢のあそび";
                $count = DB::select("select count(*) as count from asobikatas where number_safe_max >= 10 and status = 1");
                $asobikatas = DB::table('asobikatas')->join('users', 'asobikatas.user_id', '=', 'users.id')->where('number_safe_max', '>=', 10)->where('asobikatas.status', 1)->orderBy('asobikatas.id', 'desc')->skip($request->page * 20)->take(20)->get(["users.name as user_name", "asobikatas.name as a_name", "users.id as uid", "asobikatas.id as id", "asobikatas.outline as outline", "asobikatas.point_1 as point_1", "asobikatas.user_id as user_id", "users.login_id as login_id", "asobikatas.number_safe_min as number_safe_min", "asobikatas.number_safe_max as number_safe_max", "asobikatas.price as price", "asobikatas.one_time as one_time", "asobikatas.place_type as place_type", "asobikatas.detail_3_4 as detail_3_4", "asobikatas.detail_3_5 as detail_3_5", "asobikatas.age_min as age_min", "asobikatas.main_pic as main_pic"]);
                break;

            case "c3":
                $category = "0円でできるあそび";
                $count = DB::select("select count(*) as count from asobikatas where price = 0 and status = 1");
                $asobikatas = DB::table('asobikatas')->join('users', 'asobikatas.user_id', '=', 'users.id')->where('price', 0)->where('asobikatas.status', 1)->orderBy('asobikatas.id', 'desc')->skip($request->page * 20)->take(20)->get(["users.name as user_name", "asobikatas.name as a_name", "users.id as uid", "asobikatas.id as id", "asobikatas.outline as outline", "asobikatas.point_1 as point_1", "asobikatas.user_id as user_id", "users.login_id as login_id", "asobikatas.number_safe_min as number_safe_min", "asobikatas.number_safe_max as number_safe_max", "asobikatas.price as price", "asobikatas.one_time as one_time", "asobikatas.place_type as place_type", "asobikatas.detail_3_4 as detail_3_4", "asobikatas.detail_3_5 as detail_3_5", "asobikatas.age_min as age_min", "asobikatas.main_pic as main_pic"]);
                break;

            case "c4":
                $category = "室内のあそび";
                $count = DB::select("select count(*) as count from asobikatas where place_type in (1, 3) and status = 1");
                $asobikatas = DB::table('asobikatas')->join('users', 'asobikatas.user_id', '=', 'users.id')->whereIn('place_type', [1, 3])->where('asobikatas.status', 1)->orderBy('asobikatas.id', 'desc')->skip($request->page * 20)->take(20)->get(["users.name as user_name", "asobikatas.name as a_name", "users.id as uid", "asobikatas.id as id", "asobikatas.outline as outline", "asobikatas.point_1 as point_1", "asobikatas.user_id as user_id", "users.login_id as login_id", "asobikatas.number_safe_min as number_safe_min", "asobikatas.number_safe_max as number_safe_max", "asobikatas.price as price", "asobikatas.one_time as one_time", "asobikatas.place_type as place_type", "asobikatas.detail_3_4 as detail_3_4", "asobikatas.detail_3_5 as detail_3_5", "asobikatas.age_min as age_min", "asobikatas.main_pic as main_pic"]);
                break;

            case "c5":
                $category = "すぐ終わるあそび";
                $count = DB::select("select count(*) as count from asobikatas where one_time <= 10 and status = 1");
                $asobikatas = DB::table('asobikatas')->join('users', 'asobikatas.user_id', '=', 'users.id')->where('one_time', '<=', 10)->where('asobikatas.status', 1)->orderBy('asobikatas.id', 'desc')->skip($request->page * 20)->take(20)->get(["users.name as user_name", "asobikatas.name as a_name", "users.id as uid", "asobikatas.id as id", "asobikatas.outline as outline", "asobikatas.point_1 as point_1", "asobikatas.user_id as user_id", "users.login_id as login_id", "asobikatas.number_safe_min as number_safe_min", "asobikatas.number_safe_max as number_safe_max", "asobikatas.price as price", "asobikatas.one_time as one_time", "asobikatas.place_type as place_type", "asobikatas.detail_3_4 as detail_3_4", "asobikatas.detail_3_5 as detail_3_5", "asobikatas.age_min as age_min", "asobikatas.main_pic as main_pic"]);
                break;

            case "c6":
                $category = "アウトドアのあそび";
                $count = DB::select("select count(*) as count from asobikatas where place_type in (2, 4) and status = 1");
                $asobikatas = DB::table('asobikatas')->join('users', 'asobikatas.user_id', '=', 'users.id')->whereIn('place_type', [2, 4])->where('asobikatas.status', 1)->orderBy('asobikatas.id', 'desc')->skip($request->page * 20)->take(20)->get(["users.name as user_name", "asobikatas.name as a_name", "users.id as uid", "asobikatas.id as id", "asobikatas.outline as outline", "asobikatas.point_1 as point_1", "asobikatas.user_id as user_id", "users.login_id as login_id", "asobikatas.number_safe_min as number_safe_min", "asobikatas.number_safe_max as number_safe_max", "asobikatas.price as price", "asobikatas.one_time as one_time", "asobikatas.place_type as place_type", "asobikatas.detail_3_4 as detail_3_4", "asobikatas.detail_3_5 as detail_3_5", "asobikatas.age_min as age_min", "asobikatas.main_pic as main_pic"]);
                break;

            case "c7":
                $category = "こどもと遊べるあそび";
                $count = DB::select("select count(*) as count from asobikatas where age_min < 20 and status = 1");
                $asobikatas = DB::table('asobikatas')->join('users', 'asobikatas.user_id', '=', 'users.id')->where('age_min', '<', 20)->where('asobikatas.status', 1)->orderBy('asobikatas.id', 'desc')->skip($request->page * 20)->take(20)->get(["users.name as user_name", "asobikatas.name as a_name", "users.id as uid", "asobikatas.id as id", "asobikatas.outline as outline", "asobikatas.point_1 as point_1", "asobikatas.user_id as user_id", "users.login_id as login_id", "asobikatas.number_safe_min as number_safe_min", "asobikatas.number_safe_max as number_safe_max", "asobikatas.price as price", "asobikatas.one_time as one_time", "asobikatas.place_type as place_type", "asobikatas.detail_3_4 as detail_3_4", "asobikatas.detail_3_5 as detail_3_5", "asobikatas.age_min as age_min", "asobikatas.main_pic as main_pic"]);
                break;

            case "c8":
                $category = "異性と盛り上がるあそび";
                $count = DB::select("select count(*) as count from asobikatas where detail_3_5 = 1 and status = 1");
                $asobikatas = DB::table('asobikatas')->join('users', 'asobikatas.user_id', '=', 'users.id')->where('detail_3_5', 1)->where('asobikatas.status', 1)->orderBy('asobikatas.id', 'desc')->skip($request->page * 20)->take(20)->get(["users.name as user_name", "asobikatas.name as a_name", "users.id as uid", "asobikatas.id as id", "asobikatas.outline as outline", "asobikatas.point_1 as point_1", "asobikatas.user_id as user_id", "users.login_id as login_id", "asobikatas.number_safe_min as number_safe_min", "asobikatas.number_safe_max as number_safe_max", "asobikatas.price as price", "asobikatas.one_time as one_time", "asobikatas.place_type as place_type", "asobikatas.detail_3_4 as detail_3_4", "asobikatas.detail_3_5 as detail_3_5", "asobikatas.age_min as age_min", "asobikatas.main_pic as main_pic"]);
                break;

            case "c9":
                $category = "車内のあそび";
                $count = DB::select("select count(*) as count from asobikatas where place_type >= 3 and status = 1");
                $asobikatas = DB::table('asobikatas')->join('users', 'asobikatas.user_id', '=', 'users.id')->where('place_type', '>=', 3)->where('asobikatas.status', 1)->orderBy('asobikatas.id', 'desc')->skip($request->page * 20)->take(20)->get(["users.name as user_name", "asobikatas.name as a_name", "users.id as uid", "asobikatas.id as id", "asobikatas.outline as outline", "asobikatas.point_1 as point_1", "asobikatas.user_id as user_id", "users.login_id as login_id", "asobikatas.number_safe_min as number_safe_min", "asobikatas.number_safe_max as number_safe_max", "asobikatas.price as price", "asobikatas.one_time as one_time", "asobikatas.place_type as place_type", "asobikatas.detail_3_4 as detail_3_4", "asobikatas.detail_3_5 as detail_3_5", "asobikatas.age_min as age_min", "asobikatas.main_pic as main_pic"]);
                break;

            case "list":
                $list = [
                    "c1" => "1人のあそび",
                    "c2" => "大勢のあそび",
                    "c3" => "0円でできるあそび",
                    "c4" => "室内のあそび",
                    "c5" => "すぐ終わるあそび",
                    "c6" => "アウトドアのあそび",
                    "c7" => "こどもと遊べるあそび",
                    "c8" => "異性と盛り上がるあそび",
                    "c9" => "車内のあそび",
                ];
                if($request->ua == 'sp_'){
                    $ua = 'sp_objects.common';
                }else{
                    $ua = 'objects.common';
                }
                return view('layouts.category_list', ['list' => $list, 'ua' => $ua]);
                break;
            case "random":
                $status = 0;
                while($status != 1){
                    $count = DB::table('asobikatas')->count();
                    $id = rand(0, $count);
                    $status = DB::table('asobikatas')->where('id', $id)->first()->status;
                }
                return redirect('/article/' . $id);
        }


        $session_user_id = $request->session()->get('session_user_id');
        $session_user = DB::table('users')->where('id', $session_user_id)->first();
        $param = ['asobikatas' => $asobikatas, 'category' => $category, 'count' => $count[0]->count, 'page' => $request->page, 'session_user' => $session_user];

        return view($request->ua . 'layouts.list', $param);
    }
    public function yattemitai(Request $request){
        //iframeで表示、やってみたいボタン
        if($request->mode == 'yinc_list' || $request->mode == 'yinc_detail'){
            //DBに必要事項書き込み。
            $param =
                [
                    'asobikata_id' => (int)$request->id,
                    'cookie_key' => $request->cookie('laravel_session'),
                    'user_id' => 0,
                ];
            $session_user_id = $request->session()->get('session_user_id');
            if(isset($session_user_id)){
                $param['user_id'] = $session_user_id;
            }
            //未押下？
            $is_unique = DB::table('yattemitais')->where('asobikata_id', $request->id)
                ->where(function($query) use($param){
                    $query->where('user_id', $param['user_id'])->orwhere('cookie_key', $param['cookie_key']);
                })->count();
            if($is_unique < 1){
                //無事に書き込み
                DB::table('yattemitais')->insert($param);
            }
            return view('objects.misc', ['yattemitai' => '済', 'id' => $request->id, 'mode' => $request->mode]);
        }else{
            //初期状態。現在のやってみたい数を表示。
            $yattemitai = DB::table('yattemitais')->where('asobikata_id', $request->id)->count();
            if($request->mode == 'ydisp_list'){
                $mode = 'yinc_list';
            }elseif($request->mode == 'ydisp_detail'){
                $mode = 'yinc_detail';
            }
            return view('objects.misc', ['yattemitai' => $yattemitai, 'id' => $request->id, 'mode' => $mode]);
        }
    }
    public function hidoiine(Request $request){
        //iframeで表示、ひどいいねボタン
        if($request->mode == 'hinc'){
            //DBに必要事項書き込み。
            $param =
                [
                    'asobikata_id' => (int)$request->id,
                    'cookie_key' => $request->cookie('laravel_session'),
                    'user_id' => 0,
                ];
            $session_user_id = $request->session()->get('session_user_id');
            if(isset($session_user_id)){
                $param['user_id'] = $session_user_id;
            }
            //未押下？
            $is_unique = DB::table('hidoiine')->where('asobikata_id', $request->id)
                ->where(function($query) use($param){
                    $query->where('user_id', $param['user_id'])->orwhere('cookie_key', $param['cookie_key']);
                })->count();
            if($is_unique < 1){
                //無事に書き込み
                DB::table('hidoiine')->insert($param);
            }
            return view('objects.misc', ['hidoiine' => '済', 'id' => $request->id, 'mode' => $request->mode]);
        }else{
            //初期状態。現在のひどいいね数を表示。
            //ひどいいね
            $hidoiine = DB::table('hidoiine')->where('asobikata_id', $request->id)->count();
            return view('objects.misc', ['hidoiine' => $hidoiine, 'id' => $request->id, 'mode' => $request->mode]);
        }
    }
    public function phpinfo(){
        phpinfo();
    }
}
