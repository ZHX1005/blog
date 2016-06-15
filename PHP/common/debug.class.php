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
    function msg($msg){
        //显示信息
        self::$debug[]=$msg;
    }
    function show(){
        self:$debug[]=runtime("run_time","end");
        echo "<div style='boder:solid 2px #dcdcdc;'>";
        foreach (self::$debug as $v){
            echo $v;
        }
        echo"</div>";
    }
}