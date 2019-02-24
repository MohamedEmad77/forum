<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/forum', [
    'uses' => 'ForumsController@index',
    'as' => 'forum'
]);


Route::get('{provider}/auth', [
    'uses' => 'SocialsController@auth',
    'as' => 'social.auth'
]);

Route::get('{provider}/redirect', [
    'uses' => 'SocialsController@auth_callback',
    'as' => 'social.callback'
]);

Route::get('discussion/{slug}',[
    'uses' => 'DiscussionsController@show',
    'as' => 'discussion'
]);

Route::group(['middleware' => 'auth'], function(){
    Route::resource('channels', 'ChannelsController');

    Route::get('discussion/create/new',[
        'uses' => 'DiscussionsController@create',
        'as' => 'discussion.create'
    ]);

    Route::post('discussion/store',[
        'uses' => 'DiscussionsController@store',
        'as' => 'discussion.store'
    ]);

   

    Route::post('/discussion/reply/{id}', [
        'uses' => 'DiscussionsController@reply',
        'as' => 'discussion.reply'
    ]);

    Route::get('/reply/like/{id}',[
        'uses' => 'RepliesController@like',
        'as' => 'reply.like'
    ]);

    Route::get('/reply/unlike/{id}',[
        'uses' => 'RepliesController@unlike',
        'as' => 'reply.unlike'
    ]);

    Route::get('/channel/{slug}',[
        'uses' => 'ForumsController@channel',
        'as' => 'channel'
    ]);

    Route::get('/discussion/watch/{id}',[
        'uses' => 'WatchersController@watch',
        'as' => 'discussion.watch'
    ]);

    Route::get('/discussion/unwatch/{id}',[
        'uses' => 'WatchersController@unwatch',
        'as' => 'discussion.unwatch'
    ]);

    Route::get('/discussion/best/reply/{id}',[
        'uses' => 'RepliesController@best_answer',
        'as' => 'reply.best.answer'
    ]);

    Route::get('/discussion/edit/{slug}',[
        'uses' => 'DiscussionsController@edit',
        'as' => 'discussion.edit'
    ]);

    Route::post('/discussion/update/{id}',[
        'uses' => 'DiscussionsController@update',
        'as' => 'discussion.update'
    ]);

});
