<?php
/** 
*==============================================
* 素梅好翔博客  http://www.wanysys.cc
* ----------------------------------------------
* @date: 2016年6月14日 下午4:41:35
* @author: 张昊翔
* 编译文件
* ==============================================
**/
function runtime(){
    $files = require_once PHP_PATH.'/common/files.php';
    foreach ($files as $v){
        if (is_file($v)){
          require $v; 
          //ECHO $v."<br/>";
        }
    }
    mkdirs();
    //框架常规配置项
    C(require PHP_PATH.'/libs/etc/init.config.php');
    //echo C("SHOW_TIME");
    $data='';
    //格式化内容 去空白定义在function中
    foreach ($files as $V){
        $data.=del_space($v);
    }
    $data="<?php".$data."C(require PHP_PATH.'/libs/etc/init.config.php');"."?>";
    file_put_contents(TEMP_PATH.'/runtime.php', $data);
    index_control();
}
//创建友好测试页面
function index_control(){
   $index_dir=MODULE_PATH.'/index';
   $index_file=$index_dir.'/index'.C("CONTROL_FIX").C("CLASS_FIX").".php";
   //echo $index_dir;
   if (!is_dir($index_dir)){
       mkdir($index_dir,0777);
   }
   if (!is_file($index_file)){
       $data=<<<str
       <?php
           class indexControl extends Control{
                function index(){
                    echo"<div style='border:1px solid #dcdcdc;width:300px;height:40px;padding:30px 50px 10px;'>
                         <h1 style='font-size:12px;color:#F00;'>
                                                                        欢迎使用素梅好翔框架SMHXPHP
                         </h1>
                    </div>";
                }
           }     
str;
   file_put_contents($index_file, $data);
   }
}
//创建环境目录
function mkdirs(){
    //判断目录是否存在
    if (!is_dir(TEMP_PATH)){
        @mkdir(TEMP_PATH,0777);
    }
    //判断是否有写权限
    if (!is_writable(TEMP_PATH)){
        error("目录没有写权限，程序无法运行");
    }
    //如果不存在，则创建
    if (!is_dir(CACHE_PATH))mkdir(CACHE_PATH,0777);
    if (!is_dir(LOG_PATH))mkdir(LOG_PATH,0777);
    if (!is_dir(CONFIG_PATH))mkdir(CONFIG_PATH,0777);
    if (!is_dir(TEMPLETE_PATH))mkdir(TEMPLETE_PATH,0777);
    if (!is_dir(TPL_PATH))mkdir(TPL_PATH,0777);
    if (!is_dir(MODULE_PATH))mkdir(MODULE_PATH,0777);
    if (!is_dir(UPLOAD_PATH))mkdir(UPLOAD_PATH,0777);
    //echo CACHE_DIR;
}