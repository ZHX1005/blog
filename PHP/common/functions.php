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
            //echo 222;
            $e=$error;
           // var_dump($e);
        }
    }else{   //不开启debug模式
        $e['message']=C("ERROR_MESSAGE");
    }
    include C("DEBUG_TPL");//调用init.config中
    exit();
}
//提示性错误
function notice($e){
    if (C("DEBUG")&&C("NOTICE_SHOW")){
        $time=number_format((microtime(TRUE)-debug::$runtime['app_start']),4);
    
    $memory=memory_get_usage();
    //var_dump($e);
    $message=$e[1];
    $file=$e[2];
    $line=$e[3];
    $msg="
    <h1 style='font-size:13px;background-color:#333;height:20px;line-height:1.8em;padding:5px;margin-top:20px;color:#fff;width:895px;'>NOTICE:$message</h1>
    <div>
        <table style='border:solid 1px #dcdcdc;width:900px;'>
            <tr><td>time</td><td>memory</td><td>file</td><td>line</td></tr>
            <tr><td>$time</td><td>$memory</td><td>$file</td><td>$line</td></tr>
        </table>
    </div>";
    echo $msg;
    }
}
//生成唯一序列号
function _md5($var){
    return md5(serialize($var));
}
//实例化控制器
function A($control){
    //有点表示传递的是模块加控制器的形式，就用点拆分控制器，
    if (strstr($control, '.')){
        $arr=explode('.', $control);
        $module=$arr[0];
        $control=$arr[1];
    }else{
        $module=MODULE;//APP.class初始化配置中
    }
    //echo $module."::".$control;
    static $_control=array();
    $control=$control.C("CONTROL_FIX");
    if (isset($_control[$control])){
        return $_control[$control];
    }
    $control_path=MODULE_PATH."/".$module."/".$control.C("CLASS_FIX").'.PHP';
    //echo $control_path;
    loadfile($control_path);
    if (class_exists($control)){
        $_control[$control]=new $control();
        return $_control[$control];
    }else {
        return false;
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
function loadfile($file=''){
    static $fileArr=array();
    if (empty($file)){
        return $fileArr;
    }
    $filePath=realpath($file);
    if (isset($fileArr[$filePath])){
        return $fileArr[$filePath];
    }
    if (!is_file($filePath)){
        error("文件".$file."不存在！");
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
//格式化内容 去空白
function del_space($file_name){
    //载入核心文件
    $data=file_get_contents($file_name);
    //截取起始标记：<?php和结束标记:？>
    $data=substr($data, 0,5)=="<?php"?substr($data, 5):$data;
    $data=substr($data, -2)=="?>"?substr($data, 0,-2):$data;
    //删除多行注释和空格
    //多行注释$preg_arr=array('/\/\*.*?\*\/\s*/is');
    //$preg_arr=array('/\/\*.*?\*\/\s*/is','/\/\/.*?[\r\n]/is');//多行注释加单行注释
    $preg_arr=array('/\/\*.*?\*\/\s*/is','/\/\/.*?[\r\n]/is','/(?!\w)\s*?(?!\w)/is');//多行注释加单行注释加空格
    return preg_replace($preg_arr, '', $data);
    
}




