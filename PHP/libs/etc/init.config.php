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
    "SHOW_TIME"=>1,//显示运行时间
    "DEBUG"=>1,//开启调试模式
    "DEBUG_TPL"=>PHP_PATH.'/tpl/debug.tpl.php',//错误异常模板
    "ERROR_MESSAGE"=>"页面出错",//关闭调试模式后显示内容
    //项目配置项
    "DEFAULT_MODULE"=>"index",
    "DEFAULT_CONTROL"=>"index",
    "DEFAULT_ACTION"=>"index",
    "CONTROL_FIX"=>"control",//控制器后缀
    "CLASS_FIX"=>".class",//类后缀
    //全局变量
    "VAR_MODULE"=>'m',//模块变量
    "VAR_CONTROL"=>'c',//控制器
    "VAR_ACTION"=>'a',//动作
);