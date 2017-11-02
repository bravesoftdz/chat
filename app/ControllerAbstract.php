<?php

namespace Dykyi;

use Dykyi\Common\PostData;
use Dykyi\Common\Session;

/**
 * Class ControllerAbstract
 * @package Dykyi
 */
abstract class ControllerAbstract implements ControllerInterface
{
    protected $action;
    protected $route;
    protected $view;
    protected $layout = 'main';

    protected $post;
    protected $session;

    protected $message = '';

    /**
     * AbstractController constructor.
     */
    public function __construct()
    {
        $this->post    = new PostData();
        $this->session = new Session();
    }

    /**
     * @param $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @param $route
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

    /**
     * @param $file
     *
     * @return string
     */
    private function _requireToVar($file)
    {
        ob_start();
        require($file);
        return ob_get_clean();
    }

    /**
     * @param string $view
     * @param array $params
     * @return mixed
     */
    public function view($view = '', array $params = [])
    {
        foreach ($params as $var => $value) {
            $this->$var = $value;
        }

        $view = empty($view) ? $this->route . '/' . $this->action : $view;
        $this->view = $this->_requireToVar(ROOT_DIR . '/views/' . $view . '.php');
        return require_once(ROOT_DIR . '/views/layout/' . $this->layout . '.php');
    }

    /**
     * @param $name
     */
    public function setLayout($name)
    {
        $this->layout = $name;
    }


    /**
     * Respons to ajax
     *
     * @param $data
     * @return bool
     */
    public function json($data)
    {
        echo json_encode($data);
        return true;
    }

    /**
     * Respons to ajax
     *
     * @param $data
     * @param $fields
     * @return bool
     */
    public function toJson($data, array $fields = [])
    {
        if (empty($fields)) {
            return json_encode($data);
        }

        $tmp = [];
        foreach ($fields as $param) {
            $tmp[$param] = $data[$param];
        }
        return json_encode($tmp);

    }

    /**
     * @param string $route
     * @param array $params
     * @return bool
     */
    public function render($route = '', array $params = [])
    {
        foreach ($params as $key => $value) {
            $this->session->set($key, $value);
        }

        header('Location: /' . $route);
        return true;
    }


    /**
     * @return mixed|string
     */
    public function getGlobalMessage()
    {
        $message = $this->session->get('message');
        $this->session->remove('message');
        return $message;
    }

}