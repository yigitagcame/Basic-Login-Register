<?php

require_once '../core/config.php';


require_once '../helpers/language/en.php';


require_once '../helpers/redirect.php';
require_once '../helpers/abort.php';
require_once '../helpers/validation.php';
require_once '../helpers/request.php';
require_once '../helpers/auth.php';


require_once '../core/Controller.php';
require_once '../core/View.php';
require_once '../core/Model.php';
require_once '../core/bootstrap.php';

$run = new Bootstrap($_GET);

$run->registerController();

