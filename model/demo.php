<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
<html>
<head>
<style type="text/css">
    .page{font-size:12px;line-height:1.8em}
    .page a{
	   font-size:12px;color:#333;
       text-decoration:none;
    	border:solid 1px #333;
    	float:left;
    	margin-right:5px;
    	padding:0 5px;
    	height:20px;line-height:1.8em;
    	background-color:#333;
    	color:fff;
    }
    .page a:hover{
	   color:#333;
    	background-color:#fff;
    }
    .page strong{
	    font-size:12px;color:#c11013;
        text-decoration:none;
    	border:solid 1px #333;
    	float:left;
    	margin-right:5px;
    	padding:0 5px;
    	height:20px;line-height:1.8em;
    	background-color:#c11013;
    	color:fff;
    }
    table{
	   width:960px;
    }
    table td{
	   border:solid 1px #333;padding-left:10px;
    }
    table th{
	  background-color:#333;color:#fff;
    }
    .pagelist{ 	
	   padding-top:20;
    }
    .pagelist .pageinput{ 	
	   width:30px;
    }
</style>
</head>
<body>
<div class="page">
<?php
include '../config/config.php';
include 'db.class.php';
include 'page.class.php';
$db=new db("article");
/*
for($i=0;$i<100;$i++){
    $db->insert(array("btitle"=>$i));
}*/
$total=$db->count();
//测试篇数(总篇数，每页显示篇数，显示页码数) 
$pagelist=new page($total,15,8,array("pre"=>"上一页","next"=>"下一页"));
$result = $db->sql("SELECT * FROM blog_article  {$pagelist->limit()}");

//$pagelist->limit();
/*  echo $pagelist->pre();
echo $pagelist->next();
echo $pagelist->first();
echo $pagelist->end();
echo $pagelist->nowpage();
echo "当前页是第".$pagelist->selfnum()."页";
echo $pagelist->count();  */
//echo $pagelist->pagelist();
//var_dump($pagelist->pagelist());
//echo $pagelist->strlist();
?>
<table>
    <tr>
        <th>id</th>
        <th>btitle</th>
        <th>content</th>
        <th>status</th>
        <th>cid</th>
        
    </tr>
<?php 
    foreach ($result as $v){     
?>
    <tr>
        <td><?php echo $v['id']; ?></td>
        <td><?php echo $v['btitle']; ?></td>
        <td><?php echo $v['content']; ?></td>
        <td><?php echo $v['status']; ?></td>
        <td><?php echo $v['cid']; ?></td>
    </tr>
<?php }?>
</table>
<div class="pagelist">
    <?php echo$pagelist->pre(); echo $pagelist->strlist();
    echo "当前页是：". $pagelist->next();echo $pagelist->nowpage();
    echo $pagelist->count(); echo $pagelist->select();
    echo $pagelist->input();
    ?>
</div>
</div>
</body>
</html>
