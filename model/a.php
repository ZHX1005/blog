<?php
include '../config/config.php';
include 'db.class.php';
$db=new db("article");
//插入
$db->insert(array("btitle"=>"houdun","content"=>"123"));
//查询
//var_dump($db->select());
//删除
//$db->where("bid<2")->delete();