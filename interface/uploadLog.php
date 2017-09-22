<?php
/**
 * Created by PhpStorm.
 * User: myste
 */
require_once '../functions/functions.php';
require_once '../classes/Log.php';
$appName = $_POST['appName'];
$date = $_POST['date'];
$appVersion = $_POST['appVersionName'] . "_" . $_POST['appVersionCode'];
$androidVersion = $_POST['androidVersion'] . "_" . $_POST['sdk'];
$vendor = $_POST['vendor'];
$model = $_POST['model'];
$fileName = str_replace(':', '_', $_FILES['logFile']['name']); //文件名
$tmp_name = $_FILES['logFile']['tmp_name']; //上传文件的临时名
$error = $_FILES['logFile']['error']; //错误号

$packageName = getPackageName($appName);
if ($packageName == 'null') {
    echo '{"code": -1,"message": "对应APP不存在！"}';
    exit();
}
$targetAddress = "../res/log/$packageName/";
if (!mkdirs($targetAddress)) {
    echo '{"code": -2,"message": "新建文件夹失败！"}';
    exit();
}

if ($error == 0) {
    $mes = uploadFile($fileName, $tmp_name, $targetAddress);
    if (!$mes) {
        echo '{"code": -3,"message": "上传失败！"}';
        exit();
    } else {
        $log = new Log();
        $log->appName = $appName;
        $log->version = $appVersion;
        $log->vendor = $vendor;
        $log->model = $model;
        $log->androidSDK = $androidVersion;
        $log->date = $date;
        $log->logFile = $fileName;
        if (writeLogToXML($log)) {
            echo '{"code": 0,"message": "日志上传成功！"}';
            sendEmail($fileName);
        }
    }
} else {
    $mes = getUploadError($error);
    echo "{\"code\": $error,\"message\": \"$mes\"}";
}