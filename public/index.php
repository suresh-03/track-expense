<?php

session_start();
require_once '../app/core/init.php';

$app = new App();
$app->useRouter();
