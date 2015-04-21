<?php



   Route::group(array('before' => 'auth'),
            function() {
                    // AJAX
                Route::post('social/aj/savedeschannel','Jsehersan\Social\Controllers\ConfigController@ajSaveDesChannel');
                Route::post('social/aj/validapp','Jsehersan\Social\Controllers\ConfigController@ajfb_ValidApp');
                Route::get('social/aj/validapp','Jsehersan\Social\Controllers\ConfigController@ajfb_ValidApp');

                Route::post('social/config/newChannel','Jsehersan\Social\Controllers\ConfigController@postNewChannel');
                    // TEST
                Route::get('social/config/test','Jsehersan\Social\Controllers\ConfigController@getTest');

                    // LIMPIA PARAMS de un canal
                Route::get('social/config/channel/limpia','Jsehersan\Social\Controllers\ConfigController@getLimpiaParams');


                Route::get('social/channel/new','Jsehersan\Social\Controllers\ConfigController@getNewChannel');
                Route::get('social/channels','Jsehersan\Social\Controllers\HomeController@getChannels');
                Route::get('social/channel/delete','Jsehersan\Social\Controllers\ConfigController@delChannel');
                Route::get('social/channel/main','Jsehersan\Social\Controllers\ConfigController@setMain');

                Route::get('social/config/channel/{id}',
                    array('as' => 'configChannel',
                        'uses' => 'Jsehersan\Social\Controllers\ConfigController@getConfigChannel'));
                    // CONFIG

                Route::get('social/config/','Jsehersan\Social\Controllers\ConfigController@getConfig');
                Route::post('social/config/save','Jsehersan\Social\Controllers\ConfigController@setConfig');

                //Publicaciones
                Route::get('social/publications','Jsehersan\Social\Controllers\HomeController@getPublications');
                Route::get('social/publications/clean','Jsehersan\Social\Controllers\PublicationsController@cleanPublish');

                Route::get('social/publication/{id}','Jsehersan\Social\Controllers\HomeController@getPublication');
                Route::get('social/publication/publish/{id}','Jsehersan\Social\Controllers\PublicationsController@setPublish');

                 // Rutas de Root , usuario maestra para configuraciones
                     Route::group(array('before' => 'root'),
                            function() {
                                Route::get('social/publications/cleanall','Jsehersan\Social\Controllers\PublicationsController@cleanallPublish');
                            });
            });
