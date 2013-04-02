<?php

Route::controller('admin::home');
Route::controller('admin::auth');
Route::controller('admin::users');
Route::controller('admin::jobtypes');



Route::filter('is_admin', function()
{
    if(!Auth::check()  || ! Auth::user()->role == User::$roles['admin'] )
        return Redirect::to('admin/auth');
});

Asset::container('admin')
    ->add('bootstrap', 'bootstrap/css/bootstrap.min.css')
    ->add('bootstrap-responsive', 'bootstrap/css/bootstrap-responsive.css', 'bootstrap')
    ->add('boorstrap-docs', 'bootstrap/css/docs.css', 'bootstrap')
    ->add('jquery', 'js/jquery-1.9.1.js')
    ->add('bootstrap-js', 'bootstrap/js/bootstrap.js', 'jquery');

