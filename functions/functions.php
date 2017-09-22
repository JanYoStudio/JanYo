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

function logMessage($message)
{
    echo "<script language='javascript'>console.log('$message');</script>";
}

function forwardTo($url)
{
    echo "<script language=JavaScript> location.replace('$url');</script>";
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
 * @param APP $app : 要保存到xml中的app对象
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

/**
 * Created by PhpStorm.
 * User: myste
 * @param $name : APP名称
 * @param APK $apk : 写入的APK对象
 */
function writeAPKtoXML($name, APK $apk)
{
    $appFile = "../data/app-list.xml";
    $file = new DOMDocument();
    $file->load($appFile);
    $item = null;
    foreach ($file->documentElement->getElementsByTagName('app') as $app) {
        if ($app->getElementsByTagName('name')->item(0)->nodeValue == $name) {
            $item = $app;
            break;
        }
    }
    if ($item == null) {
        alertMessage('未找到对应APP');
        forwardTo('../manager.php');
        exit();
    }
    $item->getElementsByTagName('latestVersion')->item(0)->nodeValue = $apk->version;
    $item->getElementsByTagName('latestUpdateLog')->item(0)->nodeValue = $apk->updateLog;
    $targetNode = $item->getElementsByTagName('history')->item(0);
    $newAPK = $file->createElement('apk');
    $newAPK->setAttribute('url', $apk->url);
    $newAPK->nodeValue = $apk->version;
    $targetNode->appendChild($newAPK);
    $file->save($appFile);
}

/**
 * Created by PhpStorm.
 * User: myste
 * @param Log $log : 要存储的log信息
 * @return bool: 返回存储结果
 */
function writeLogToXML(Log $log)
{
    $logFile = '../data/log-list.xml';
    $file = new DOMDocument();
    $file->load($logFile);
    $targetNode = null;
    foreach ($file->documentElement->getElementsByTagName('app') as $app) {
        if ($app->getElementsByTagName('name')->item(0)->nodeValue == $log->appName) {
            $targetNode = $app;
            break;
        }
    }
    if ($targetNode == null) {
        return false;
    }
    $logsNode = $targetNode->getElementsByTagName("logs")->item(0);
    $logNode = $file->createElement('log');
    $versionNode = $file->createElement('version');
    $versionNode->nodeValue = $log->version;
    $vendorNode = $file->createElement('vendor');
    $vendorNode->nodeValue = $log->vendor;
    $modelNode = $file->createElement('model');
    $modelNode->nodeValue = $log->model;
    $sdkNode = $file->createElement('androidSDK');
    $sdkNode->nodeValue = $log->androidSDK;
    $dateNode = $file->createElement('date');
    $dateNode->nodeValue = $log->date;
    $logFileNode = $file->createElement('logFile');
    $logFileNode->nodeValue = $log->logFile;
    $logNode->appendChild($versionNode);
    $logNode->appendChild($vendorNode);
    $logNode->appendChild($modelNode);
    $logNode->appendChild($sdkNode);
    $logNode->appendChild($dateNode);
    $logNode->appendChild($logFileNode);
    $logsNode->appendChild($logNode);
    $file->save($logFile);
    return true;
}

/**
 * Created by PhpStorm.
 * User: myste
 * @param $appName : 要查询的APP名称
 * @return string: 返回查询到的包名
 */
function getPackageName($appName)
{
    $appFile = "../data/app-list.xml";
    $file = new DOMDocument();
    $file->load($appFile);
    $item = null;
    foreach ($file->documentElement->getElementsByTagName('app') as $app) {
        if ($app->getElementsByTagName('name')->item(0)->nodeValue == $appName) {
            $item = $app;
            break;
        }
    }
    if ($item == null) {
        return 'null';
    } else {
        return $item->getElementsByTagName('packageName')->item(0)->nodeValue;
    }
}

/**
 * Created by PhpStorm.
 * User: myste
 * @param $fileName : 作为附件发送的日志文件名
 */
function sendEmail($fileName)
{
    $email_list_xml_file = "../data/email-list.xml";
    $email_list = new DOMDocument();
    $email_list->load($email_list_xml_file);
    $emailNode = $email_list->getElementsByTagName("email");
    for ($i = 0; $i < $emailNode->length; $i++) {
        $address = $emailNode->item($i)->nodeValue;
        //发送邮件
        send($address, $fileName);
    }
}

/**
 * Created by PhpStorm.
 * User: myste
 * @param $address : 收件人地址
 * @param $fileName : 文件名
 * @return bool: 发送成功与否
 */
//发送邮件
function send($address, $fileName)
{
    require '../lib/mail/PHPMailerAutoload.php';
    $date = $_POST['date'];
    $appName = $_POST['appName'];
    $appVersion = $_POST['appVersionName'] . "_" . $_POST['appVersionCode'];
    $androidVersion = $_POST['androidVersion'] . "_" . $_POST['sdk'];
    $vendor = $_POST['vendor'];
    $model = $_POST['model'];

    $mail = new PHPMailer;
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'smtp.aliyun.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->CharSet = 'UTF-8'; //设置邮件内容编码
    $mail->Username = 'janyo.studio@aliyun.com'; // SMTP username
    $mail->Password = 'JanYoStudio666'; // SMTP password
    $mail->Port = 25; // TCP port to connect to
    // $mail->SMTPSecure = "ssl";

    $mail->setFrom('janyo.studio@aliyun.com', $appName);
    $mail->addAddress($address, 'JanYo Studio'); // Add a recipient
    $fileAddress = "uploadfile/" . $fileName;
    $mail->addAttachment("$fileAddress"); // Add attachments（附件）
    $mail->isHTML(true); // Set email format to HTML

    $mail->Subject = $appName . "_" . $appVersion . "在" . $date . "日志";
    $mail->Body = "<p>OS Version: " . $androidVersion . "</p><p>Vendor: " . $vendor . "</p><p>Model: " . $model . "</p>";

    if (!$mail->send()) {
        return false;
    } else {
        return true;
    }
}