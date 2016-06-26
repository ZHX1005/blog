<?php
/** 
*==============================================
* 素梅好翔博客  http://www.wanysys.cc
* ----------------------------------------------
* @date: 2016年6月26日 上午10:00:22
* @author: 张昊翔
* 错误日志
* ==============================================
**/
class log{
    static $log=array();
    //记录日志内容
    static function set($message,$type="NOTICE"){
        if (in_array($type, C("LOG_TYPE"))){
            $date = date("y-m-d h:i:s");
            self::$log[]="[".$type."]".$message."(".$date.")"."\r\n";
        }
    }
    //存储日志内容到文件
    static function save($message_type = 3, $destination = null, $extra_headers = null){//用到系统错误日志方法error_log
        if (!C("LOG_START"))return;
        if(is_null($destination)){//如果文件为空则创建文件
            $destination=LOG_PATH.'/'.date("y_m_d").".log";
        }
        if ($message_type==3){
            if (is_file($destination)&&filesize($destination)>C("LOG_SIZE")){//如果文件存在且文件大小超过限定大小，则更名保存
                rename($destination, dirname($destination).'/'.time().'.log');
            }
        }
        error_log(implode(",",self::$log),$message_type,$destination);
    }
    //直接写入日志文件
    static function write($message,$message_type = 3, $destination = null, $extra_headers = null){//用到系统错误日志方法error_log
        if (!C("LOG_START"))return;
        if(is_null($destination)){//如果文件为空则创建文件
            $destination=LOG_PATH.'/'.date("y_m_d").".log";
        }
        if ($message_type==3){
            if (is_file($destination)&&filesize($destination)>C("LOG_SIZE")){//如果文件存在且文件大小超过限定大小，则更名保存
                rename($destination, dirname($destination).'/'.time().'.log');
            }
        }
        $type="ERROR";
        $date=date("y_m_d h:i:s");
        $message="[".$type."]".$message."(".$date.")"."\r\n";
        error_log($message,$message_type,$destination);
    }
}



