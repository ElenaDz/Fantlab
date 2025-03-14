<?php

include 'SYS/Autoload.php';

\SYS\Autoload::register();

try {
    $config_routes = \APP\Config\Routes::getConfig();

    $routing = new \SYS\Routing($config_routes);

    $routing->run();

} catch (Exception $exception) {
    \SYS\Error::showError(
        $exception->getMessage(),
        500
    );
}