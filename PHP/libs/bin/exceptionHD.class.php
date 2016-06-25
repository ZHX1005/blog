<?php
/** 
*==============================================
* 素梅好翔博客  http://www.wanysys.cc
* ----------------------------------------------
* @date: 2016年6月25日 下午2:57:19
* @author: 张昊翔
* 异常处理
* ==============================================
**/
class exceptionHD extends Exception{
    //父类构造方法
    function __construct($message, $code=0){
        parent::__construct($message, $code);
    }
    //显示异常
    function show(){
        //var_dump($this->getTrace());
        $trace=$this->getTrace();
        $error['message']="Message:".$this->message;
        $error['message'].="<br/>File:".$this->file."[".$this->line."]";
        $error['message'].="<br/>".$trace[0]['class'];
        $error['message'].=$trace[0]['type'];
        $error['message'].=$trace[0]['function']."()";
        $info='';
        foreach ($trace as $v){
            $class=isset($v['class'])?$v['class']:'';
            $type=isset($v['type'])?$v['type']:'';
            $file=isset($v['file'])?$v['file']:'';
            $info.=$file."\t".$class.$type.$v['function']."<br/>";          
        }
        $error['info']=$info;
        return $error;
    }
}