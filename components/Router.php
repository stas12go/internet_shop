<?php

class Router
{
    private array $routes;

    public function __construct()
    {
        /* Путь к файлу, в котором лежит массив с данными */
        $routesPath = ROOT . '/config/routes.php';
        /* Добавить в свойство routes этот массив */
        $this->routes = include $routesPath;
    }

    /**
     * Возвращает строку запроса
     * @return string
     */
    private function getURI(): string
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {
        /* Получаю текущую строку запроса */
        $uri = $this->getURI();
        /* Если есть совпадение текущего запроса с теми, что указаны в массиве,
        определить, какой контроллер и экшн обрабатывает запрос:
        1. Проверить наличие текущего запроса в routes.php */
        foreach ($this->routes as $uriPattern => $path) {

            /* 2. Сравнить $uriPattern и $uri */
            if (preg_match("~$uriPattern~", $uri)) {

                /* Создать внутренний маршрут (по сути, дописали .../view/...
                в строку запроса) */
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                /* 3. Определить, какой контроллер и экшн обрабатывают запрос,
                а так же параметры */

                /* 3.1. Разбиваю внутренний путь на составные части */
                $segments = explode('/', $internalRoute);

                /* Определяю контроллер, экшн и параметры*/
                $controllerName = ucfirst(array_shift($segments) . 'Controller');
                $actionName = 'action' . ucfirst(array_shift($segments));
                $parameters = $segments;

                break;
            }
        }

        /* Подключить файл класса-контроллера */
        $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
        if (file_exists($controllerFile)) {
            include_once($controllerFile);
        }
        /* Создать объект, вызвать метод (т.е. экшн) */
        $controllerObject = new $controllerName;
        $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
        if ($result != null) {
        }
    }
}