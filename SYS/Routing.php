<?php
namespace SYS;
class Routing
{
    private $config;

    function __construct($config)
    {
        $this->config = $config;
    }

    function run()
    {
        $url = $_SERVER['REQUEST_URI'];
        /**
         * @var  $urls
         */
        foreach ( $this->config as $url_config)
        {
            $url = urldecode($url);

            $pattern = $url_config[0];
            $reg_ext = $pattern === '' ? '#/#' : "#/$pattern/?#u";

            $result = preg_match($reg_ext, $url, $matches);

            if ($result === 1 && $matches[0] === $url) {

                $method = $url_config[1];

                unset($matches[0]);

                $params = $matches;

                call_user_func_array($method, $params);

                return;
            }
        }

        $code_not_found = 404;
		// fixme дублирование, вынеси 404 в переменную ok
        http_response_code($code_not_found);

		// fixme ну это вообще не куда не годиться, такие ошибки делать, давай внимательнее ok
	    // todo переделай чтобы в строке показывался какой именно урл не найден ok
        echo "Ощибка ".$code_not_found.". Страница ".$_SERVER['HTTP_HOST'].$url." не найдена";

        exit;
    }
}

