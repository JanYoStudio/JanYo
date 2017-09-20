<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="//cdn.bootcss.com/mdui/0.3.0/css/mdui.min.css">
    <script src="//cdn.bootcss.com/mdui/0.3.0/js/mdui.min.js"></script>
    <title>JanYo Studio</title>
</head>
<body class="mdui-appbar-with-toolbar mdui-appbar-with-tab">
<div>
    <!--顶部工具栏-->
    <div class="mdui-appbar mdui-appbar-fixed mdui-appbar-scroll-toolbar-hide">
        <div class="mdui-toolbar mdui-color-blue">
            <a href="index.php" class="mdui-btn mdui-btn-icon"><i
                        class="mdui-icon material-icons">&#xe88a;</i></a>
            <span class="mdui-typo-title">JanYo Studio</span>
            <div class="mdui-toolbar-spacer"></div>
            <div class="mdui-textfield mdui-textfield-expandable mdui-float-right">
                <button class="mdui-textfield-icon mdui-btn mdui-btn-icon"><i
                            class="mdui-icon material-icons">search</i>
                </button>
                <input class="mdui-textfield-input" type="text" placeholder="Search"/>
                <button class="mdui-textfield-close mdui-btn mdui-btn-icon"><i
                            class="mdui-icon material-icons">close</i>
                </button>
            </div>
        </div>
        <!--Tab-->
        <div class="mdui-tab mdui-tab-centered mdui-tab-full-width mdui-color-blue" mdui-tab>
            <a href="#product" class="mdui-ripple">作品</a>
            <a href="#about" class="mdui-ripple">关于</a>
        </div>
    </div>
    <!--作品页-->
    <div id="product" class="mdui-container">
        <div class="mdui-row">
            <?php
            $appFile = "data/app-list.xml";
            $appXML = simplexml_load_file($appFile);
            foreach ($appXML->children() as $app) {
                $name = $app->name[0];
                $icon = $app->icon[0];
                $type = $app->type[0];
                $packageName = $app->packageName[0];
                $description = $app->description[0];
                $latestVersion = $app->latestVersion[0];
                $latestUpdateLog = $app->latestUpdateLog[0];
                $source = $app->source[0];
                ?>
                <div class="mdui-card mdui-hoverable mdui-col-xs-12 mdui-m-t-4">
                    <!-- 卡片头部，包含头像、标题、副标题 -->
                    <div class="mdui-card-header">
                        <?php echo "<img class='mdui-card-header-avatar' src='$icon'>" ?>
                        <div class="mdui-card-header-title"><?php echo $name . '-' . $latestVersion ?></div>
                        <div class="mdui-card-header-subtitle"><?php echo $type ?></div>
                    </div>
                    <!-- 卡片的内容 -->
                    <div class="mdui-card-content">
                        <?php echo $description ?>
                        <div class="mdui-panel" mdui-panel>
                            <div class="mdui-panel-item">
                                <div class="mdui-panel-item-header">
                                    <div class="mdui-panel-item-title">更新日志</div>
                                    <div class="mdui-panel-item-summary">更新时间</div>
                                    <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                                </div>
                                <div class="mdui-panel-item-body">
                                    <p><?php echo $latestUpdateLog ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 卡片的按钮 -->
                    <div class="mdui-card-actions mdui-float-right">
                        <button class="mdui-btn mdui-ripple mdui-btn-raised mdui-color-blue"
                                mdui-dialog="{target: '#downloadDialog'}">下载
                        </button>
                        <?php echo "<a href='$source' >" ?>
                        <button class="mdui-btn mdui-ripple mdui-btn-raised mdui-color-blue">源码</button>
                        </a>
                    </div>
                </div>
                <?php
                $downloadLink = $app->downloadLink[0];
                $coolapkQRCode = $downloadLink->children()->coolapkQRCode[0];
                $coolapk = $downloadLink->children()->coolapk[0];
                $googlePlay = $downloadLink->children()->googlePlay[0];
            }
            ?>
        </div>
    </div>
    <?php
    $aboutFile = "data/about.xml";
    $aboutXML = simplexml_load_file($aboutFile);
    $emailLink = $aboutXML->emailLink[0];
    $qqGroup = $aboutXML->qqGroup[0];
    ?>
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
                    <p>Email:<?php echo "<a href='mailto:$emailLink'>$emailLink</a>" ?></p>
                    <p>QQ内测群链接：<?php echo "<a href='$qqGroup'>点击跳转</a>" ?></p>
                    <div class="mdui-panel mdui-panel-gapless" mdui-panel>
                        <div class="mdui-panel-item">
                            <div class="mdui-panel-item-header">
                                <div class="mdui-panel-item-title">授权相关</div>
                                <div class="mdui-panel-item-summary"></div>
                                <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                            </div>
                            <div class="mdui-panel-item-body">
                                <div>
                                    <h3 align="center">授权解决方案</h3>
                                    <p>为避免在其它非“JanYo Studio”通过书面授权认可的平台引发的授权 风险/争议，特拟此案。</p>
                                    <p>“JanYo Studio”(以下简称“工作室”)发布的产品缺省使用“GPL（GNU General Public
                                        License）”授权协议。工作室将在产品内部标识产品源程序及其附属品，使得任何人可以自由获取、阅读、传播，以及基于源代码重新构建它的二进制版本并发行该副本。</p>
                                    <p>工作室希望使用者在自由使用我们的产品时，尊重工作室的劳动成果，承认工作室的知识产权。</p>
                                    <p>工作室保证产品的自由使用、传播、阅读不受限，使用者应保障工作室的合法权益：</p>
                                    <strong>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(0)针对开源资料，禁止删改原作者注明的版权、授权方式 等信息。</p>
                                    </strong>
                                    <strong>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(1)源代码允许自由使用、添加至自己的项目，但必须注明来源，以及源的授权协议。</p>
                                    </strong>
                                    <strong>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(2)在从事盈利、商用活动中，针对产品的传播复制需注明来源，以及源的授权协议。</p>
                                    </strong>
                                    <p>针对产品授权、答疑可电邮至工作室官方电子邮箱 : mystery0dyl520@gmail.com</p>
                                </div>
                            </div>
                        </div>
                        <div class="mdui-panel-item">
                            <div class="mdui-panel-item-header">
                                <div class="mdui-panel-item-title">关于本站</div>
                                <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                            </div>
                            <div class="mdui-panel-item-body">
                                <p>"janyo.pw" 前端页面使用了开源UI库 MDUI</p>
                                <p>项目主页<a href="https://www.mdui.org">https://www.mdui.org</a>/</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--下载对话框-->
    <div class="mdui-dialog" id="downloadDialog">
        <div class="mdui-dialog-title">下载</div>
        <div class="mdui-dialog-content">
            <p>酷安下载二维码</p>
            <p><?php echo "<img src='$coolapkQRCode'/>" ?></p>
        </div>
        <div class="mdui-dialog-actions mdui-dialog-actions-stacked">
            <?php
            echo "<a href='$coolapk'>";
            ?>
            <button class="mdui-btn mdui-ripple">酷安下载</button>
            <?php
            echo "</a><a href='$googlePlay'>";
            ?>
            <button class="mdui-btn mdui-ripple">Google Play下载</button>
            <?php
            echo "</a>";
            ?>
            <button class="mdui-btn mdui-ripple" mdui-dialog-close
                    mdui-dialog="{target: '#history'}">历史下载
            </button>
        </div>
    </div>
    <!--历史下载对话框-->
    <div class="mdui-dialog" id="history">
        <div class="mdui-dialog-title">历史版本下载</div>
        <div class="mdui-dialog-content mdui-list">
            <?php
            foreach ($app->history[0]->children() as $apk) {
                $url = $apk->attributes();
                echo "<a href='$url' class='mdui-list-item mdui-ripple'>$apk</a>";
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>