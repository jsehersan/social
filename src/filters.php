<?php

/*
  |--------------------------------------------------------------------------
  | Application & Route Filters
  |--------------------------------------------------------------------------
  |
  | Below you will find the "before" and "after" events for the application
  | which may be used to do any work before or after a request into your
  | application. Here you may also register your custom route filters.
  |
 */

App::before(function($request) {
            //
        });


App::after(function($request, $response) {
            //
        });

/*
  |--------------------------------------------------------------------------
  | Authentication Filters
  |--------------------------------------------------------------------------
  |
  | The following filters are used to verify that the user of the current
  | session is logged into this application. The "basic" filter easily
  | integrates HTTP Basic authentication for quick, simple checking.
  |
 */

Route::filter('auth', function() {
            if (Auth::guest())
                return Redirect::guest(Helpers::getAdminRoute().'/login');
        });



//Filtro para las llamadas a la API
Route::filter('authApi', function($route) {
            $usuario = $route->getParameter('user');
            $password = $route->getParameter('pass');
            $passwordhash = Hash::make($password);
      
            $credenciales = array('username' => $usuario, 'password' => $password);
            if (!Auth::attempt($credenciales)) {
                 OpcionesController::correoAdmin("Intento fallido de conectar a la api ");
                return  App::abort(404);
            }
            
        });

//Rutas de administrador
Route::filter('admin', function() {
            if (!Auth::user()->acl==2){
                $fallo[]="No eres administrador";
                Session::flash('fallo', $fallo);
                return Redirect::to(Helpers::getAdminRoute().'/');
            }
        });

//Rutas de ROOT
Route::filter('root', function() {
            if (!Auth::user()->acl==3){
                $fallo[]="No eres ROOT";
                Session::flash('fallo', $fallo);
                return Redirect::to(Helpers::getAdminRoute().'/');
            }
        });
        
Route::filter('auth.basic', function() {
            return Auth::basic();
        });

/*
  |--------------------------------------------------------------------------
  | Guest Filter
  |--------------------------------------------------------------------------
  |
  | The "guest" filter is the counterpart of the authentication filters as
  | it simply checks that the current user is not logged in. A redirect
  | response will be issued if they are, which you may freely change.
  |
 */

Route::filter('guest', function() {
            if (Auth::check())
                return Redirect::to('/');
        });

/*
  |--------------------------------------------------------------------------
  | CSRF Protection Filter
  |--------------------------------------------------------------------------
  |
  | The CSRF filter is responsible for protecting your application against
  | cross-site request forgery attacks. If this special token in a user
  | session does not match the one given in this request, we'll bail.
  |
 */

Route::filter('csrf', function() {
            if (Request::getMethod() !== 'GET' && Session::token() != Input::get('_token')) {
                throw new Illuminate\Session\TokenMismatchException;
            }
        });