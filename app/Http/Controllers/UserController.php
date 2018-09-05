<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //登録しているユーザー一覧は実装なし
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //登録はSNS連携のみなのでcreateは実装なし
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //twittercallbackでユーザー情報は登録するので出番なし

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        //そのユーザーの遊び一覧
        if($request->page == null){
            $request->page = 0;
        }
        $login_id = $id;
        $id = DB::table('users')->where('login_id', $login_id)->first()->id;
        $count = DB::select("select count(*) as count from asobikatas where user_id = :id and status = 1", ['id' => $id]);
        $asobikatas = DB::table('asobikatas')->join('users', 'asobikatas.user_id', '=', 'users.id')->where('asobikatas.user_id', $id)->where('asobikatas.status', 1)->orderBy('asobikatas.id', 'desc')->skip($request->page * 20)->take(20)->get(["users.name as user_name", "asobikatas.name as a_name", "users.id as uid", "asobikatas.id as id", "asobikatas.outline as outline", "asobikatas.point_1 as point_1", "asobikatas.user_id as user_id", "users.login_id as login_id", "asobikatas.number_safe_min as number_safe_min", "users.bio as bio", "asobikatas.number_safe_max as number_safe_max", "asobikatas.price as price", "asobikatas.one_time as one_time", "asobikatas.place_type as place_type", "asobikatas.detail_3_4 as detail_3_4", "asobikatas.detail_3_5 as detail_3_5", "asobikatas.age_min as age_min", "asobikatas.main_pic as main_pic"]);
        if($count[0]->count == 0){
            $user = DB::table('users')->where('login_id', $login_id)->first();
            $user_name = $user->name;
        }else{
            $user_name = $asobikatas->first()->user_name;
        }
        $session_user_id = $request->session()->get('session_user_id');
        $session_user = DB::table('users')->where('id', $session_user_id)->first();

        return view($request->ua . 'layouts.list',
            ['asobikatas' => $asobikatas,
            'session_user' => $session_user,
            'user_name' => $user_name,
            'login_id' => $login_id,
            'user_id' => $id,
            'category' => null,
            'count' => $count[0]->count,
            'page' => $request->page]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //ユーザー情報の編集フォーム
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //ユーザー情報の更新
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //ユーザー登録抹消は不可
    }
}
