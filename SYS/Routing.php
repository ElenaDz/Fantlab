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

        foreach ( $this->config as $url_config)
        {
            $url = urldecode($url);

            $pattern = $url_config[0];
			// fixme у тебя последний / не обязательный из за этого одна страница доступа и по урл со / и без,
	        // это серьезная ошибка так как одна станица должна быть доступна только по одному урл, иначе поисковики
	        // воспринимают это как дублирование станиц. Исправить
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

        http_response_code($code_not_found);

        echo "Ошибка ".$code_not_found.". Страница ".$url." не найдена";

        exit;
    }
}

