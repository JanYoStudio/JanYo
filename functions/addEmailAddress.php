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
$targetNode = $file->getElementsByTagName('email-list')->item(0);
$emailNode = $file->createElement('email');
$emailNode->nodeValue = $email;
$targetNode->appendChild($emailNode);
$file->save($emailFile);
forwardTo('../manager.php');