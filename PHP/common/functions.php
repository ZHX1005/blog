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
header("Content-Type:text/html;Charset=utf-8");
//项目上线不开启debug模式，不上线开启
function error($error){
    //开启debug模式
    if (C("DEBUG")){
        if (!is_array($error)){
            //var_dump(debug_backtrace());
            $backtrace=debug_backtrace();
            $e['message']=$error;
            $info='';
            foreach ($backtrace as $v){
                $file=isset($v['file'])?$v['file']:'';
                $line=isset($v['line'])?"[".$v['line']."]":'';
                $class=isset($v['class'])?$v['class']:'';
                $type=isset($v['type'])?$v['type']:'';
                $function=isset($v['function'])?$v['function']."()":'';
                $info.=$file.$line.$class.$type.$function."<br/>";
            }
           //echo($info);
           $e['info']=$info;
           //var_dump($e);
        }else{
            $e=$error;
        }
    }else{   //不开启debug模式
        $e['message']=C("ERROR_MESSAGE");
    }
    include C("DEBUG_TPL");//调用init.config中
    exit();
}
//生成唯一序列号
function _md5($var){
    return md5(serialize($var));
}
//实例化控制器
function A($control){
    //有点就用点拆分控制器
    if (strstr($control, '.')){
        $arr=explode('.', $control);
        $module=$arr[0];
        $control=$arr[1];
    }else{
        $module=MODULE;
    }
}
//实例化对象或执行方法
function O($class,$method=null,$args=array()){
    static $result=array();
    $name=empty($args)?$class.$method:$class.$method._md5($args);
    if (!isset($result[$name])){
        $obj=new $class();
        if (!is_null($method)&&method_exists($obj, $method)){
            if (!empty($args)){
                $result[$name]=call_user_func_array(array(&$obj,$method), array($args));
            }else {
                $result[$name]=$obj->$method();
            }
        }else {
            $result[$name]=$obj;
        }
    }
    return $result[$name];
}

//载入文件
function loadfile($file){
    static $fileArr=array();
    if (empty($file)){
        return $fileArr;
    }
    $filePath=realpath($file);
    if (isset($fileArr[$filePath])){
        return $fileArr[$filePath];
    }
    if (!is_file($filePath)){
        error("文件".$file."不存在");
    }
    require $filePath;
    $fileArr[$filePath]=true;
    return $fileArr[$filePath];
    /* if (!isset($fileArr[$file])){
        if (!is_file($file)){
            $msg="<span style='color:#f00;'>文件{$file}不存在！</span>";
        }else{
            require $file;
            $fileArr[$file]=true;
            $msg="<span>文件{$file}载入成功！</span>";
        } 
        if(C("debug")){
             call_user_func_array(array("debug","msg"),array($msg));
        }
        return $fileArr[$file];
    } */
}
//配置文件处理
function C($name=null,$value=null){
    static $config = array();
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



