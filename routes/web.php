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

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::post('/signup',[
   'uses'=>'UserController@postSignUp',
    'as'=>'signup'
]);
Route::post('/signin',[
    'uses'=>'UserController@postSignIn',
    'as'=>'signin'
]);

Route::get('/logout',[
    'uses'=>'UserController@getLogout',
    'as'=>'logout',

]);


Route::group(['middleware'=>'auth'], function(){
    Route::get('/dashboard',[
        'uses'=>'PostController@getDashBoard',
        'as'=>'dashboard',

    ]);

    Route::post('/createpost',[
        'uses'=>'PostController@postCreatePost',
        'as'=>'post.create'
    ]);

    Route::get('/delete-post/{post_id}',[
        'uses'=>'PostController@getDeletePost',
        'as'=>'delete.post',

    ]);

    Route::post('/edit',[
        'uses'=>'PostController@postEditPost',
        'as'=>'edit'
    ]);
    Route::post('/accountupdate',[
        'uses'=>'UserController@postSaveAccount',
        'as'=>'account.save'
    ]);
    Route::get('/userimage/{filename}',[
        'uses'=>'PostController@getUserImage',
        'as'=>'account.image',

    ]);
    Route::get('/account',[
        'uses'=>'UserController@getAccount',
        'as'=>'account'
    ]);

    Route::get('/like',[
        'uses'=>'PostController@postLikePost',
        'as'=>'like'
    ]);


//    Route::post('/edit',function (\Illuminate\Http\Request $request){
//return response()->json(['message'=>$request['postId']]);
//    })->name('edit');

});
//->middleware('auth')