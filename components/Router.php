<?php

class Router 
{
    private $routes;
    public $count = 0;
    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    private function getURI()
    {
        $uri = null;
        if(!empty($_SERVER["REQUEST_URI"]))
        {
            $uri = trim($_SERVER["REQUEST_URI"], '/');
        }
        return $uri;
    }

    public function run()
    {
        $uri = $this->getURI();
        foreach($this->routes as $uriPattern => $path)
        {
            if(preg_match("~$uriPattern~", $uri))
            {
                $internalRout = preg_replace("~$uriPattern~", $path, $uri);

                $segments = explode('/', $internalRout);

                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action' . ucfirst(array_shift($segments));

                $parameters = $segments;

                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                if(file_exists($controllerFile))
                {
                    require_once($controllerFile);
                }

                $controllerObject = new $controllerName;

                if(method_exists($controllerObject, $actionName))
                {
                    $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                    $this->count++;
                    break;
                }
            }
        }
        if($this->count == 0)
        {
            echo "404 error Rout not Found";
        }
    }

}

?>