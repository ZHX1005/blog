<?php
/** 
*==============================================
* 素梅好翔博客  http://www.wanysys.cc
* ----------------------------------------------
* @date: 2016年6月15日 下午1:40:41
* @author: 张昊翔
* =============================================
**/
class debug{
    static $debug=array();//保存错误信息
    static  function msg($msg){
        //显示信息
        self::$debug[]=$msg;
    }
    static function show(){
        self::$debug[]="运行时间：".run_time("start","end")."秒";
        echo "<div style='border:solid 2px #dcdcdc;width:500px;margin:20px;padding:10px;font-size:12px;'><ul style='list-style:none;padding:0px;margin:0px;'>";
        foreach (self::$debug as $v){
            echo "<li>".$v."</li>";
        }
        echo"</ul></div>";
    }
}