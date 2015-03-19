<?php

Route::post('social/config/newChannel','Jsehersan\Social\Controllers\ConfigController@postNewChannel');

Route::get('social','Jsehersan\Social\Controllers\HomeController@getIndex');
Route::get('social/config','Jsehersan\Social\Controllers\ConfigController@getIndex');
