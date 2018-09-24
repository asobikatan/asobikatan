<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    public function pop_get(){
        $asobikata_ids = DB::select("select asobikata_id from yattemitais where insert_date > current_date - interval '30 days' group by asobikata_id order by count(asobikata_id) desc limit 20");
        $j = 0;
        for($i = 0; $i < 5; $i++){
            while(true){
                $asobikata_id = $asobikata_ids[$j];
                $j++;
                $asobikatas[$i] = DB::table('asobikatas')->join('users', 'asobikatas.user_id', '=', 'users.id')->where('asobikatas.id', $asobikata_id->asobikata_id)->where('asobikatas.status', 1)->first(["users.name as user_name", "asobikatas.name as a_name", "users.id as uid", "asobikatas.id as id", "asobikatas.outline as outline", "asobikatas.point_1 as point_1", "asobikatas.user_id as user_id", "users.login_id as login_id", "asobikatas.number_safe_min as number_safe_min", "asobikatas.number_safe_max as number_safe_max", "asobikatas.price as price", "asobikatas.one_time as one_time", "asobikatas.place_type as place_type", "asobikatas.detail_3_4 as detail_3_4", "asobikatas.detail_3_5 as detail_3_5", "asobikatas.age_min as age_min", "asobikatas.main_pic as main_pic"]);
                if(isset($asobikatas[$i])){
                    break;
                }
            }
        }
        unset($asobikata_id);

        return $asobikatas;
    }
    public function aso_repo($aid, $page = 0){
        if($page == 0){
            $aso_repo_per_page = 6;
            $offset = 0;
        }else{
            $aso_repo_per_page = 18;
            $offset = ($page - 1) * $aso_repo_per_page;
        }

        //topページの新着あそレポ一覧なら$aid == top
        if($aid == 'top'){
            $count = DB::select("select count(id) as count from aso_repo where status = 1")[0]->count;
            $aso_repos = DB::table('aso_repo')->join('users', 'aso_repo.user_id', '=', 'users.id')->select('users.id as user_id', 'users.name as user_name', 'users.login_id as login_id', 'aso_repo.*')->where('aso_repo.status', 1)->orderBy('aso_repo.id', 'desc')->skip($offset)->take($aso_repo_per_page)->get();
        }else{
            $count = DB::select("select count(*) as count from aso_repo where asobikata_id = :aid and status = 1", ['aid' => $aid])[0]->count;
            $aso_repos = DB::table('aso_repo')->join('users', 'aso_repo.user_id', '=', 'users.id')->select('users.id as user_id', 'users.name as user_name', 'users.login_id as login_id', 'aso_repo.*')->where('aso_repo.asobikata_id', $aid)->where('aso_repo.status', 1)->orderBy('aso_repo.id', 'desc')->skip($offset)->take($aso_repo_per_page)->get();
            $asobikata = DB::table('asobikatas')->where('id', $aid)->where('status', 1)->first();
            $user = DB::table('users')->where('id', $asobikata->user_id)->first();
            $param = [
                'asobikata' => $asobikata,
                'user' => $user
            ];
        }
        $param['aso_repos'] = $aso_repos;
        $param['count'] = $count;

        $pattern = ['/<img(.*)">/', '/<a(.*)">/', '/<\/a>/', '/<strong>/', '/<\/strong>/', '/<strike>/', '/<\/strike>/', '/<p>/', '/<\/p>/'];
        foreach($aso_repos as $aso_repo){
            $aso_repo->content = preg_replace($pattern, '', $aso_repo->content);
        }
        return $param;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function top(Request $request)
    {
        //テストモードON、スタンドアロンでログイン時の挙動を見たい場合、コメント解除されたい。
        //session(['session_user_id' => 263]);

        //トップページ
        //30日間で「やってみたい」が多かったものから上位5件
        $asobikatas = $this->pop_get();

        $session_user_id = $request->session()->get('session_user_id');
        $session_user = DB::table('users')->where('id', $session_user_id)->first();

        if(isset($request->page)){
            $page = $request->page;
            $view = $request->ua . 'layouts.list';
            $param = [];
        }else{
            $page = 0;
            $view = $request->ua . 'layouts.index';
            $param = [
                'asobikatas' => $asobikatas,
                'mode' => $request->mode,
                'restore_id' => $request->restore_id,
            ];
        }
        $aso_repos = $this->aso_repo('top', $page);

        $param += ['session_user' => $session_user,
            'aso_repos' => $aso_repos['aso_repos'],
            'count' => $aso_repos['count'],
            'page' => $page,
            'ua' => $request->ua . 'objects.common']; // UAに応じて表示

        return view($view, $param);

    }

    public function index(Request $request)
    {
        //一覧表示
        //新着順に20件ずつ
        $count = DB::select("select count(*) as count from asobikatas where status = 1");
        $asobikatas = DB::table('asobikatas')->join('users', 'asobikatas.user_id', '=', 'users.id')->where('asobikatas.status', 1)->orderBy('asobikatas.id', 'desc')->skip($request->page * 20)->take(20)->get(["users.name as user_name", "asobikatas.name as a_name", "users.id as uid", "asobikatas.id as id", "asobikatas.outline as outline", "asobikatas.point_1 as point_1", "asobikatas.user_id as user_id", "users.login_id as login_id", "asobikatas.number_safe_min as number_safe_min", "asobikatas.number_safe_max as number_safe_max", "asobikatas.price as price", "asobikatas.one_time as one_time", "asobikatas.place_type as place_type", "asobikatas.detail_3_4 as detail_3_4", "asobikatas.detail_3_5 as detail_3_5", "asobikatas.age_min as age_min", "asobikatas.main_pic as main_pic"]);

        $session_user_id = $request->session()->get('session_user_id');
        $session_user = DB::table('users')->where('id', $session_user_id)->first();
        return view($request->ua . 'layouts.list', ['asobikatas' => $asobikatas, 'count' => $count[0]->count, 'page' => $request->page, 'session_user' => $session_user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //投稿フォーム
        //あなたは誰ですか？
        $session_user_id = $request->session()->get('session_user_id');
        //これ大事。早まるな。idだけわかっても右ペーン出せんやろ。
        $session_user = DB::table('users')->where('id', $session_user_id)->first();

        //ログインしていたらフォーム、していなかったらログイン画面
        if(isSet($session_user)){
            return view($request->ua . 'layouts.create', ['session_user' => $session_user]);
        }else{
            $redirect = '<meta http-equiv="refresh" content="0; URL=' . "'/outer/login'" . '">';
            return response($redirect)->cookie(
                'current_url', '/create', 2
            );
        }

        //ほぼ同じことがAsoRepoController@createでも行われている
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //投稿を受けつけ
        //年齢処理
        $_POST['age_min'] = -1;
        $_POST['age_max'] = 9999;
        switch($request->age){
            case 1:
                $_POST['age_max'] = 10;
                break;
            case 2:
                $_POST['age_min'] = 20;
                break;
        }

        //バリデー書院
        $validate_rule = [
            'user_id' => 'required|integer',
            'name' => 'required|string',
            'outline' => 'required|string',
            'contents_1' => 'required|string',
            'moripoint' => 'required|string',
            'main_pic' => 'required|between: 0, 31',
            'place_type' => 'required|between: 1, 2',
            'age' => 'required|between: 0, 2',
            'number_safe_min' => 'required|integer',
            'number_safe_max' => 'required|integer',
            'one_time' => 'required|integer',
            'detail_3_5' => 'required|between: 0, 2',
        ];

        if($request->pics_1){
            $validate_rule["pics_1"] = 'image|max:10000';
        }
        for($i=2; $i <= 12; $i++){
            if($request->{"contents_$i"}){
                $validate_rule["contents_$i"] = 'string';
            }
            if($request->{"pics_$i"}){
                $validate_rule["pics_$i"] = 'image|max:10000';
            }
        }

        if($request->main_pic == "0"){
            $validate_rule['pics_0'] = 'required|image|max:10000';
        }

        if($request->place !== null){
            $validate_rule['place'] = 'string';
        }
        if($request->car !== null && $request->car == "true"){
            $_POST['place_type'] += 2;
        }
        if($request->price !== null){
            $validate_rule['price'] = 'integer|max:100000000';
        }
        if($request->tools !== null){
            $validate_rule['tools'] = 'string';
        }
        $this->validate($request, $validate_rule);

        if($_POST['number_safe_min'] > $_POST['number_safe_max']){
            $temp = $_POST['number_safe_min'];
            $_POST['number_safe_min'] = $_POST['number_safe_max'];
            $_POST['number_safe_max'] = $temp;
        }

        if(isset($request->delete_pics)){
            foreach($request->delete_pics as $delete_pic){
                \File::delete(public_path() .'/img/asobi/'. $request->id . '/'. $delete_pic .'_200x200.jpg');
            }
            unset($_POST["delete_pics"]);
        }

        unset($_POST['age']);
        unset($_POST['_token']);
        unset($_POST['pics']);
        unset($_POST['car']);
        unset($_POST['x']);
        unset($_POST['y']);

        $main_pic_save = false;
        if($_POST["main_pic"] == 0){
            $main_pic_save = true;
        }elseif($_POST["main_pic"] == 31){
            $_POST["main_pic"] = 0;
        }

        $_POST["user_id"] = (int) $_POST["user_id"];
        $_POST["main_pic"] = (int) $_POST["main_pic"];
        $_POST["place_type"] = (int) $_POST["place_type"];
        $_POST["number_safe_min"] = (int) $_POST["number_safe_min"];
        $_POST["number_safe_max"] = (int) $_POST["number_safe_max"];
        $_POST["detail_3_5"] = (int) $_POST["detail_3_5"];
        $_POST["one_time"] = (int) $_POST["one_time"];
        $_POST["price"] = (int) $_POST["price"];

        //更新動作の場合
        if(isset($request->id)){
            $id = $request->id;
            unset($_POST['id']);
            DB::table('asobikatas')->where('id', $id)->update($_POST);
        }else{
            //新規投稿の場合
            DB::table('asobikatas')->insert($_POST);
            $id = DB::table('asobikatas')->where('name', $request->name)->orderby('id', 'desc')->first()->id;
        }

        //メイン画像が新規投稿時オリジナルなら保存・更新時上書きなら保存
        if($main_pic_save){
            $image = \Image::make(file_get_contents($_FILES['pics_0']['tmp_name']));
            $image->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            if (!file_exists(public_path() .'/img/asobi/'. $id . '/')) {
                mkdir(public_path() .'/img/asobi/'. $id . '/', 0777, true);
            }
            $image->save(public_path() .'/img/asobi/'. $id . '/main_200x200.jpg');
        }
        //手順画像を保存
        for($i = 1; $i <= 12; $i++){
            if(isset($_FILES['pics_'.$i]['tmp_name']) && strlen($_FILES['pics_'.$i]['tmp_name']) > 0){
                $image = \Image::make(file_get_contents($_FILES['pics_'.$i]['tmp_name']));
                $image->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                if (!file_exists(public_path() .'/img/asobi/'. $id . '/')) {
                    mkdir(public_path() .'/img/asobi/'. $id . '/', 0777, true);
                }
                $image->save(public_path() .'/img/asobi/'. $id . '/'. $i .'_200x200.jpg');
            }
        }
        //似た処理がAsoRepoController@img_storeに存在

        unset($_FILES);
        header('Location: /article/'. $id . '?mode=org');
        exit();

        //参考：https://manablog.org/laravel-image-manipulation/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        //個別記事
        $asobikata = DB::table('asobikatas')->where('asobikatas.id', $id)->where('asobikatas.status', 1)->first();
        $user = DB::table('users')->where('id', $asobikata->user_id)->first();
        $mode = $request->mode;
        $url = $request->url();
        $tSharingUrl = "https://twitter.com/intent/tweet?hashtags=%E3%81%82%E3%81%9D%E3%81%B3%E3%82%AB%E3%82%BF%E3%83%B3&amp;original_referer=" . $url . "&amp;ref_src=twsrc%5Etfw&amp;text=%E3%81%82%E3%81%9D%E3%81%B3%E3%82%92%E6%8A%95%E7%A8%BF%E3%81%97%E3%81%9F%E3%82%88%EF%BC%81&amp;tw_p=tweetbutton&amp;url=" . $url;

        //ミドルウェアでやってもよかったよね。↓
        $session_user_id = $request->session()->get('session_user_id');
        $session_user = DB::table('users')->where('id', $session_user_id)->first();

        //やってみたい関連
        $yattemitais = DB::table('yattemitais')->join('users', 'yattemitais.user_id', '=', 'users.id')->where('asobikata_id', $asobikata->id)->orderBy('yattemitais.id', 'desc')->take(5)->get();

        for($i = 1; $i <= 12; $i++){
            $detail_imgs[$i] = null;
            $file_url = public_path() . "/img/asobi/" . $asobikata->id . "/" . $i . "_200x200.jpg";
            if(file_exists($file_url)){
                $detail_imgs[$i] = "/img/asobi/" . $asobikata->id . "/" . $i . "_200x200.jpg";
            }
        }

        //スマホ用上位5件
        $sim_asobikatas = $asobikatas = $this->pop_get();

        //当該あそびカタのあそレポ
        if(isset($request->page)){
            $aso_repos = $this->aso_repo($asobikata->id, $request->page);
            return view($request->ua . 'layouts.list',
                ['aso_repos' => $aso_repos['aso_repos'],
                'count' => $aso_repos['count'],
                'asobikata' => $aso_repos['asobikata'],
                'login_id' => $aso_repos['user']->login_id,
                'user_name' => $aso_repos['user']->name,
                'user_id' => $aso_repos['user']->id,
                'ua' => $request->ua . "objects.common",
                'page' => $request->page,
                'session_user' => $session_user,]);
        }else{
            $aso_repos = $this->aso_repo($asobikata->id);
            return view($request->ua . 'layouts.detail',
                ['yattemitais' => $yattemitais,
                'asobikata' => $asobikata,
                'sim_asobikatas' => $sim_asobikatas,
                'aso_repos' => $aso_repos['aso_repos'],
                'count' => $aso_repos['count'],
                'session_user' => $session_user,
                'tSharingUrl' => $tSharingUrl,
                'url' => $url,
                'mode' => $mode,
                'isAndroid' => $request->isAndroid,
                'ua' => $request->ua . "objects.common",
                'user_name' => $user->name,
                'login_id' => $user->login_id,
                'user_id' => $user->id,
                'detail_imgs' => $detail_imgs,
            ]);
        }
        //user1つで済ませず、user_nameなりlogin_idなり使って汚くも見えるが、listを共通化するために仕方なく行なっている。
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
        //投稿者を取得
        $asobikata = DB::table('asobikatas')->where('asobikatas.id', $id)->where('asobikatas.status', 1)->first();
        //あなたは誰ですか？
        $session_user_id = $request->session()->get('session_user_id');
        //これ大事。早まるな。idだけわかっても右ペーン出せんやろ。
        $session_user = DB::table('users')->where('id', $session_user_id)->first();

        //ログインしていたらフォーム、していなかったらログイン画面
        if(isSet($session_user_id)){
            if($asobikata->user_id == $session_user_id){
                for($i = 1; $i <= 12; $i++){
                    $asobikata->pics[$i] = false;
                    if (file_exists(public_path() .'/img/asobi/'. $asobikata->id . '/' . $i . '_200x200.jpg')) {
                        $asobikata->pics[$i] = true;
                    }
                }
                return view($request->ua . 'layouts.edit', ['session_user' => $session_user, 'asobikata' => $asobikata,]);
            }else{
                header('Location: /?mode=edit_failed');
                exit();
            }
        }else{
            $redirect = '<meta http-equiv="refresh" content="0; URL=' . "'/outer/login'" . '">';
            return response($redirect)->cookie(
                'current_url', '/article/' . $id . '/edit', 2
            );
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
        //記事の更新書き込み
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
        //記事の削除
        $param = ['status' => 0];
        DB::table('asobikatas')->where('id', $id)->update($param);
        $restore_id = DB::table('asobikatas')->where('id', $id)->where('status', 0)->first();
        if(isset($restore_id)){
            $restore_id = $restore_id->id;
        }else{
            $restore_id = 'false';
        }

        header('Location: /?mode=deleted&restore_id=' . $restore_id);
        exit();
    }
    public function restore(Request $request)
    {
        //記事の復元
        //modeで分岐、あそびカタの復元？あそレポの復元？
        $mode = substr($request->restore_id, 0, 2);
        if($mode == 'ar'){
            $table = 'aso_repo';
            $restore_id = substr($request->restore_id, 2);
            $location = 'aso-repo/';
        }else{
            $table = 'asobikatas';
            $restore_id = $request->restore_id;
            $location = 'article/';
        }

        //指定されたidのあそびカタ or あそレポを取得
        $data = DB::table($table)->where('id', $restore_id)->where('status', 0)->first();
        //該当あり？
        if(isset($data)){
            //本人？
            if($request->session()->get('session_user_id') == $data->user_id){
                $param = ['status' => 1];
                DB::table($table)->where('id', $restore_id)->update($param);
                $restored = DB::table($table)->where('id', $restore_id)->where('status', 1)->first();
                if(isset($restored)){
                    header('Location: /' . $location . $restore_id . '?mode=restored');
                    exit();
                }
            }
        }
        header('Location: /?mode=restore_failed');
        exit();
    }
}
