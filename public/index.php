<?php

require_once '../core/config.php';
require_once '../core/Controller.php';
require_once '../core/View.php';
require_once '../core/Model.php';
require_once '../core/bootstrap.php';

$run = new Bootstrap($_GET);

$run->registerController();
