<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AsoRepoController extends Controller
{
    public function is_logged_in($mode, $current_url, $request, $param = []){
        //投稿フォーム
        //あなたは誰ですか？
        $session_user_id = $request->session()->get('session_user_id');
        //試験用強制認証機能
        //$session_user_id = 263;
        //これ大事。早まるな。idだけわかっても右ペーン出せんやろ。
        $session_user = DB::table('users')->where('id', $session_user_id)->first();

        //ログインしていたらフォーム、していなかったらログイン画面
        if(isSet($session_user)){
            if($mode == 'layouts.img_create' || $mode == 'layouts.aso_repo_create'){
                $param['ua'] = $request->ua . 'objects.common';
            }
            $param['aid'] = $request->aid;
            $param['session_user'] = $session_user;
            return view($mode, $param);
        }else{
            $redirect = '<meta http-equiv="refresh" content="0; URL=' . "'/outer/login'" . '">';
            return response($redirect)->cookie(
                'current_url', $current_url, 2
            );
        }
        //ほぼ同じことがArticleController@createでも行われている
    }

    public function img_create(Request $request){
        return $this->is_logged_in('layouts.img_create', '/aso-repo/img-create/?aid=' . $request->aid, $request);
    }

    public function img_store(Request $request){
        $validate_rule = [
            'pics' => 'required',
        ];
        $this->validate($request, $validate_rule);
        $file_name = session('session_user_id') . '_' . date('YmdHisT') . '_700.jpg';
        if(!file_exists(public_path() .'/img/aso_repo/')){
            mkdir(public_path() .'/img/aso_repo/', 0777, true);
        }
        if(isset($_FILES['pics']['tmp_name'])){
            $image = \Image::make(file_get_contents($_FILES['pics']['tmp_name']));
            $image->resize(700, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save(public_path() .'/img/aso_repo/'. $file_name);
            if(file_exists(public_path() .'/img/aso_repo/'. $file_name)){
                $param['path'] = '/img/aso_repo/'. $file_name;
            }else{
                $param['pic_errors'] = true;
            }
        }else{
            $param['pic_errors'] = true;
        }
        return $this->is_logged_in('layouts.img_create', '/aso-repo/img-create/?aid=' . $request->aid, $request, $param);
    }
    //似た処理がArticleController@storeに存在

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
/*    public function index()
    {
        //
    }
*/
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $asobikata = DB::table('asobikatas')->select('name')->where('id', $request->aid)->first();
        $param['asobikata'] = $asobikata;
        //あそレポ投稿受付画面
        return $this->is_logged_in('layouts.aso_repo_create', '/aso-repo/create?aid=' . $request->aid, $request, $param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //あそレPOST送信の受け付け
        $validate_rule = [
            'user_id' => 'required|integer',
            'content' => 'required|string',
            'main_pic' => 'required|image',
        ];
        if(isset($request->id)){
            //編集動作の場合、画像は任意
            $validate_rule['main_pic'] = 'image';
        }else{
            $validate_rule['asobikata_id'] = 'required|integer';
        }
        $this->validate($request, $validate_rule);

        if(strlen($_FILES['main_pic']['tmp_name']) > 0){
            $main_pic_save = true;
        }else{
            $main_pic_save = false;
        }

        unset($_POST['_token']);
        unset($_POST['x']);
        unset($_POST['y']);

        //当初、エスケープ
        $_POST['content'] = str_replace(['<a target="_blank"', '<'], ['&lt;a', '&lt;'], $_POST['content']);
        //復活一覧
        $escaped_tags = ['&lt;/', '&lt;a', '&lt;strong', '&lt;strike', '&lt;img', '&lt;p'];
        $valid_tags = ['</', '<a target="_blank"', '<strong', '<strike', '<img', '<p'];
        //一覧にあるものは復活
        $_POST['content'] = str_replace($escaped_tags, $valid_tags, $_POST['content']);

        //識別のためupdated_atを使用
        $_POST['updated_at'] = date("Y-m-d H:i:s +9:00");

        //更新動作の場合
        if(isset($request->id)){
            $id = $request->id;
            unset($_POST['id']);
            DB::table('aso_repo')->where('id', $id)->update($_POST);
        }else{
            //新規投稿の場合
            $_POST['created_at'] = $_POST['updated_at'];
            DB::table('aso_repo')->insert($_POST);
            $id = DB::table('aso_repo')->where('created_at', $_POST['created_at'])->orderby('id', 'desc')->first()->id;
        }

        //メイン画像が新規投稿時オリジナルなら保存・更新時上書きなら保存
        if($main_pic_save){
            $image = \Image::make(file_get_contents($_FILES['main_pic']['tmp_name']));
            $image->resize(700, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            if (!file_exists(public_path() .'/img/aso_repo/')) {
                mkdir(public_path() .'/img/aso_repo/', 0777, true);
            }
            $image->save(public_path() .'/img/aso_repo/'. $id . '_700.jpg');
        }
        unset($_FILES);
        header('Location: /aso-repo/'. $id . '?mode=org');
        exit();
    }

    public function content(Request $request, $id){
        $aso_repo = DB::table('aso_repo')->where('id', $id)->where('status', 1)->first();
        return view($request->ua . 'objects.aso_repo_content', ['aso_repo' => $aso_repo]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //aso_repo.idを$idとして受け取って、個別表示。
        $aso_repo = DB::table('aso_repo')->where('id', $id)->where('status', 1)->first();
        $user = DB::table('users')->where('id', $aso_repo->user_id)->first();
        $asobikata = DB::table('asobikatas')->where('id', $aso_repo->asobikata_id)->where('status', 1)->first();
        $mode = $request->mode;
        $url = $request->url();
        $tSharingUrl = "https://twitter.com/intent/tweet?hashtags=%E3%81%82%E3%81%9D%E3%81%B3%E3%82%AB%E3%82%BF%E3%83%B3&amp;original_referer=" . $url . "&amp;ref_src=twsrc%5Etfw&amp;text=%E3%81%82%E3%81%9D%E3%83%AC%E3%83%9D%E3%82%92%E6%8A%95%E7%A8%BF%E3%81%97%E3%81%9F%E3%82%88%EF%BC%81&amp;tw_p=tweetbutton&amp;url=" . $url;

        //ミドルウェアでやってもよかったよね。↓
        $session_user_id = $request->session()->get('session_user_id');
        $session_user = DB::table('users')->where('id', $session_user_id)->first();

        return view('layouts.aso_repo',
            ['aso_repo_id' => $aso_repo->id,
                'session_user' => $session_user,
                'asobikata' => $asobikata,
                'tSharingUrl' => $tSharingUrl,
                'url' => $url,
                'mode' => $mode,
                'ua' => $request->ua . 'objects.common',
                'isAndroid' => $request->isAndroid,
                'user_name' => $user->name,
                'login_id' => $user->login_id,
                'user_id' => $user->id,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //記事の編集フォーム
        //現在の情報を取得
        $aso_repo = DB::table('aso_repo')->where('id', $id)->where('status', 1)->first();
        //あなたは誰ですか？
        $session_user_id = $request->session()->get('session_user_id');
        //これ大事。早まるな。idだけわかっても右ペーン出せんやろ。
        $session_user = DB::table('users')->where('id', $session_user_id)->first();

        if(isSet($session_user_id) && $aso_repo->user_id == $session_user_id){
            $param = ['session_user' => $session_user,
                'ua' => $request->ua . 'objects.common',
                'aso_repo' => $aso_repo,
                'aid' => $aso_repo->asobikata_id,];
            return view('layouts.aso_repo_create', $param);
        }else{
            header('Location: /?mode=edit_failed');
            exit();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
/*    public function update(Request $request, $id)
    {
        //storeを流用
    }
*/
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //statusを0にすることで削除
        $param = ['status' => 0];
        DB::table('aso_repo')->where('id', $id)->update($param);
        $restore_id = DB::table('aso_repo')->where('id', $id)->where('status', 0)->first();
        if(isset($restore_id)){
            $restore_id = 'ar' . $restore_id->id;
        }else{
            $restore_id = 'false';
        }

        header('Location: /?mode=deleted&restore_id=' . $restore_id);
        exit();
    }
    //復元機能はArticleController@restoreで実装
}
