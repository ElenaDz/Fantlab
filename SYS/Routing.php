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
            $reg_ext = $pattern === '' ? '#/#' : "#/$pattern/?#";

            $result = preg_match($reg_ext, $url, $matches);

            if ($result === 1 && $matches[0] === $url) {

                $method = $url_config[1];

                unset($matches[0]);

                $params = $matches;

                call_user_func_array($method, $params);

                return;
            }
        }

        http_response_code(404);

        echo "Ощибка 404. Страница не найдена";

        exit;
    }
}

