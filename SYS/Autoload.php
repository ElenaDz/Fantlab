<?php
namespace SYS;

class Autoload
{
	public static function register()
	{
	    spl_autoload_register(
	        function ($class_name) {
	            $file_path = str_replace('\\', '/', $class_name).'.php';
	            include $file_path;
	        }
	    );
	}
}