<?php
/** 
*==============================================
* 素梅好翔博客  http://www.wanysys.cc
* ----------------------------------------------
* @date: 2016年7月8日 下午2:40:28
* @author: 张昊翔
* ==============================================
**/
final class url{
    //保存PATHINFO 信息
    static $pathinfo;
    //解析URL
    static function parseUrl(){
        if (self::Pathinfo()!=false){
           //echo self::$pathinfo;
           $info=explode(C("PATHINFO_DLI"), self::$pathinfo);
           //var_dump($info);
           if ($info[0]!=C("VAR_MODULE")){
               $get['m']=$info[0];
               array_shift($info);
               $get['c']=$info[0];
               array_shift($info);
               $get['a']=$info[0];
               array_shift($info);
           }
           $count=count($info);
           for ($i=0;$i<$count;$i+=2){
               $get[$info[$i]]=$info[$i+1];
           }
           $_GET=$get;
        }
        //echo "NO PATHINFO";
        //var_dump($_GET);
        define("MODULE", isset($_GET['m'])?$_GET['m']:C("DEFAULT_MODULE"));
        define("CONTROL", isset($_GET['c'])?$_GET['c']:C("DEFAULT_CONTROL"));
        define("ACTION", isset($_GET['a'])?$_GET['a']:C("DEFAULT_ACTION"));
    }
    //解析pathinfo
    static function Pathinfo(){
        //获得PATHINFO变量
        if (!empty($_GET[c("PATHINFO_VAR")])){
            $pathinfo=$_GET[C("PATH_INFO")];
        }elseif (!empty($_SERVER['PATH_INFO'])){
            $pathinfo=$_SERVER['PATH_INFO'];
        }else {
            return false;
        }
        $pathinfo_html=".".trim(C("PATHINFO_HTML"),".");
        $pathinfo=str_ireplace($pathinfo_html, "", $pathinfo);
        $pathinfo=trim($pathinfo,"/");
        if (stripos($pathinfo,C("PATHINFO_DLI"))==false){
            return false;
        }
        self::$pathinfo=$pathinfo;
        return true;
    }
}





