<?php
/** 
*==============================================
* 素梅好翔博客  http://www.wanysys.cc
* ----------------------------------------------
* @date: 2016年6月26日 下午3:16:53
* @author: 张昊翔
* 获得文件目录
* ==============================================
**/
final class dir{
    //转换为标准目录结构
    static function dir_path($dirname){
        $dirname=str_ireplace('\\', '/', $dirname);//转换斜杠样式
        return substr($dirname, -1)=='/'?$dirname:$dirname.'/';//截取       
    }
    //获得文件扩展名
    static function get_ext($filename){
        return substr(strrchr($filename, "."),1);
    }
    //获得目录类容
    static function tree($dirname,$exts='',$son=0,$list=array()){//文件名，扩展，子目录，内容列表
        $dirname=self::dir_path($dirname);  
        if (is_array($exts)) {
            $exts=implode("|",$exts);
        }
        static $id=0;
        foreach(glob($dirname."*")as $v){
           // echo $v."<br/>";
            $id++;
            if (!$exts||preg_match("/\.($exts)/i",$v)){
                $list[$id]['name']=basename($v);
                $list[$id]['path']=realpath($v);
                $list[$id]['type']=filetype($v);
                $list[$id]['ctime']=filectime($v);//修改时间
                $list[$id]['atime']=fileatime($v);//创建时间
                $list[$id]['filesize']=filesize($v);
                $list[$id]['iswrite']=is_writable($v);//是否可写
                $list[$id]['isread']=is_readable($v);
            }
            if ($son){
                if(is_dir($v)){
                    $list=self::tree($v,$exts,$son,$list);
                }
            }
        }
        return $list;
    }
    //只获得目录结构
    static function tree_dir($dirname,$pid=0,$son=0,$list=array()){
        $dirname=self::dir_path($dirname);
        static $id=0;
        foreach(glob($dirname."*")as $v){
            if (is_dir($v)) {
                $id++;
                $list[$id]['id']=$id;
                $list[$id]['pid']=$pid;
                $list[$id]['name']=basename($v);
                $list[$id]['path']=realpath($v);
                if ($son) {
                    $list=self::tree($v,$id,$son,$list);
                }
            }
        }
        return $list;
    }
    //删除目录
    static function del($dirname){
        $dirPath=self::dir_path($dirname);
        if(!is_dir($dirPath))
            return false;
        foreach (glob($dirPath."*")as $v){
            is_dir($v)?self::del($v):unlink($v);
        }
        return rmdir($dirPath);
    }
}


