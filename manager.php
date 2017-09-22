<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="//cdn.bootcss.com/mdui/0.3.0/css/mdui.min.css">
    <script src="//cdn.bootcss.com/mdui/0.3.0/js/mdui.min.js"></script>
    <link rel="shortcut icon" href="res/jy_studio_logo.jpg" />
    <link rel="bookmark" href="res/jy_studio_logo.jpg" type="image/x-icon"/>
    <title>管理员操作</title>
</head>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once WWW . '/functions/functions.php';

if (!isset($_COOKIE['secret_key'])) {
    jumpToSignIn();
} else {
    $key = $_COOKIE['secret_key'];
    if (!validateSecretKey($key)) {
        jumpToSignIn();
    }
}
?>
<body>
<div>
    <!--表格-->
    <div class="mdui-container mdui-m-t-4">
        <div class="mdui-table-fluid">
            <table class="mdui-table mdui-table-hoverable">
                <thead>
                <tr>
                    <th class="mdui-table-col-numeric">#</th>
                    <th>APP</th>
                    <th>版本号</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $appFile = WWW . "/data/app-list.xml";
                $appXML = simplexml_load_file($appFile);
                $index = 1;
                foreach ($appXML->children() as $app) {
                    $name = $app->name[0];
                    $packageName = $app->packageName[0];
                    $latestVersion = $app->latestVersion[0];
                    ?>
                    <tr>
                        <td><?php echo $index ?></td>
                        <td><?php echo $name ?></td>
                        <td><?php echo $latestVersion ?></td>
                        <td>
                            <button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-blue"
                                    mdui-dialog="{target: '#updateAPK<?php echo $index ?>'}">更新应用
                            </button>
                            <a href="showLog.php?appName=<?php echo $name ?>">
                                <button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-blue">查看日志</button>
                            </a>
                        </td>
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
    <div class="mdui-fab-wrapper" mdui-fab="{trigger: 'hover'}">
        <button class="mdui-fab mdui-color-blue mdui-ripple">
            <i class="mdui-icon material-icons">add</i>
            <i class="mdui-icon mdui-fab-opened material-icons">add</i>
        </button>
        <!--悬浮菜单-->
        <div class="mdui-fab-dial">
            <button class="mdui-fab mdui-fab-mini mdui-ripple mdui-color-pink"
                    mdui-tooltip="{content: '新增APP'}" mdui-dialog="{target: '#uploadAPP'}">
                <i class="mdui-icon material-icons">add</i>
            </button>
            <button class="mdui-fab mdui-fab-mini mdui-ripple mdui-color-red"
                    mdui-tooltip="{content: '设置'}" mdui-dialog="{target: '#settings'}">
                <i class="mdui-icon material-icons">settings</i>
            </button>
        </div>
    </div>
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
    <?php
    $index = 1;
    foreach ($appXML->children() as $app) {
        $name = $app->name[0];
        $packageName = $app->packageName[0];
        $latestVersion = $app->latestVersion[0];
        ?>
        <!--更新软件对话框-->
        <div class="mdui-dialog" id="updateAPK<?php echo $index ?>">
            <div class="mdui-dialog-title">应用名称：<?php echo $name ?></div>
            <div class="mdui-dialog-content">
                <form action="functions/updateAPK.php" enctype="multipart/form-data"
                      id="newAPK-<?php echo $packageName ?>"
                      method="post">
                    <?php echo "<input name='name' type='text' value='$name' hidden/>" ?>
                    <?php echo "<input name='packageName' type='text' value='$packageName' hidden/>" ?>
                    <div class="mdui-textfield mdui-textfield-floating-label">
                        <label class="mdui-textfield-label">本次版本</label>
                        <input class="mdui-textfield-input" type="text" name="apkVersion"/>
                    </div>
                    <div class="mdui-textfield">
                        <label class="mdui-textfield-label">更新日志(将被追加)</label>
                        <textarea class="mdui-textfield-input" name="updateLog"></textarea>
                    </div>
                    <div class="mdui-textfield">
                        <label class="mdui-textfield-label">apk文件</label>
                        <input class="mdui-textfield-input" type="file" name="apkFile"/>
                    </div>
                </form>
            </div>
            <div class="mdui-dialog-actions">
                <button class="mdui-btn mdui-ripple">取消</button>
                <button class="mdui-btn mdui-ripple"
                        onclick="document.getElementById('newAPK-<?php echo $packageName ?>').submit();">完成
                </button>
            </div>
        </div>
        <?php
        $index++;
    }
    ?>
    <!--设置对话框-->
    <div class="mdui-dialog" id="settings">
        <div class="mdui-tab mdui-tab-full-width" id="settings-tab">
            <a href="#settings-info" class="mdui-ripple">信息设置</a>
            <a href="#settings-mail" class="mdui-ripple">邮件设置</a>
        </div>
        <div id="settings-info" class="mdui-p-a-2">
            <?php
            $aboutFile = WWW . "/data/about.xml";
            $about = simplexml_load_file($aboutFile);
            foreach ($about->children() as $child) {
                ?>
                <div class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label"><?php echo $child->getName() ?></label>
                    <textarea class="mdui-textfield-input"><?php echo $child ?></textarea>
                </div>
                <?php
            }
            ?>
        </div>
        <div id="settings-mail" class="mdui-p-a-2">
            <?php
            $email_list_xml_file = WWW . "/data/email-list.xml";
            $email_list = new DOMDocument();
            $email_list->load($email_list_xml_file);
            $emailNode = $email_list->getElementsByTagName("email");
            for ($i = 0; $i < $emailNode->length; $i++) {
                $address = $emailNode->item($i)->nodeValue;
                ?>
                <div class="mdui-chip">
                    <form action="functions/deleteEmailAddress.php" method="post"
                          name="deleteAddress">
                        <input type="email" name="email" value="<?php echo $address ?>" hidden>
                        <span class="mdui-chip-title"><?php echo $address ?></span>
                        <span class="mdui-chip-delete">
                        <a href="javascript:void(document.deleteAddress.submit())">
                        <i class="mdui-icon material-icons">cancel</i>
                        </a>
                    </span>
                    </form>
                </div>
                <?php
            }
            ?>
            <div class="mdui-chip">
                <form action="functions/addEmailAddress.php" method="post" name="addAddress">
                <span class="mdui-chip-title">
                        <input type="email" name="email">
                </span>
                    <span class="mdui-chip-delete">
                        <a href="javascript:void(document.addAddress.submit())">
                        <i class="mdui-icon material-icons">add</i>
                        </a>
                </span>
                </form>
            </div>
        </div>
    </div>
    <script>
        var tab = new mdui.Tab('#settings-tab');
        document.getElementById('settings').addEventListener('open.mdui.dialog', function () {
            tab.handleUpdate();
        });
    </script>
</div>
</body>
</html>