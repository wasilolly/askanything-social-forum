<?php


Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile/{slug}', 'ProfileController@profileThreads')->name('profile');
Route::get('/profile/{slug}/threads', 'ProfileController@profileThreads')->name('profile.threads');
Route::get('/profile/{slug}/followers', 'ProfileController@profileFollowers')->name('profile.followers');
Route::get('/profile/{slug}/followings', 'ProfileController@profileFollowings')->name('profile.followings');
Route::get('/profile/edit/profile', 'ProfileController@edit')->name('profile.edit');
Route::post('/profile/update/profile', 'ProfileController@update')->name('profile.update');

Route::get('/check/{id}', 'FollowController@check');
Route::get('/follow/{id}', 'FollowController@follow');
Route::get('/unfollow/{id}', 'FollowController@unFollow');

Route::get('/forum', 'ForumController@index')->name('forum');
Route::get('/forum/myquestions', 'ForumController@userQuestions')->name('user.questions');
Route::get('/forum/channel/{slug}', 'ChannelController@show')->name('channel.show');
Route::get('/forum/thread/{slug}', 'ThreadController@show')->name('thread.show');
Route::post('/forum/thread/reply/{id}', 'ReplyController@store')->name('thread.reply');

Route::get('/dashboard/users', 'AdminController@users')->name('users');
Route::get('/dashboard/user/admin/{id}', 'AdminController@admin')->name('user.admin');
Route::get('/dashboard/user/revoke/{id}', 'AdminController@revokeAdmin')->name('user.revoke');
Route::delete('/dashboard/user/delete/{id}', 'AdminController@userDelete')->name('user.delete');


Route::resources([
	'channels'=>'ChannelController',
	'threads'=>'ThreadController'
]);

