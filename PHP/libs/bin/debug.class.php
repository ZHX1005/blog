<?php
/** 
*==============================================
* 素梅好翔博客  http://www.wanysys.cc
* ----------------------------------------------
* @date: 2016年6月15日 下午1:40:41
* @author: 张昊翔
* =============================================
**/
/* class debug{
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
} */
class debug{
    //运行时间
    static $runtime;
    //内存占用
    static $memory;
    //内存峰值
    static $memory_peak;
    //调试开始
    static function start($start){
        self::$runtime[$start]=microtime(true);
        self::$memory[$start]=memory_get_usage();
        self::$memory_peak[$start]=memory_get_peak_usage();
    }
    //项目运行时间
    static function runtime($start,$end='',$decimals=4){
        if(!isset(self::$runtime[$start])){
            error("必须设置项目起始点！");
        }
        if (empty(self::$runtime[$end])){
            self::$runtime[$end]=microtime(true);
            return number_format(self::$runtime[$end]-self::$runtime[$start],$decimals);
        }
    }
    //内存占用峰值
    static function memory_peak($start,$end=''){
       if(!isset(self::$memory_peak[$start])){
           return false;
       } 
       if (!empty($end)){
           self::$memory_peak[$end]=memory_get_usage();
       }
       return max(self::$memory_peak[$start],self::$memory_peak[$end]);
    }
    //显示运行结果
    static function show($start,$end){
        $message="项目运行时间".self::runtime($start,$end)."&nbsp;&nbsp;内存峰值".number_format(self::memory_peak($start,$end)/1024)."KB";
        $load_file_list=loadfile();
        //var_dump($load_file_list);
        $info='';
        $i=1;
        foreach ($load_file_list as $k=>$v){
            $info.="[".$i++."]".$k."<br/>";
        }
        $e['info']=$info."<p>$message</p>";
        include C("DEBUG_TPL");
    }
}








