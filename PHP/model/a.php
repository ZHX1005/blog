<?php
include '../config/config.php';
include 'db.class.php';
$db=new db("article");
//插入
//$db->insert(array("btitle"=>"houdun","content"=>"123"));
//查询
//var_dump($db->select());
//删除
//$db->where("bid<2")->delete();
for($i=0;$i<100;$i++){
    $db->insert(array("btitle"=>$i,"content"=>"测试","status"=>"测试","cid"=>$i*2));
}


 echo $pagelist->pre(); echo $pagelist->strlist();
echo "当前页是：". $pagelist->next();echo $pagelist->nowpage();
echo $pagelist->count(); echo $pagelist->select();
echo $pagelist->input();echo $pagelist->pres();
echo $pagelist->nexts();
?>
