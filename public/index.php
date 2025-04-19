<?php


require_once '../app/core/init.php';

$app = new App();
$app->useRouter();
$app->useSession();