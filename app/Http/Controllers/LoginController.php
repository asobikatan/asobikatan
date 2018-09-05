<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Abraham\TwitterOAuth\TwitterOAuth;

class LoginController extends Controller
{
    //参考：https://dolphin-rokujiro.com/work/image_resize/
    //********************
    //画像生成処理
    //********************
    public function create_images($original_image, $user_id){

        //リサイズ元となる画像のURLを指定
        $source_file_path = $original_image;

        //それぞれのサイズにリサイズする
        $this->resize_image($user_id . "_50x50.jpg",$source_file_path,'img/user/',50,50); //小サイズ
        $this->resize_image($user_id . "_20x20.jpg",$source_file_path,'img/user/',20,20); //極小サイズ
        return true;
    }

    //********************
    //画像リサイズ処理
    //********************
    public function resize_image($new_image, $source_file_path, $make_dir, $width, $height){

        //ディレクトリの存在確認
        if(!file_exists($make_dir)){
            mkdir($make_dir); //ディレクトリ作成
            chmod($make_dir,0777); //権限付与
        }

        //リサイズ元ファイルのサイズを取得
        list($w, $h) = getimagesize($source_file_path);
        $baseImage = imagecreatefromjpeg($source_file_path);

        $image = imagecreatetruecolor($width, $height);
        imagecopyresampled($image,  $baseImage, 0, 0, 0, 0, $width,  $height,  $w, $h);
        imagejpeg($image ,$make_dir . $new_image);

        return true;
    }

    public function tLogin(Request $request)
    {
        $twitter = new TwitterOAuth(
            config('twitter.consumer_key'),
            config('twitter.consumer_secret')
        );
        # 認証用のrequest_tokenを取得
        # このとき認証後、遷移する画面のURLを渡す
        $token = $twitter->oauth('oauth/request_token', array(
            'oauth_callback' => config('twitter.callback_url')
        ));

        # 認証画面で認証を行うためSessionに入れる
        session(array(
            'oauth_token' => $token['oauth_token'],
            'oauth_token_secret' => $token['oauth_token_secret'],
        ));

        # 認証画面へ移動させる
        ## 毎回認証をさせたい場合： 'oauth/authorize'
        ## 再認証が不要な場合： 'oauth/authenticate'
        $url = $twitter->url('oauth/authenticate', array(
            'oauth_token' => $token['oauth_token']
        ));

        $redirect = "<meta http-equiv='refresh' content=";
        $redirect = $redirect . '"0; URL=';
        $redirect = $redirect . "'" . $url . "'";
        $redirect = $redirect . '" />';

        if(isSet($_SERVER['HTTP_REFERER'])){
            return response($redirect)->cookie(
                'current_url', $_SERVER['HTTP_REFERER'], 2
            );
        }else{
            return response($redirect)->cookie(
                'current_url', '/', 2
            );
        }
    }

    public function tCallback(Request $request)
    {
        $oauth_token = session('oauth_token');
        $oauth_token_secret = session('oauth_token_secret');

        # request_tokenが不正な値だった場合エラー
        if ($request->has('oauth_token') && $oauth_token !== $request->oauth_token) {
            header("Location:/outer/login");
            exit;
        }

        # request_tokenからaccess_tokenを取得
        $twitter = new TwitterOAuth(
            $oauth_token,
            $oauth_token_secret
        );
        $token = $twitter->oauth('oauth/access_token', array(
            'oauth_verifier' => $request->oauth_verifier,
            'oauth_token' => $request->oauth_token,
        ));

        # access_tokenを用いればユーザー情報へアクセスできるため、それを用いてTwitterOAuthをinstance化
        $twitter_user = new TwitterOAuth(
            config('twitter.consumer_key'),
            config('twitter.consumer_secret'),
            $token['oauth_token'],
            $token['oauth_token_secret']
        );

        # 本来はアカウント有効状態を確認するためのものですが、プロフィール取得にも使用可能
        $twitter_user_info = $twitter_user->get('account/verify_credentials');
        $userIcon = $twitter_user_info->profile_image_url;

        //既存ユーザならusersテーブルからidを取得、画像を上書き、新規さんなら加えてDBに新規登録
        $user_id = DB::table('users')->where('twitter_user_id', $twitter_user_info->id)->where('status', 1)->first();

        if($user_id == null){
            $param = [
                'login_id' => $twitter_user_info->screen_name,
                'name' => $twitter_user_info->name,
                'type' => 1,
                'twitter_user_id' => $twitter_user_info->id,
                'twitter_screen_name' => $twitter_user_info->screen_name,
                'twitter_url' => $twitter_user_info->url,
                'bio' => $twitter_user_info->description,
                'status' => 1,
            ];
            DB::table('users')->insert($param);
            $user_id = DB::table('users')->where('twitter_user_id', $twitter_user_info->id)->where('status', 1)->first();
        }
        $user_id = $user_id->id;
        $this->create_images($userIcon, $user_id);

        session(['session_user_id' => $user_id]);
        $current_url = $request->cookie('current_url');

        return redirect($current_url);
    }

    public function tLogout(Request $request){
        if (isset($_COOKIE["PHPSESSID"])) {
            setcookie("PHPSESSID", '', time() - 1800, '/');
        }

        $request->session()->flush();
        return redirect("/");
    }
}
