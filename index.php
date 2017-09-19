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
        <!--<a href="javascript:;" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">menu</i></a>-->
        <span class="mdui-typo-title">JanYo Studio</span>
        <div class="mdui-toolbar-spacer"></div>
        <a href="javascript:;" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">search</i></a>
    </div>
    <!--Tab-->
    <div class="mdui-tab mdui-tab-centered mdui-tab-full-width mdui-color-blue" mdui-tab>
        <a href="#product" class="mdui-ripple">作品</a>
        <a href="#about" class="mdui-ripple">关于</a>
    </div>
    <!--作品页-->
    <div id="product" class="mdui-container mdui-m-t-2">
        <div class="mdui-row">
            <div class="mdui-card mdui-hoverable mdui-col-xs-12">
                <!-- 卡片头部，包含头像、标题、副标题 -->
                <div class="mdui-card-header">
                    <img class="mdui-card-header-avatar"
                         src="http://janyo.pw/WebSiteRes/image/app/jy_share/jy_share_icon.png"/>
                    <div class="mdui-card-header-title">APP名称-版本号</div>
                    <div class="mdui-card-header-subtitle">类型</div>
                </div>
                <!-- 卡片的内容 -->
                <div class="mdui-card-content">
                    简介
                    <div class="mdui-panel" mdui-panel>
                        <div class="mdui-panel-item">
                            <div class="mdui-panel-item-header">
                                <div class="mdui-panel-item-title">更新日志</div>
                                <div class="mdui-panel-item-summary">更新时间</div>
                                <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                            </div>
                            <div class="mdui-panel-item-body">
                                详细日志
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
        </div>
    </div>
</div>
</body>
</html>