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
        alertMessage('文件已存在！');
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

function writeAPPintoXML()
{
    $appFile = "data/app-list.xml";
    $file = new DOMDocument();
    $file->load($appFile);
    $targetNode=$file->getElementsByTagName('app-list')->item(0);
    $app = $file->createElement('app');
    $name = $file->createElement('name');
    $name->nodeValue = 'name1';
    $app->appendChild($name);
    $targetNode->appendChild($app);
    $file->save($appFile);
}