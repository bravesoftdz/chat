<?php

namespace Dykyi;

use Dotenv\Dotenv;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use stdClass;

/**
 * Class Application
 * @package Dykyi
 */
class Application
{

    /**
     * @param $param
     * @return null
     */
    private function getUrlParam($param)
    {
        return empty($param) ? null : $param;
    }

    /**
     * @return stdClass
     */
    private function parseURI()
    {
        $std = new stdClass();
        $uri = substr($_SERVER['REQUEST_URI'], 1);
        $pos = strpos($uri, "?");
        if ($pos > 0) {
            $uri = substr($uri, 0, $pos);
        }

        $uri       = explode('/', $uri);
        $std->route     = empty($uri[0]) ? 'index' : $uri[0];
        $std->action    = empty($uri[1]) ? 'index' : $uri[1];
        $arguments = [];
        for ($i = 2; $i < count($uri); $i++) {
            $arguments[$i] = $this->getUrlParam($uri[$i]);
        }
        $std->arguments = $arguments;
        return $std;
    }

    private function debugRegister()
    {
        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();
    }

    /**
     * @param bool $debug
     */
    public function run($debug = false)
    {
        if ($debug === true){
           $this->debugRegister();
        }

        //Init Class
        $route = $this->parseURI();
        $className = __NAMESPACE__ . "\\Controller\\" . ucfirst($route->route) . 'Controller';
        $class     = new $className();
        $class->setAction($route->action);
        $class->setRoute($route->route);

        $action = $route->action;
        $fct = new \ReflectionMethod($className, $action);
        if ($fct->getNumberOfRequiredParameters() > 0){
            $class->$action(...$route->arguments);
        } else{
            $class->$action();
        }
    }
}