<?php
class Route
{

    private static function getUri()
    {
        if(!empty($_SERVER['REQUEST_URI'])){
            $uri = trim($_SERVER['REQUEST_URI'],'/');
            return $uri;
        }
    }

    static function start()
    {
        // контроллер и действие по умолчанию
        $controller_name = 'Main';
        $action_name = 'index';
        $params = null;

        $routes = self::getUri();

        $segments = explode('/',$routes);

        // получаем имя контроллера
        if (!empty($segments[0])) {
            $controller_name = array_shift($segments);
        }

        // получаем имя экшена
        if (!empty($segments[0])) {
            $action_name = array_shift($segments);
        }

        $paramSegments = $segments;

        // добавляем префиксы
        $model_name = ucfirst($controller_name).'Model';
        $controller_name =  ucfirst($controller_name).'Controller';
        $action_name = 'action' . ucfirst($action_name);
        // подцепляем файл с классом модели (файла модели может и не быть)
        $model_file = $model_name. '.php';
        $model_path = "app/models/" . $model_file;
        if (file_exists($model_path)) {
           // include "app/models/" . $model_file;
        }
        // подцепляем файл с классом контроллера
        $controller_file = $controller_name . '.php';
        $controller_path = "app/controllers/" . $controller_file;
        if (file_exists($controller_path)) {
            //include "app/controllers/" . $controller_file;
        } else {
            /*
            правильно было бы кинуть здесь исключение,
            но для упрощения сразу сделаем редирект на страницу 404
            */
            Route::ErrorPage404();
        }
        // если контроллер в файле не определен, то выбрасываем 404
        if(!class_exists($controller_name)){
            Route::ErrorPage404();
        } else {
            $controller = new $controller_name;
            $action = $action_name;
            if (method_exists($controller, $action)) {
                // вызываем действие контроллера
                if($paramSegments){
                    $controller->$action($paramSegments);
                } else {
                    $controller->$action();
                }
            } else {
                // здесь также разумнее было бы кинуть исключение
                Route::ErrorPage404();
            }
        }
    }
    static function ErrorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/Error404';
        header('Location:' . $host);
    }
}