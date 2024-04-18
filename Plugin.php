<?php
if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

/**
 * 试试神奇的Konami密码: ↑ ↑ ↓ ↓ ← → ← → B A
 *
 * @package Konami
 * @author 小A
 * @version 1.0.1
 * @link http://xiaoa.me
 */
class Konami_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     */
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Archive')->header = array(__CLASS__, 'header');
        Typecho_Plugin::factory('Widget_Archive')->footer = array(__CLASS__, 'footer');
    }

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     */
    public static function deactivate()
    {
    }

    /**
     * 获取插件配置面板
     *
     * @param Form $form 配置面板
     */
    public static function config(Typecho_Widget_Helper_Form $form){}

    /**
     * 个人用户的配置面板
     *
     * @param Form $form
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form)
    {
    }

    /**
     *为header添加js文件
     *@return void
     */
    public static function header() {
        $jqueryUrl = Helper::options()->pluginUrl . '/Konami/jquery.min.js';
        //写入JS
        echo <<<CODE
<script type="text/javascript" src="{$jqueryUrl}"></script>
CODE;
    }

    /**
     *为footer添加js文件
     *@return void
     */
    public static function footer() {
        echo <<<CODE
<script type="text/javascript">
   $(document).ready(function() {
	//Konami Code
    var k = [];
    var html = '<div id="konami" style="display:none;position:fixed;height:100%;width:100%;z-index:9999;top:0;left:0;background:rgba(00, 00, 00, 0.8);">';
    html += '<span style="position: absolute;left: 50%;transform: translate(-50%,-50%);top: 50%; color: #FFFFFF;font-size: 18em;">KONAMI</span>';
    html +=  '</div>';
    $("body").append(html);
    $(document).keydown(function(e) {
        e = e || window.event;
        k.push(e.keyCode);
        if (k.toString().indexOf("38,38,40,40,37,39,37,39,66,65") >= 0) {
            $("#konami").fadeIn(1500).fadeOut(1500);
            k = [];
        }
        else if (k.length == 10) {
            k.shift();
        }
    });
});
</script>
CODE;
    }
}
