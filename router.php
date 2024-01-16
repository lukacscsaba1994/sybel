<?php

class Router {
    public function route() {
        $controller = isset($_GET['controller']) ? $_GET['controller'] : 'Index';
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';
        $parameter = isset($_GET['param']) ? $_GET['param'] : 'DefaultParameter';

        $controllerName = ucfirst(strtolower($controller)) . 'Controller';
        $actionName = $action;

        $controllerFilePath = 'controllers/' . $controllerName . '.php';
        if (file_exists($controllerFilePath)) {
            require_once($controllerFilePath);

            if (class_exists($controllerName)) {
                $controllerInstance = new $controllerName();

                if (method_exists($controllerInstance, $actionName)) {
                    $controllerInstance->$actionName($parameter);
                } else {
                    echo 'Error: Action not found.';
                }
            } else {
                echo 'Error: Controller class not found.';
            }
        } else {
            echo 'Error: Controller file not found.';
        }
    }
}

?>
