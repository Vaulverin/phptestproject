<?php
class Route
{
	static function start()
	{
		// контроллер и действие по умолчанию
		$controller_name = 'Default';
		$action_name = 'Default';
		$uri = explode('?', $_SERVER['REQUEST_URI']);
		$routes = explode('/', $uri[0]);
		
		// получаем имя контроллера
		if ( !empty($routes[1]) )
		{	
			$controller_name = $routes[1];
		}
		
		// получаем имя экшена
		if ( !empty($routes[2]) )
		{
			$action_name = $routes[2];
		}

		// добавляем префиксы
		$model_name = 'Model'.$controller_name;
		$controller_name = 'Controller'.$controller_name;
		$action_name = 'Action'.$action_name;

		// подцепляем файл с классом модели (файла модели может и не быть)

		$model_file = $model_name.'.php';
		$model_path = "./application/Models/".$model_file;
		if(file_exists($model_path))
		{
			include "./application/Models/".$model_file;
		}

		// подцепляем файл с классом контроллера
		$controller_file = $controller_name.'.php';
		$controller_path = "./application/Controllers/".$controller_file;
		if(file_exists($controller_path))
		{
			include "./application/Controllers/".$controller_file;
		}
		else
		{
			Route::ErrorPage404();
		}
		
		// создаем контроллер
		$controller = new $controller_name();
		$action = $action_name;
		
		if(class_exists($model_name))
		{
			$controller->model = new $model_name();
		}

		if(method_exists($controller, $action))
		{
			// вызываем действие контроллера
			$controller->$action();
		}
		else
		{
			Route::ErrorPage404();
		}
	
	}
	
	public static function ErrorPage404()
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }
}