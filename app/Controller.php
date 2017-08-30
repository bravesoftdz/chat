<?php

namespace Dykyi;

use Dykyi\Common\PostData;
use Dykyi\Common\Session;

/**
 * Interface IController
 * @package Dykyi
 */
interface IController
{
    /**
     * Index page must have
     *
     * @return mixed
     */
    public function index();

    /**
     * Render To Action
     *
     * @param $route
     * @return mixed
     */
    public function render($route);

    /**
     * Render View Page
     *
     * @param $view
     * @param array $params
     * @return mixed
     */
    public function view($view, array $params);

}

/**
 * Class Controller
 * @package Dykyi
 */
abstract class AbstractController implements IController
{
    protected $action;
    protected $route;

    protected $post;
    protected $session;


    function __construct()
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
     * @param string $view
     * @param array $params
     * @return mixed
     */
    public function view($view = '', array $params = [])
    {
        foreach ($params as $var => $value) {
            $this->$var = $value;
        }
        $view = empty($this->route) ? $view : $this->route;
        return require_once(ROOT_DIR.'/views/' . $view . '.php');
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
     * @param $route
     * @return bool
     */
    public function render($route = '/')
    {
        header('Location: ' . $route);
        return true;
    }

}