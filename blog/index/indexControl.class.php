<?php
/** 
*==============================================
* 素梅好翔博客  http://www.wanysys.cc
* ----------------------------------------------
* @date: 2016年6月20日 下午2:37:39
* @author: 张昊翔
* ==============================================
**/
class indexControl{
    function index(){
        //echo E_USER_ERROR;
       //echo __CLASS__."===".__METHOD__;
        //trigger_error("错误",E_USER_ERROR);//与APP.class中set_error_handler函数一起使用
       //A("cc");
        trigger_error("抛出错误");
    }
}