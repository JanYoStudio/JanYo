<?php
/**
 * Created by PhpStorm.
 * User: myste
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once WWW . '/functions/functions.php';
require_once WWW . '/classes/APP.php';
$manager = '../manager.php';

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
$img_target_address = WWW . "/res/imgRes/";
$file_target_address = WWW . "/res/apk/$packageName/";

if (!mkdirs($img_target_address)) {
    alertMessage("创建文件夹失败！");
    forwardTo($manager);
    return;
}
if (!mkdirs($file_target_address)) {
    alertMessage("创建文件夹失败！");
    forwardTo($manager);
    return;
}

$tag = true;
if ($icon_error == 0 && $tag) {
    $mes = uploadFile("$packageName.png", $icon_tmp_name, $img_target_address);
    if (!$mes) {
        $tag = false;
        forwardTo($manager);
    }
} else {
    $error = getUploadError($icon_error);
    alertMessage($error);
    forwardTo($manager);
    return;
}
if ($coolapkQRCode_error == 0 && $tag) {
    $mes = uploadFile("qrcode-$packageName.png", $coolapkQRCode_tmp_name, $img_target_address);
    if (!$mes) {
        $tag = false;
        forwardTo($manager);
    }
} else {
    $error = getUploadError($coolapkQRCode_error);
    alertMessage($error);
    forwardTo($manager);
    return;
}
if ($file_error == 0 && $tag) {
    $mes = uploadFile($name . '-' . $latestVersion . '.apk', $file_tmp_name, $file_target_address);
    if (!$mes) {
        $tag = false;
        forwardTo($manager);
    }
} else {
    $error = getUploadError($file_error);
    alertMessage($error);
    forwardTo($manager);
    return;
}
if ($name == '') {
    alertMessage('数据异常！');
    forwardTo($manager);
    exit;
}

$app = new APP();
$app->name = $name;
$app->icon = "res/imgRes/" . "$packageName.png";
$app->type = $type;
$app->packageName = $packageName;
$app->description = $description;
$app->latestVersion = $latestVersion;
$app->latestUpdateLog = $latestUpdateLog;
$app->coolapkQRCode = "res/imgRes/" . "qrcode-$packageName.png";
$app->coolapk = $coolapk;
$app->googlePlay = $googlePlay;
$app->source = $source;
$app->apkURL = "res/apk/$packageName/" . $name . '-' . $latestVersion . '.apk';
writeAPPintoXML($app);
forwardTo($manager);