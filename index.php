<?php
session_start();
require('vendor/autoload.php');
require_once ('./config/db.php');

use NoahBuscher\Macaw\Macaw;

Macaw::get('/', 'Controller\BlogController@index');
Macaw::get('page/(:num)', 'Controller\BlogController@view');
Macaw::get('category/(:num)', 'Controller\BlogController@cat');

Macaw::get('/admin', 'Controller\AdminController@index');
Macaw::get('/admin/login', 'Controller\AdminController@showLoginForm');
Macaw::get('/admin/logout', 'Core\AuthClass@logOut');

Macaw::post('/admin/log', 'Core\AuthClass@logIn');
Macaw::post('/admin/reg', 'Controller\UserController@reg');
Macaw::post('/admin/pass', 'Controller\UserController@pass');
Macaw::get('/admin/register', 'Controller\UserController@register');
Macaw::get('/admin/password', 'Controller\UserController@password');
Macaw::get('/admin/addarticle', 'Controller\AdminController@addArticle');

Macaw::get('/admin/article/del/(:num)', 'Controller\AdminController@articleDel');
Macaw::get('/admin/article/edit/(:num)', 'Controller\AdminController@articleEdit');
Macaw::post('/admin/article/edit', 'Controller\AdminController@articleSave');
Macaw::post('/admin/article/add', 'Controller\AdminController@articleAdd');

Macaw::dispatch();
