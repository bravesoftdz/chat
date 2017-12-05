<?php

namespace Dykyi;

use Dykyi\Common\PostData;
use Dykyi\Common\Session;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\NullLogger;

/**
 * Class ControllerAbstract
 *
 * @param LoggerInterface|null $logger
 *
 * @package Dykyi
 */
abstract class ControllerAbstract implements ControllerInterface, LoggerAwareInterface
{
    protected $action;
    protected $route;
    protected $view;
    protected $layout = 'main';

    protected $post;
    protected $session;

    protected $message = '';

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * ControllerAbstract constructor.
     *
     * @param LoggerInterface|null $logger
     */
    public function __construct(LoggerInterface $logger = null)
    {
        $this->post    = new PostData();
        $this->session = new Session();
        $this->logger = $logger ?: new NullLogger();
    }

    /**
     * Sets a logger.
     *
     * @param LoggerInterface $logger
     *
     * @return $this
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
        return $this;
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
    private function requireToVar($file)
    {
        ob_start();
        require $file;
        return ob_get_clean();
    }

    /**
     * @param string $view
     * @param array $params
     *
     * @return void
     */
    public function view($view = '', array $params = [])
    {
        foreach ($params as $var => $value) {
            $this->$var = $value;
        }

        $view = empty($view) ? $this->route . '/' . $this->action : $view;
        $this->view = $this->requireToVar(ROOT_DIR . '/views/' . $view . '.php');

        require_once ROOT_DIR . '/views/layout/' . $this->layout . '.php';
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
     *
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