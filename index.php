<?php
require('vendor/autoload.php');

use NoahBuscher\Macaw\Macaw;

Macaw::get('/', 'App\Controller@index');
Macaw::get('page', 'App\Controller@page');
Macaw::get('view/(:num)', 'App\Controller@view');
Macaw::get('user/edit/(:num)', 'App\Controller@user');



Macaw::dispatch();