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
        }
        //echo "NO PATHINFO";
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





