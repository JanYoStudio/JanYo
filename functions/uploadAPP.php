<?php
/**
 * Created by PhpStorm.
 * User: myste
 */
header("Content-type:text/html;charset=utf-8");
require 'functions.php';
if (!$_FILES) {
    alertMessage('文件不存在！');
    exit;
}
$name = $_POST['name'];
if (!mkdirs("res/$name")) {
    alertMessage("创建文件夹失败！");
    return;
}
$type = $_POST['type'];
$packageName = $_POST['packageName'];
$description = $_POST['description'];
$latestVersion = $_POST['latestVersion'];
$latestUpdateLog = $_POST['latestUpdateLog'];
$coolapk = $_POST['coolapk'];
$googlePlay = $_POST['googlePlay'];
$source = $_POST['source'];
$icon_tmp_name = $_FILES['file']['tmp_name'];
$icon_error = $_FILES['file']['error'];
$coolapkQRCode_tmp_name = $_FILES['file']['tmp_name'];
$coolapkQRCode_error = $_FILES['file']['error'];
$file_name = $_FILES['file']['name'];
$file_tmp_name = $_FILES['file']['tmp_name'];
$file_error = $_FILES['file']['error'];
$img_target_address = "res/$name/imgRes/";
$file_target_address = "res/$name/apk/";

$tag = true;
if ($icon_error == 0 && $tag) {
    $mes = uploadFile('icon.png', $icon_tmp_name, $img_target_address);
    if (!$mes)
        $tag = false;
}
if ($coolapkQRCode_error == 0 && $tag) {
    $mes = uploadFile('qrcode.png', $coolapkQRCode_tmp_name, $img_target_address);
    if (!$mes)
        $tag = false;
}
if ($file_name == 0 && $tag) {
    $mes = uploadFile($file_name, $file_tmp_name, $file_target_address);
    if (!$mes)
        $tag = false;
}