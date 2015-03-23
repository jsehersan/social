<?php

//Ajax
Route::post('social/aj/savedeschannel','Jsehersan\Social\Controllers\ConfigController@ajSaveDesChannel');
Route::post('social/aj/validapp','Jsehersan\Social\Controllers\ConfigController@ajfb_ValidApp');

Route::post('social/config/newChannel','Jsehersan\Social\Controllers\ConfigController@postNewChannel');

Route::get('social','Jsehersan\Social\Controllers\HomeController@getIndex');
Route::get('social/config','Jsehersan\Social\Controllers\ConfigController@getIndex');
Route::get('social/channels','Jsehersan\Social\Controllers\HomeController@getChannels');
Route::get('social/channel/delete','Jsehersan\Social\Controllers\ConfigController@delChannel');
/*Route::get('social/config/channel',function(){
	echo "hola";
});*/


Route::get('social/config/channel/{id}',
	array('as'=>'configChannel' ,
		'uses'=>'Jsehersan\Social\Controllers\ConfigController@getConfigChannel'));