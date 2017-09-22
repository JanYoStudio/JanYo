<?php
/**
 * Created by PhpStorm.
 * User: myste
 */
header("Content-type:text/html;charset=utf-8");
require_once '../functions/functions.php';
require_once '../classes/APK.php';
$manager = '../manager.php';

$name = $_POST['name'];
$packageName = $_POST['packageName'];
$apkVersion = $_POST['apkVersion'];
$updateLog = nl2br($_POST['updateLog']);
$file_tmp_name = $_FILES['apkFile']['tmp_name'];
$file_error = $_FILES['apkFile']['error'];
$file_target_address = "../res/apk/$packageName/";
if (!mkdirs($file_target_address)) {
    alertMessage("创建文件夹失败！");
    forwardTo($manager);
    return;
}
if ($file_error == 0) {
    $mes = uploadFile($name . '-' . $apkVersion . '.apk', $file_tmp_name, $file_target_address);
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

$apk = new APK();
$apk->url = "res/apk/$packageName/" . $name . '-' . $apkVersion . '.apk';
$apk->version = $apkVersion;
$apk->updateLog = $updateLog;
writeAPKtoXML($name, $apk);
forwardTo($manager);