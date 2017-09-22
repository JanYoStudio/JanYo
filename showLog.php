<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>查看日志</title>
    <link rel="stylesheet" href="//cdn.bootcss.com/mdui/0.3.0/css/mdui.min.css">
    <script src="//cdn.bootcss.com/mdui/0.3.0/js/mdui.min.js"></script>
    <script type="text/javascript">
        function showDialog(appName, logFile)
        {
            fetch("functions/getLogContent.php?appName=" + appName + "&file=" + logFile).then(function (response) {
                return response.text().then(function (text) {
                    mdui.alert(text, appName);
                })
            })
        }
    </script>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
    require_once WWW.'/functions/functions.php';
    ?>
</head>
<body>
<div>
    <!--表格-->
    <div class="mdui-container mdui-m-t-4">
        <div class="mdui-table-fluid">
            <table class="mdui-table mdui-table-hoverable">
                <thead>
                <tr>
                    <th class="mdui-table-col-numeric">#</th>
                    <th>软件名称</th>
                    <th>版本</th>
                    <th>厂商</th>
                    <th>型号</th>
                    <th>Android版本</th>
                    <th>上传时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $name = $_GET['appName'];
                $appFile = WWW."/data/log-list.xml";
                $appXML = simplexml_load_file($appFile);
                $targetNode = null;
                $index = 1;
                foreach ($appXML->children() as $app) {
                    if ($app->name[0] == $name) {
                        $targetNode = $app;
                        break;
                    }
                }
                if ($targetNode == null) {
                    alertMessage('未找到对应APP');
                    forwardTo('manager.php');
                    exit();
                }
                foreach ($targetNode->logs[0]->children() as $logNode) {
                    $version = $logNode->version[0];
                    $vendor = $logNode->vendor[0];
                    $model = $logNode->model[0];
                    $androidSDK = $logNode->androidSDK[0];
                    $date = $logNode->date[0];
                    $logFile = $logNode->logFile[0];
                    $packageName = getPackageName($name);
                    ?>
                    <tr>
                        <td><?php echo $index; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $version; ?></td>
                        <td><?php echo $vendor; ?></td>
                        <td><?php echo $model; ?></td>
                        <td><?php echo $androidSDK; ?></td>
                        <td><?php echo $date; ?></td>
                        <td>
                            <a href="res/log/<?php echo $packageName . '/' . $logFile ?>">
                                <button class="mdui-btn mdui-ripple mdui-color-blue-accent">查看源文件
                                </button>
                            </a>
                            <button class="mdui-btn mdui-ripple mdui-color-blue-accent"
                                    onclick="showDialog('<?php echo $name; ?>','<?php echo $logFile; ?>')">在线查看
                            </button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>