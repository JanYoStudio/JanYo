<?php
/**
 * Created by PhpStorm.
 * User: myste
 */
$file = "../data/app-list.xml";
$xml = simplexml_load_file($file);
foreach ($xml->children() as $app) {
    $name = $app->name[0];
    $icon = $app->icon[0];
    $type = $app->type[0];
    $packageName = $app->packageName[0];
    $description = $app->description[0];
    $latestVersion = $app->latestVersion[0];
    $latestUpdateLog = $app->latestUpdateLog[0];
    $downloadLink = $app->downloadLink[0];
    $coolapk = $downloadLink->children()->coolapk[0];
    $googlePlay = $downloadLink->children()->googlePlay[0];
    $source = $app->source[0];
    foreach ($app->history[0]->children() as $apk) {
        $url=$apk->attributes();
    }
}