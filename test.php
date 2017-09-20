<?php
/**
 * Created by PhpStorm.
 * User: myste
 */
require_once 'functions/functions.php';
require_once 'classes/APP.php';
$app=new APP();
$app->name='name1';
writeAPPintoXML($app);