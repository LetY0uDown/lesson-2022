<?php
require('vendor/autoload.php');

use NoahBuscher\Macaw\Macaw;

Macaw::get('/',             'App\TodoController@index');
Macaw::post('add/(:str)',          'App\TodoController@add');
Macaw::get('del/(:num)',    'App\TodoController@del');
Macaw::get('change/(:num)', 'App\TodoController@change');
Macaw::get('edit/(:num)',   'App\TodoController@edit');
Macaw::post('update',       'App\TodoController@update');

Macaw::dispatch();