<?php

Route::get('/', function () {
    return view('index');
});

Route::get('/user', 'gitHubController@getGitHubUser');

Route::get('/search/{user}', 'gitHubController@searchGitHubUser');

Route::get('/followers/{user}/{page}', 'gitHubController@getGitHubUserFollowersPerPage');