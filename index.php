<?php

require_once 'config.php';
require_once 'libs/Bootstrap.php';

$run = new Bootstrap($_GET);

$run->registerController();

