<?php
/** 
*==============================================
* 素梅好翔博客  http://www.wanysys.cc
* ----------------------------------------------
* @date: 2016年6月15日 下午2:30:57
* @author: 张昊翔
* ==============================================
**/
return array(
    //系统配置
    "SHOW_TIME"=>1,//显示运行时间
    "FONT"=>PHP_PATH.'/data/font/heiti.ttf',//字体
    "DEBUG"=>1,//开启调试模式
    "NOTECE_SHOW"=>1,//是否开启提示性错误
    "DEBUG_TPL"=>PHP_PATH.'/tpl/debug.tpl.php',//错误异常模板
    "ERROR_MESSAGE"=>"页面出错",//关闭调试模式后显示内容
    "DATE_TIMEZONE_SET"=>"PRC",//默认时区
    //图像水印处理
    "WATER_ON"=>1,//水印是否开启
    "WATER_TYPE"=>1,//1为图片水印，0为文字水印
    "WATER_IMG"=>PHP_PATH.'/data/water/water.png',//水印图片
    "WATER_POS"=>9,//水印位置
    "WATER_PCT"=>60,//水印透明度
    "WATER_QUALITY"=>80,//水印压缩比
    "WATER_TEXT"=>"水印文字",//水印文字
    "WATER_TEXT_COLOR"=>"#000000",//水印文字颜色
    "WATER_TEXT_SIZE"=>"13",//水印文字大小
    "WATER_TEXT_FONT"=>PHP_PATH.'/data/font/heiti.ttf',//水印字体
    //缩略图处理
    "THUMB_ON"=>1,//是否开启缩略图
    "THUMB_PREFIX"=>"thumb_",//缩略图前缀
    "THUMB_ENDFIX"=>"_thumb",//缩略图后缀
    "THUMB_TYPE"=>"1",//生成缩略图的方式
    //1 ：固定宽度，高度自增 2：固定高度，宽度自增 3：固定宽度，高度自增4：固定高度，宽度裁剪5：缩放最大边
    "THUMB_WIDTH"=>250,//缩略图宽度
    "THUMB_HEIGHT"=>250,//缩略图高度
    "THUMB_PATH"=>UPLOAD_PATH.'/img/'.date("ymd"),//缩略图保存目录
    //验证码
    "CODE_STR"=>"1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM",//验证码字符串
    "CODE_WIDTH"=>80,//验证码宽度
    "CODE_HEIGHT"=>25,//验证码高度
    "CODE_BG_COLOR"=>"#DCDCDC",//验证码背景颜色
    "CODE_LEN"=>4,//验证码长度
    "CODE_FONT_SIZE"=>18,//字体大小
    "CODE_FONT_COLOR"=>"",//文字颜色
    //session
    "CODE"=>"code",//session变量
    //PATHINFO
    "PATHINFO_DLI"=>"/",//PATHINFO分隔符
    "PATHINFO_VAR"=>"q",//兼容模式get变量
    "PATHINFO_HTML"=>".html",//伪静态
    //日志处理
    "LOG_START"=>1,//日志是否开启
    "LOG_TYPE"=>array("SQL","NOTICE","ERROR"),//日志处理类型
    "LOG_SIZE"=>2000000,//日志文件大小
    //项目配置项
    "DEFAULT_MODULE"=>"index",
    "DEFAULT_CONTROL"=>"index",
    "DEFAULT_ACTION"=>"index",
    "CONTROL_FIX"=>"Control",//控制器后缀
    "CLASS_FIX"=>".class",//类后缀
    //全局变量
    "VAR_MODULE"=>'m',//模块变量
    "VAR_CONTROL"=>'c',//控制器
    "VAR_ACTION"=>'a',//动作
);