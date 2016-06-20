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
        //注册错误处理函数
        set_error_handler(array(__CLASS__,"error"));
        //
        self::init();
        if(C("DEBUG")){
            debug::show();
        }
    }
    //初始化配置
    static function init(){
        self::config(); 
        //echo C("dbhost");
        /* self::$module=self::module();
        self::$control=self::control();
        self::$action=self::action(); */
        define("MODULE", isset($_GET[C("VAR_MODULE")])?$_GET[C("VAR_MODULE")]:C("DEFAULT_MODULE"));
        $control_file=MODULE_PATH.'/'.self::$module.'/'.self::$control.C("CONTROL_FIX").C("CLASS_FIX").'.php';
        //echo $control_file;
        if (loadfile($control_file)){
            //echo 123;
            $control =O(self::$control.C("CONTROL_FIX"));//定义在functions,,实例化对象
            $action=self::$action;
            $control->$action();
        }
    }
    //获得模块
    private static function module(){
        if (isset($_GET['m'])&&!empty($_GET['m'])){
            return $_GET['m'];    
        }return C("DEFAULT_MODULE");
    }
    //获得控制器
    private static function control(){
        if (isset($_GET['c'])&&!empty($_GET['c'])){
            return $_GET['c'];
        }return C("DEFAULT_CONTROL");//定义在init.config中
    }
    //获得动作
    private static function action(){
        if (isset($_GET['a'])&&!empty($_GET['a'])){
            return $_GET['a'];
        }return C("DEFAULT_ACTION");
    }
    //初始化配置文件处理
    static function config(){
        $config_file = CONFIG_PATH.'/config.php';
        //echo $config_file;
        if (is_file($config_file)){
            C(require $config_file);
        }
    }
    //自动加载类文件
    static function autoload($classname){
        $classfile = PHP_PATH.'/libs/bin/'.$classname.'.class.php';
        //echo $classfile;
        loadfile($classfile);
    }
    //错误处理
    static function error($errno,$errstr,$errfile,$errline){//错误处理的类型，错误处理的字符串，错误处理的文件，错误处理的函数
        /* echo"<div style='border:solid 1px #f00'>.$errstr.$errfile</div>";   
        exit(); */
        switch ($errno){
            case E_ERROR;
            case E_USER_ERROR;
                $errmsg="ERROR:[$errno]<strong>$errstr</strong>File:$errfile"."[$errline]";
                error($errmsg);
                break;
            case E_NOTICE;
            case E_USER_NOTICE;
            case E_USER_WARNING;
            default:
                $errmsg="NOTICE:[$errno]<strong>$errstr</strong>File:$errfile"."[$errline]";
                break;
                //notice($errmsg);
        }
              
    }
 }