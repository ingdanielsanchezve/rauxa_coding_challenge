<?php

Route::get('/', function () {
    return view('index');
});

Route::get('/search/{user}', 'gitHubController@getGitHubUser');

Route::get('/followers/{user}/{page}', 'gitHubController@getGitHubUserFollowersPerPage');