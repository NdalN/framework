<?php

namespace Controllers;

use Core\View as View;
use Core\Controller as Controller;
use Core\ApplicationContext as ApplicationContext;
use Models\ErrorPageModel as ErrorPageModel;
use Models\ErrorPageType as ErrorPageType;

class Error extends Controller
{
    private $errorPageModel;

    public function __construct(ErrorPageModel $errorPageModel, ApplicationContext $applicationContext)
    {
        $this->applicationContext = $applicationContext;
        $this->errorPageModel = $errorPageModel;
    }

    public function index()
    {
        // load views
        $layout;
        $view;
        $comment;

        $layout = View::LAYOUT_PUBLIC;

        switch ($this->errorPageModel->errorPageType) {
            case ErrorPageType::METHOD_NOT_FOUND:
                $view = 'error/404.php';
                $comment = 'Method not found';
                break;
            case ErrorPageType::CONTROLLER_NOT_FOUND:
                $view = 'error/404.php';
                $comment = 'Controller not found';
                break;
            case ErrorPageType::CONTROLLER_FORBIDDEN:
                $view = 'error/403.php';
                $comment = 'Controller forbidden';
                break;
            default:
                $view = 'error/404.php';
                break;
        }

        View::renderBody($view, $this->errorPageModel, $this->applicationContext, $layout);
    }
}
