<?php
/**
 * Created by PhpStorm.
 * User: myste
 * @param $filename : 存储的文件名
 * @param $tmp_name : 临时文件名
 * @param $targetAddress : 存放路径
 * @return bool
 */

function uploadFile($filename, $tmp_name, $targetAddress)
{
    if (file_exists($targetAddress . $filename)) {
        alertMessage("文件 $targetAddress$filename 已存在！");
        return false;
    }
    if (is_uploaded_file($tmp_name)) {
        $destination = $targetAddress . $filename;
        if (move_uploaded_file($tmp_name, $destination)) {
            return $filename;
        } else {
            return false;
        }
    }
    return false;
}

/**
 * Created by PhpStorm.
 * User: myste
 * @param $error
 * @return string
 */
function getUploadError($error)
{
    switch ($error) {
        case 1:
            $mes = "超过了配置文件上传文件的大小";
            break;
        case 2:
            $mes = "超过了表单设置上传文件的大小";
            break;
        case 3:
            $mes = "文件部分被上传";
            break;
        case 4:
            $mes = "没有文件被上传";
            break;
        case 6:
            $mes = "没有找到临时目录";
            break;
        case 7:
            $mes = "文件不可写";
            break;
        case 8:
            $mes = "由于php的扩展程序中断了程序上传";
            break;
        default:
            $mes = "未知错误";
    }
    return $mes;
}

function alertMessage($message)
{
    echo "<script language='javascript'>alert('$message');</script>";
}

function snackBarMessage($message)
{
    echo "<script language='javascript'>mdui.snackbar({message: '$message',timeout: 1500});</script>";
}

/**
 * Created by PhpStorm.
 * User: myste
 * @param $dir : 文件夹路径
 * @param int $mode : 权限
 * @return bool
 */
function mkdirs($dir, $mode = 0777)
{
    if (is_dir($dir) || @mkdir($dir, $mode)) return TRUE;
    if (!mkdirs(dirname($dir), $mode)) return FALSE;
    return @mkdir($dir, $mode);
}

/**
 * Created by PhpStorm.
 * User: myste
 * @param APP $app: 要保存到xml中的app对象
 */
function writeAPPintoXML(APP $app)
{
    $appFile = "../data/app-list.xml";
    $file = new DOMDocument();
    $file->load($appFile);
    $targetNode = $file->getElementsByTagName('app-list')->item(0);
    $appNode = $file->createElement('app');
    $name = $file->createElement('name');
    $name->nodeValue = $app->name;
    $icon = $file->createElement('icon');
    $icon->nodeValue = $app->icon;
    $type = $file->createElement('type');
    $type->nodeValue = $app->type;
    $packageName = $file->createElement('packageName');
    $packageName->nodeValue = $app->packageName;
    $description = $file->createElement('description');
    $description->nodeValue = $app->description;
    $latestVersion = $file->createElement('latestVersion');
    $latestVersion->nodeValue = $app->latestVersion;
    $latestUpdateLog = $file->createElement('latestUpdateLog');
    $latestUpdateLog->nodeValue = $app->latestUpdateLog;
    $downloadLink = $file->createElement('downloadLink');
    $coolapkQRCode = $file->createElement('coolapkQRCode');
    $coolapkQRCode->nodeValue = $app->coolapkQRCode;
    $coolapk = $file->createElement('coolapk');
    $coolapk->nodeValue = $app->coolapk;
    $googlePlay = $file->createElement('googlePlay');
    $googlePlay->nodeValue = $app->googlePlay;
    $source = $file->createElement('source');
    $source->nodeValue = $app->source;
    $history = $file->createElement('history');
    $apk = $file->createElement('apk');
    $apk->setAttribute('url', $app->apkURL);
    $apk->nodeValue = $app->latestVersion;

    $downloadLink->appendChild($coolapkQRCode);
    $downloadLink->appendChild($coolapk);
    $downloadLink->appendChild($googlePlay);
    $history->appendChild($apk);

    $appNode->appendChild($name);
    $appNode->appendChild($icon);
    $appNode->appendChild($type);
    $appNode->appendChild($packageName);
    $appNode->appendChild($description);
    $appNode->appendChild($latestVersion);
    $appNode->appendChild($latestUpdateLog);
    $appNode->appendChild($downloadLink);
    $appNode->appendChild($source);
    $appNode->appendChild($history);
    $targetNode->appendChild($appNode);
    $file->save($appFile);
}