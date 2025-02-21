<?php

include 'SYS/Autoload.php';

\SYS\Autoload::register();

$config_routes = \APP\Config\Routes::getConfig();

$routing = new \SYS\Routing($config_routes);

$routing->run();