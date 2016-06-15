<?php
/** 
*==============================================
* 素梅好翔博客  http://www.wanysys.cc
* ----------------------------------------------
* @date: 2016年6月14日 下午4:45:43
* @author: 张昊翔
* 公共函数文件
* ==============================================
**/
function error($msg){
    echo "<div style='border:solid 2px #333;
        width:500px;height:100px'>$msg</div>";
    exit();
}
//载入文件
function loadfile($file){
    static $fileArr=array();
    if (!isset($fileArr[$filename])){
        if (is_file($file)){
            $msg="<span style='color:#f00;'>{$file}文件不存在！</span>";
        }else{
            require $file;
            $fileArr[$file]=ture;
            $msg="<span>文件{$file}载入成功！</span>";
        } 
        call_user_func_array(array("debug","msg"),array($msg));
    }
}
//配置文件处理
function C($name=null,$value=null){
    static $confug = array();
    if (is_null($name)){
        return $config;     
    }
    if(is_string($name)){
        $name=strtolower($name);
        //字符串有点
        if(!strstr($name,".")){
            if(is_null($value)){
                return isset($config[$name])?$config[$name]:null;
            }else{
                $config[$name]=$value;
                return;
            }
        }
        //字符串没点
        $name=explode(".",$name);
        if (is_null($value)){
            return isset($config[$name[0][1]])?$config[$name[0][1]]:null;
        }else {
            $config[$name[0][1]]=$value;
            return;
        }
    }
    //合并数组
    if(is_array($name)){  
        $config=array_merge($config,array_change_key_case($name));
        return true;
    }
}



