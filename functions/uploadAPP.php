<?php
/**
 * Created by PhpStorm.
 * User: myste
 */
header("Content-type:text/html;charset=utf-8");
require_once 'functions.php';
require_once '../classes/APP.php';
if (!$_FILES) {
    alertMessage('文件不存在！');
    echo "<script language=JavaScript> location.replace('../manager.php');</script>";
    exit;
}
$name = $_POST['name'];
$type = $_POST['type'];
$packageName = $_POST['packageName'];
$description = $_POST['description'];
$latestVersion = $_POST['latestVersion'];
$latestUpdateLog = nl2br($_POST['latestUpdateLog']);
$coolapk = $_POST['coolapk'];
$googlePlay = $_POST['googlePlay'];
$source = $_POST['source'];
$icon_tmp_name = $_FILES['icon']['tmp_name'];
$icon_error = $_FILES['icon']['error'];
$coolapkQRCode_tmp_name = $_FILES['coolapkQRCode']['tmp_name'];
$coolapkQRCode_error = $_FILES['coolapkQRCode']['error'];
$file_tmp_name = $_FILES['file']['tmp_name'];
$file_error = $_FILES['file']['error'];
$img_target_address = "../res/imgRes/";
$file_target_address = "../res/apk/$packageName/";

if (!mkdirs($img_target_address)) {
    alertMessage("创建文件夹失败！");
    echo "<script language=JavaScript> location.replace('../manager.php');</script>";
    return;
}
if (!mkdirs($file_target_address)) {
    alertMessage("创建文件夹失败！");
    echo "<script language=JavaScript> location.replace('../manager.php');</script>";
    return;
}

$tag = true;
if ($icon_error == 0 && $tag) {
    $mes = uploadFile("$packageName.png", $icon_tmp_name, $img_target_address);
    if (!$mes) {
        $tag = false;
        echo "<script language=JavaScript> location.replace('../manager.php');</script>";
    }
}
if ($coolapkQRCode_error == 0 && $tag) {
    $mes = uploadFile("qrcode-$packageName.png", $coolapkQRCode_tmp_name, $img_target_address);
    if (!$mes) {
        $tag = false;
        echo "<script language=JavaScript> location.replace('../manager.php');</script>";
    }
}
if ($file_error == 0 && $tag) {
    $mes = uploadFile($name . '-' . $latestVersion . '.apk', $file_tmp_name, $file_target_address);
    if (!$mes) {
        $tag = false;
        echo "<script language=JavaScript> location.replace('../manager.php');</script>";
    }
}

$app = new APP();
$app->name = $name;
$app->icon = "res/imgRes/$packageName.png";
$app->type = $type;
$app->packageName = $packageName;
$app->description = $description;
$app->latestVersion = $latestVersion;
$app->latestUpdateLog = $latestUpdateLog;
$app->coolapkQRCode = "res/imgRes/qrcode-$packageName.png";
$app->coolapk = $coolapk;
$app->googlePlay = $googlePlay;
$app->source = $source;
$app->apkURL = "res/apk/$packageName/" . $name . '-' . $latestVersion . '.apk';
writeAPPintoXML($app);
echo "<script language=JavaScript> location.replace('../manager.php');</script>";