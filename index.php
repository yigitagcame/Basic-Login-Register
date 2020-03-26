<?php

require_once 'config.php';
require_once 'core/Bootstrap.php';

$run = new Bootstrap($_GET);

$run->registerController();

