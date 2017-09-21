<?php
/**
 * Created by PhpStorm.
 * User: myste
 */
header("Content-type:text/html;charset=utf-8");
require_once 'functions.php';
require_once '../classes/APK.php';

if (!$_FILES) {
    alertMessage('文件不存在！');
    echo "<script language=JavaScript> location.replace('../manager.php');</script>";
    exit;
}
$name = $_POST['name'];
if ($name == '') {
    alertMessage('数据异常！');
    echo "<script language=JavaScript> location.replace('../manager.php');</script>";
    exit;
}
$packageName = $_POST['packageName'];
$apkVersion = $_POST['apkVersion'];
$updateLog = $_POST['updateLog'];
$file_tmp_name = $_FILES['apkFile']['tmp_name'];
$file_error = $_FILES['apkFile']['error'];
$file_target_address = "../res/apk/$packageName/";
if (!mkdirs($file_target_address)) {
    alertMessage("创建文件夹失败！");
    echo "<script language=JavaScript> location.replace('../manager.php');</script>";
    return;
}
if ($file_error == 0 && $tag) {
    $mes = uploadFile($name . '-' . $apkVersion . '.apk', $file_tmp_name, $file_target_address);
    if (!$mes) {
        $tag = false;
        echo "<script language=JavaScript> location.replace('../manager.php');</script>";
    }
}

$apk = new APK();
$apk->url = "res/apk/$packageName/" . $name . '-' . $apkVersion . '.apk';
$apk->version = $apkVersion;
writeAPKtoXML($apk);
echo "<script language=JavaScript> location.replace('../manager.php');</script>";