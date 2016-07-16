<?php
/** 
*==============================================
* 素梅好翔博客  http://www.wanysys.cc
* ----------------------------------------------
* @date: 2016年7月15日 下午4:16:24
* @author: 张昊翔
* 文件上传
* ==============================================
**/
class upload{
    //文件上传类型
    private $exts;
    //文件上传大小
    public $size;
    //文件上传目录
    public $path;
    //文件上传表单
    public $fields;
    //错误信息
    public $error;
    //是否开启缩略图
    public $thumb_on=1;
    //缩略图参数
    public $thumb;
    //水印处理
    public $waterMark_on=1;
    //上传成功文件信息
    public $uploadFiles=array();
    
    /*
     * 构造函数
     * $path  保存路径
     * $ext_size 文件类型与大小
     * $thumb 缩略图参数
     */
    function __construct($path="",$exts_size=array(),$size="",$thumb=array()){
        //类型
        $this->path=empty($path)?C("UPLOAD_PATH"):$path;
        if (!empty($exts_size)&&is_array($exts_size)){
            $this->exts=array_keys($exts_size);
            $this->size=$exts_size;
        }else{
            $this->exts=array_keys(C("UPLOAD_EXT_SIZE"));
            $this->size=C("UPLOAD_EXT_SIZE");
        }
        //$this->exts=empty($exts_size)?array_keys(C("UPLOAD_EXT_SIZE")):array_keys($exts_size);
        $this->thumb=$thumb;
    }
    /*
     * 文件上传（外部调用接口）
     */
    public function upload(){
       if (!$this->checkDir()) {
           $this->error="目录".$this->path."目录创建失败或者不可写";
           return false;
       }
       $files=$this->format();
       //var_dump($files);
       foreach ($files as $v){
           $info =pathinfo($v['name']);
           $v['ext']=$info['extension'];
           var_dump($info);
           exit;
       }
    }
    /*
     * 目录验证
     */
    private function checkDir(){
        $path=$this->path;
        return dir::create($path)&&is_writeable($path) ?true:false;
    }
    private function format(){
        $files=$_FILES;
        if (!isset($files)){
            $this->error="没有任何文件上传";
            return false;
        }
        $info=array();
        $n=0;
        //对数组格式化，多维变成一维
        foreach ($files as $v){
            if (is_array($v['name'])){
               $count=count($v['name']);
               for ($i=0;$i<$count;$i++){
                   foreach ($v as $m=>$k){
                       $info[$n][$m]=$k[$i];
                   }
                   $n++;
               }
            }else {//普通字符串
                $info[$n]=$v;
                $n++;
            }
        }
        return $info;
    }
}




