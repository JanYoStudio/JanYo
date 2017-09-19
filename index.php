<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="//cdn.bootcss.com/mdui/0.3.0/css/mdui.min.css">
    <script src="//cdn.bootcss.com/mdui/0.3.0/js/mdui.min.js"></script>
    <title>JanYo Studio</title>
</head>
<body>
<div>
    <!--顶部工具栏-->
    <div class="mdui-toolbar mdui-color-blue">
        <a href="index.php" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">&#xe88a;</i></a>
        <span class="mdui-typo-title">JanYo Studio</span>
        <div class="mdui-toolbar-spacer"></div>
        <div class="mdui-textfield mdui-textfield-expandable mdui-float-right">
            <button class="mdui-textfield-icon mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">search</i>
            </button>
            <input class="mdui-textfield-input" type="text" placeholder="Search"/>
            <button class="mdui-textfield-close mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">close</i>
            </button>
        </div>
    </div>
    <!--Tab-->
    <div class="mdui-tab mdui-tab-centered mdui-tab-full-width mdui-color-blue" mdui-tab>
        <a href="#product" class="mdui-ripple">作品</a>
        <a href="#about" class="mdui-ripple">关于</a>
    </div>
    <!--作品页-->
    <div id="product" class="mdui-container">
        <div class="mdui-row">
            <?php
            $file = "data/app-list.xml";
            $xml = simplexml_load_file($file);
            foreach ($xml->children() as $app) {
                $name = $app->name[0];
                $icon = $app->icon[0];
                $type = $app->type[0];
                $packageName = $app->packageName[0];
                $description = $app->description[0];
                $latestVersion = $app->latestVersion[0];
                $latestUpdateLog = $app->latestUpdateLog[0];
                ?>
                <div class="mdui-card mdui-hoverable mdui-col-xs-12 mdui-m-t-4">
                    <!-- 卡片头部，包含头像、标题、副标题 -->
                    <div class="mdui-card-header">
                        <img class="mdui-card-header-avatar"
                             src="http://janyo.pw/WebSiteRes/image/app/jy_share/jy_share_icon.png"/>
                        <div class="mdui-card-header-title"><?php echo $name . '-' . $latestVersion ?></div>
                        <div class="mdui-card-header-subtitle"><?php echo $type ?></div>
                    </div>
                    <!-- 卡片的内容 -->
                    <div class="mdui-card-content">
                        <?php echo $description ?>
                        <div class="mdui-panel" mdui-panel>
                            <div class="mdui-panel-item">
                                <div class="mdui-panel-item-header">
                                    <div class="mdui-panel-item-title"><?php echo $latestUpdateLog ?></div>
                                    <div class="mdui-panel-item-summary">更新时间</div>
                                    <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                                </div>
                                <div class="mdui-panel-item-body">
                                    <?php echo $latestUpdateLog ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 卡片的按钮 -->
                    <div class="mdui-card-actions mdui-float-right">
                        <button class="mdui-btn mdui-ripple mdui-btn-raised mdui-color-blue">下载</button>
                        <button class="mdui-btn mdui-ripple mdui-btn-raised mdui-color-blue">源码</button>
                    </div>
                </div>
                <?php
                $downloadLink = $app->downloadLink[0];
                $coolapk = $downloadLink->children()->coolapk[0];
                $googlePlay = $downloadLink->children()->googlePlay[0];
                $source = $app->source[0];
                foreach ($app->history[0]->children() as $apk) {
                    $url = $apk->attributes();
                }
            }
            ?>
        </div>
    </div>
    <!--关于页-->
    <div id="about" class="mdui-container mdui-m-t-2">
        <div class="mdui-row">
            <div class="mdui-card mdui-hoverable mdui-col-xs-12">
                <!-- 卡片头部，包含头像、标题、副标题 -->
                <div class="mdui-card-header">
                    <img class="mdui-card-header-avatar"
                         src="http://janyo.pw/WebSiteRes/image/jy_studio_logo.jpg"/>
                    <div class="mdui-card-header-title">联系我们</div>
                </div>
                <!-- 卡片的内容 -->
                <div class="mdui-card-content">
                    简介
                    <div class="mdui-panel mdui-panel-gapless" mdui-panel>
                        <div class="mdui-panel-item">
                            <div class="mdui-panel-item-header">
                                <div class="mdui-panel-item-title">协议信息</div>
                                <div class="mdui-panel-item-summary">GPL 3</div>
                                <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                            </div>
                            <div class="mdui-panel-item-body">
                                详细信息
                            </div>
                        </div>
                        <div class="mdui-panel-item">
                            <div class="mdui-panel-item-header">
                                <div class="mdui-panel-item-title">关于本站</div>
                                <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                            </div>
                            <div class="mdui-panel-item-body">
                                详细信息
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>