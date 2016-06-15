<?php
/** 
*==============================================
* 素梅好翔博客  http://www.wanysys.cc
* ----------------------------------------------
* @date: 2016年6月15日 下午1:31:55
* @author: 张昊翔
* 项目
* ==============================================
**/
//项目处理类
class APP{
    static $module;//模块
    static $control;//控制器
    static $action;//动作方法
    static function run(){
        //echo 11;
        //配置自动加载类文件
        spl_autoload_register(array(__CLASS__,"autoload"));
        self::init();
    }
    //初始化配置
    static function init(){
        self::config();       
    }
    //初始化配置文件处理
    static function config(){
        
    }
    //自动加载类文件
    static function autoload($classname){
        $classfile = PHP_PATH.'/libs/bin/'.$classname.'.class.php';
        loadfile($classfile);
    }
}