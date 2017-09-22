<?php
require_once 'functions.php';
$appName = $_GET['appName'];
$file = $_GET['file'];
$packageName = getPackageName($appName);
if ($packageName == 'null') {
    alertMessage('未找到对应APP');
    forwardTo('../manager.php');
    exit();
}
$content = file_get_contents("../res/log/$packageName/$file");
echo $content;