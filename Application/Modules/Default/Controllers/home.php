<?php

namespace Controllers;

use Core\View as View;
use Core\Controller as Controller;
use Core\ApplicationContext as ApplicationContext;

class Home extends Controller
{
    public function __construct(ApplicationContext $applicationContext)
    {
        $this->applicationContext = $applicationContext;
    }

    public function index()
    {
        View::renderBody('home/index.php', null, $this->applicationContext);
    }

    public function about()
    {
        View::renderBody('home/about.php', null, $this->applicationContext);
    }

    public function contact()
    {
        View::renderBody('home/contatc.php', null, $this->applicationContext);
    }
}
