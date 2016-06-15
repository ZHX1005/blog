<?php
/** 
*==============================================
* 素梅好翔博客  http://www.wanysys.cc
* ----------------------------------------------
* @date: 2016年6月14日 下午4:23:00
* @author: 张昊翔
* ==============================================
**/
//配置框架的目录结构
define("CACHE_DIR","cache");//缓存目录
define("LOG_DIR","log");//日志目录
define("CONFIG_DOR","config");//配置文件
define("TEMPLETE_DIR","templete");//模板视图目录
define("TPL_DIR","tpl");//模板编译目录
define("MODULE_DIR",",module");//模块目录

define("CACHE_PATH",TEMP_PATH.'/'.CACHE_DIR);
define("LOG_PATH",TEMP_PATH.'/'.LOG_DIR);
define("CONFIG_PATH",APP_PATH.'/'.CONFIG_DOR);
define("TEMPLETE_PATH",APP_PATH.'/'.TEMPLETE_DIR);
define("TPL_PATH",TEMP_PATH.'/'.TPL_DIR);
if(!defined("MODULE_PATH"))define("MODULE_PATH",APP_PATH.'/'.MODULE_DIR);
