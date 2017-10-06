<?php

require 'Framework/Core/autoload.php';

$Application = new \Framework\Core\Application();

$response = $Application->run(\Framework\Core\Request);

