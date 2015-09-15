<?php

Route::any('/', "HomeController@showWelcome");
Route::any('/collage', "HomeController@createCollage");
