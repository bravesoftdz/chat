<?php

namespace Dykyi;

/**
 * Interface ControllerInterface
 * @package Dykyi
 */
interface ControllerInterface
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
     * @param $params
     * @return mixed
     */
    public function render($route, array $params);

    /**
     * Render View Page
     *
     * @param $view
     * @param array $params
     * @return mixed
     */
    public function view($view, array $params);

}
