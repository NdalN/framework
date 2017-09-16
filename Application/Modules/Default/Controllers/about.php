<?php

namespace Controllers;

use Core\View as View;
use Core\Controller as Controller;
use Core\IControllerSecurity as IControllerSecurity;
use Core\ApplicationContext as ApplicationContext;

class About extends Controller implements IControllerSecurity
{
    public function __construct(ApplicationContext $applicationContext)
    {
        $this->applicationContext = $applicationContext;
        $this->authorizedRoles = 'admins, viewer';
    }

    public function index()
    {
        View::renderBody('about/index.php', null, $this->applicationContext);
    }
}
