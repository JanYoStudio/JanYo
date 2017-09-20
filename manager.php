<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="//cdn.bootcss.com/mdui/0.3.0/css/mdui.min.css">
    <script src="//cdn.bootcss.com/mdui/0.3.0/js/mdui.min.js"></script>
    <title>Title</title>
</head>
<body>
<div>
    <!--表格-->
    <div class="mdui-container mdui-m-t-4">
        <div class="mdui-table-fluid">
            <table class="mdui-table mdui-table-hoverable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>APP</th>
                    <th>版本号</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $appFile = "data/app-list.xml";
                $appXML = simplexml_load_file($appFile);
                $index = 1;
                foreach ($appXML->children() as $app) {
                    $name = $app->name[0];
                    $latestVersion = $app->latestVersion[0];
                    ?>
                    <tr>
                        <td><?php echo $index ?></td>
                        <td><?php echo $name ?></td>
                        <td><?php echo $latestVersion ?></td>
                        <td><?php echo $index ?></td>
                    </tr>
                    <?php
                    $index++;
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--悬浮按钮-->
    <!--        <div class="mdui-fab-wrapper" mdui-fab="{trigger: 'hover'}">-->
    <button class="mdui-fab mdui-color-blue mdui-ripple mdui-fab-fixed"
            mdui-dialog="{target: '#uploadAPP'}">
        <i class="mdui-icon material-icons">add</i>
        <i class="mdui-icon mdui-fab-opened material-icons">add</i>
    </button>
    <!--悬浮菜单-->
    <!--        <div class="mdui-fab-dial">-->
    <!--            <button class="mdui-fab mdui-fab-mini mdui-ripple mdui-color-pink"><i-->
    <!--                        class="mdui-icon material-icons">backup</i></button>-->
    <!--            <button class="mdui-fab mdui-fab-mini mdui-ripple mdui-color-red"><i-->
    <!--                        class="mdui-icon material-icons">bookmark</i></button>-->
    <!--            <button class="mdui-fab mdui-fab-mini mdui-ripple mdui-color-orange"><i-->
    <!--                        class="mdui-icon material-icons">access_alarms</i></button>-->
    <!--            <button class="mdui-fab mdui-fab-mini mdui-ripple mdui-color-blue"><i-->
    <!--                        class="mdui-icon material-icons">touch_app</i></button>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--新增软件对话框-->
    <div class="mdui-dialog" id="uploadAPP">
        <div class="mdui-dialog-title">新建应用</div>
        <div class="mdui-dialog-content">
            <form action="functions/uploadAPP.php" enctype="multipart/form-data" id="newAPP"
                  method="post">
                <div class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">软件名称</label>
                    <input class="mdui-textfield-input" type="text" name="name"/>
                </div>
                <div class="mdui-textfield">
                    <label class="mdui-textfield-label">软件图标</label>
                    <input class="mdui-textfield-input" type="file" name="icon"/>
                </div>
                <div class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">软件类型</label>
                    <input class="mdui-textfield-input" type="text" name="type"/>
                </div>
                <div class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">软件包名</label>
                    <input class="mdui-textfield-input" type="text" name="packageName"/>
                </div>
                <div class="mdui-textfield">
                    <label class="mdui-textfield-label">软件描述</label>
                    <textarea class="mdui-textfield-input" name="description"></textarea>
                </div>
                <div class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">当前版本</label>
                    <input class="mdui-textfield-input" type="text" name="latestVersion"/>
                </div>
                <div class="mdui-textfield">
                    <label class="mdui-textfield-label">当前版本更新日志</label>
                    <textarea class="mdui-textfield-input" name="latestUpdateLog"></textarea>
                </div>
                <div class="mdui-textfield">
                    <label class="mdui-textfield-label">酷安二维码</label>
                    <input class="mdui-textfield-input" type="file" name="coolapkQRCode"/>
                </div>
                <div class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">酷安下载地址</label>
                    <input class="mdui-textfield-input" type="text" name="coolapk"/>
                </div>
                <div class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">Google Play下载地址</label>
                    <input class="mdui-textfield-input" type="text" name="googlePlay"/>
                </div>
                <div class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">源码地址</label>
                    <input class="mdui-textfield-input" type="text" name="source"/>
                </div>
                <div class="mdui-textfield">
                    <label class="mdui-textfield-label">正式版文件</label>
                    <input class="mdui-textfield-input" type="file" name="file"/>
                </div>
            </form>
        </div>
        <div class="mdui-dialog-actions">
            <button class="mdui-btn mdui-ripple"
                    onclick="document.getElementById('newAPP').submit();">保存
            </button>
        </div>
    </div>
</div>
</body>
</html>