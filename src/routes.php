<?php

Route::post('social/config/newChannel','Jsehersan\Social\Controllers\ConfigController@postNewChannel');

Route::get('social','Jsehersan\Social\Controllers\HomeController@getIndex');
Route::get('social/config','Jsehersan\Social\Controllers\ConfigController@getIndex');

/*Route::get('social/config/channel',function(){
	echo "hola";
});*/


Route::get('social/config/channel/{id}',
	array('as'=>'configChannel' ,
		'uses'=>'Jsehersan\Social\Controllers\ConfigController@getConfigChannel'));