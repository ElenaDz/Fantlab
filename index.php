<?php

include 'SYS/Autoload.php';

\SYS\Autoload::register();

$urls = \APP\Config\Routes::getConfig();

$routing = new \SYS\Routing($urls);

$routing->run();