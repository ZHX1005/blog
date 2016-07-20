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
    public $thumb_on;
    //缩略图参数
    public $thumb;
    //水印处理
    public $waterMark_on;
    //上传成功文件信息
    public $uploadFiles=array();
    
    /*
     * 构造函数
     * $path  保存路径
     * $ext_size 文件类型与大小
     * $thumb 缩略图参数
     */
    function __construct($path="",$exts_size=array(),$thumb=1,$waterMark=1){
        //水印配置
        //$this->waterMark_on=C("UPLOAD_WATERMARK_ON");
        $this->waterMark_on=empty($waterMark)?0:1;
        //缩略图
        $this->thumb_on=empty($thumb)?0:1;
        //$this->thumb_on=empty($thumb)?C("UPLOAD_THUMB_ON"):1;
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
       var_dump($files);
       foreach ($files as $v){
           $info =pathinfo($v['name']);
           $v['ext']=$info['extension'];
           $v['filename']=$info['filename'];
           if ($this->checkFile($v)){
               continue;
           }
           $uploadFile=$this->save($v);
           if ($uploadFile){
               $this->uploadFiles[]=$uploadFile;
           }
       }
    }
    /*
     * 存储上传文件
     */
    private function save($file){
        $is_img=0;
        $filePath=$this->path.'/'.$file['filename'].time().".".$file['ext'];
        
        if(in_array($file['ext'],array("jpg","png","jpeg","gif","bmp"))&&getimagesize($file['tmp_name'])){
            $filePath=C("UPLOAD_PATH_IMG").'/'.time().".".$file['ext'];
            $is_img=1;
        }
        if (!move_uploaded_file('tmp_name', $filePath)){
            $this->error="上传文件失败";
            return false;
        }
        if (!$is_img){
            return array("path",$filePath);
        }
        //对图像文件处理
        $img=new images();//引入图像处理函数
        //缩略图处理
        if ($this->thumb_on){
           $args =array();
           if (is_array($this->thumb)){
               array_unshift($args, $filePath,"");
               $args=array_merge($args,$this->thumb);
           }else {
               array_unshift($args, $filePath);               
           }
           $thumbfile=call_user_func_array(array($img,"thumb"), $args);
        }
        //水印处理
        if ($this->waterMark_on){
            $img->watermark($filePath);
        }
        return array("path"=>$filePath,"thumb"=>$thumbfile);
        //var_dump($file);
        //echo $filePath."<br/>";
    }
    /*
     * 目录验证
     */
    private function checkDir(){
        $path=$this->path;
        if (!dir::create($path) || !is_writeable($path)){
            return false;
        }
        $img_path=C("UPLOAD_PATH_IMG");
        if (!dir::create($path) || !is_writeable($path)){
            return false;
        }
        if(!dir::create($img_path) || !is_writeable($img_path)){
            return false;
        }
        return true;
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
    //验证上传文件
    private function checkFile($file){
        if ($file['error']!=0){
            $this->error=$this->error($file['error']);
            return false;
        }
        $ext_size=empty($this->size)?C("UPLOAD_EXT_SIZE"):$this->size;
        $ext=strtolower($file['ext']);
        if (!in_array($ext, $this->exts)){
            $this->error="非法上传类型";
            return false;
        }
        if(!empty($ext_size)&& $file['size']>$ext_size){
            $this->error="文件上传过大";
            return false;
        }      
        if (!is_uploaded_file($file['tmp_name'])){
            $this->error="非法文件";
            return false;
        }
        return true;
    }
    /*
     * 获得错误类型
     */
    private function error($type){
        switch($type){
            case UPLOAD_ERR_INI_SIZE:
                $this->error("超过PHP.INI配置文件指定大小");
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $this->error("上传文件超过HTML表单指定文件大小");
                break;
            case UPLOAD_ERR_NO_FILE:
                $this->error("没有上传任何文件");
                break;
            case UPLOAD_ERR_PARTIAL:
                $this->error("文件只上传了一部分");
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $this->error("没有上传的临时目录");
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $this->error("不能写入临时文件");
                break;
        }        
    }
    public function geterror(){
        return $this->error;
    }
}




