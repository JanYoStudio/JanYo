<?php
/**
 * Created by PhpStorm.
 * User: myste
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once WWW.'/functions/functions.php';
$email = $_POST['email'];

$emailFile = WWW . "/data/email-list.xml";
$file = new DOMDocument();
$file->load($emailFile);
$emailNode = $file->getElementsByTagName('email-list')->item(0)->getElementsByTagName('email');
for ($i = 0; $i < $emailNode->length; $i++) {
    $item = $emailNode->item($i);
    if ($item->nodeValue == $email)
        $file->documentElement->removeChild($item);
}
$file->save($emailFile);
forwardTo('../manager.php');