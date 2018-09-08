<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//全般：MiscMiddlewareはUA判定のために使用
use App\Http\Middleware\MiscMiddleware;

//旧URLに対応するため、リダイレクト
Route::get('/asobi/list', function(){
    header("Location:/article", true, 301);
    exit;
});
Route::get('/asobi/{category}/{misc?}', function($category){
    header("Location:/category/$category", true, 301);
    exit;
});
Route::get('/user/{login_name}/{id}.htm', function($login_name, $id){
    header("Location:/article/$id", true, 301);
    exit;
});


//あそレポのCRUD（あそレポ投稿・個別あそレポ・編集・削除）※見出しはArticleController@Show
Route::get('/aso-repo/img-create', 'AsoRepoController@img_create')->middleware(MiscMiddleware::class);
Route::post('/aso-repo/img-create', 'AsoRepoController@img_store')->middleware(MiscMiddleware::class);
Route::get('/aso-repo/content/{id}', 'AsoRepoController@content');
Route::resource('/aso-repo', 'AsoRepoController')->middleware(MiscMiddleware::class);

//ユーザーのCRUD（新規登録・ユーザーページ・編集・削除）
Route::resource('/user', 'UserController')->middleware(MiscMiddleware::class);

//カテゴリページ
Route::get('/category/{category}', 'MiscController@category')->middleware(MiscMiddleware::class);
//やってみたい
Route::get('/yattemitai', 'MiscController@yattemitai');
//ひどいいね
Route::get('/hidoiine', 'MiscController@hidoiine');
//phpinfo();表示
//Route::get('/phpinfo', 'MiscController@phpinfo');

//以下、フッターにあるリンク集
Route::get('/about', 'AboutController@about')->middleware(MiscMiddleware::class);
Route::get('/kiyaku', 'AboutController@kiyaku')->middleware(MiscMiddleware::class);
Route::get('/kojin', 'AboutController@kojin')->middleware(MiscMiddleware::class);

//ログイン認証
Route::get('/outer/login', 'LoginController@tLogin');
Route::get('/outer/twittercallback', 'LoginController@tCallback');
Route::get('/outer/logout', 'LoginController@tLogout');

//記事のCRUD（新規投稿・表示・編集・削除）
Route::get('/article/restore', 'ArticleController@restore');
Route::resource('/article', 'ArticleController')->middleware(MiscMiddleware::class);
Route::get('/', 'ArticleController@top')->middleware(MiscMiddleware::class);
