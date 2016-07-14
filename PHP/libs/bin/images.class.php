<?php
/** 
*==============================================
* 素梅好翔博客  http://www.wanysys.cc
* ----------------------------------------------
* @date: 2016年7月12日 下午3:50:36
* @author: 张昊翔
* ==============================================
**/
class images{
    //是否应用水印
    private $water_on;
    //水印图片
    public $water_img;
    //水印的位置
    Public $water_pos;
    //水印的透明度
    Public $water_pct;
    //图像的压缩比
    Public $water_quality;
    //水印文字内容
    Public $water_text;
    //水印文字大小
    Public $water_text_size;
    //水印文字的颜色
    Public $water_text_color;
    //水印的文字字体
    Public $water_text_font;
    //是否开启缩略图功能
    private  $thumb_on;
    //生成缩略图的方式
    Public $thumb_type;
    //缩略图的宽度
    Public $thumb_width;
    //缩略图的高度
    Public $thumb_height;
    //生成缩略图文件名前缀
    Public $thumb_prefix;
    //生成缩略图文件名后缀
    Public $thumb_endfix;
    /*
     * 构造函数
     */
    function __construct(){
        //水印配置参数
        $this->water_on=C("WATER_ON");
        $this->water_img=C("WATER_TYPE")==1?C("WATER_IMG"):'';//为1为图片否则为文字
        $this->water_pct=C("WATER_PCT");
        $this->water_pos=C("WATER_POS");
        $this->water_quality=C("WATER_QUALITY");
        $this->water_text=C("WATER_TEXT");
        $this->water_text_color=C("WATER_TEXT_COLOR");
        $this->water_text_size=C("WATER_TEXT_SIZE");
        $this->water_text_font=C("FONT");
        //缩略图配置参数
        $this->thumb_on=C("THUMB_ON");
        $this->thumb_type=C("THUMB_TYPE");
        $this->thumb_width=C("THUMB_WIDTH");
        $this->thumb_height=C("THUMB_HEIGHT");
        $this->thumb_prefix=C("THUMB_PREFIX");
        $this->thumb_endfix=C("THUMB_ENDFIX");
    }
    /*
     * 环境验证
     * $img 图像路径
     */
    private function check($img){
        $type=array(".jpg",".jpeg",".png",".gif");
        $img_type=strtolower(strrchr($img, '.'));
        return extension_loaded('gd')&&file_exists($img)&&in_array($img_type, $type);
    }
    /*
     * 获得缩略图尺寸信息
     *  $img_w     原图宽度
     *  $img_h     原图高度
     *  $t_w       缩略图宽度
     *  $t_h       缩略图高度
     *  $t_type    处理方式
     */
    private function thumb_size($img_w,$img_h,$t_w,$t_h,$t_type){
        //初始化缩略图尺寸
        $w=$t_w;
        $h=$t_h;
        //初始化原始尺寸
        $cut_w=$img_w;
        $cut_h=$img_h;
        if ($img_w<=$t_w&&$img_h<=$t_h){
            $w=$img_w;
            $h=$img_h;
        }else {
            switch ($t_type){
                case 1:
                    //固定宽度，高度自增
                    $h=$t_h/$img_w*$img_h;
                    break;
                case 2:
                    //固定高度，宽度自增
                    $w=$t_h/$img_h*$img_w;
                    break;
                case 3:
                    //固定宽度，高度截切
                    $cut_h=$img_w/$t_w*$t_h;
                    break;
                case 4:
                     //固定宽度，高度截切
                     $cut_w=$img_h/$t_h*$t_w;
                     break;
                case 5:
                default:
                    if (($img_w/$t_w)>($img_h/$t_h)){
                        $h=$t_w/$img_w*$img_w;           
                    }elseif (($img_w/$t_w)<($img_h/$t_h)){
                        $w=$t_h/$img_h*$img_w;
                    }else {
                        $w=$t_w;
                        $h=$t_h;
                    }                  
            }
        }
        $arr[0]=$w;
        $arr[1]=$h;
        $arr[2]=$cut_w;
        $arr[3]=$cut_h;
        return $arr;
    }
    /*
     * 图片裁切处理
     * $img 操作的图片路径
     * $outfile 输出文件路径
     * $t_type 截切图片的方式
     * $t_w 缩略图宽度
     * $t_h 缩略图高度
     * return $string 处理后的文件名
     */
    public function thumb($img,$outfile='',$t_type='',$t_w='',$t_h=''){
        if (!$this->thumb_on||!$this->check($img)){
            return false;
        }
        //基础配置
        $t_type=$t_type?$t_type:$this->thumb_type;
        $t_w=$t_w?$t_w:$this->thumb_width;
        $t_h=$t_h?$t_h:$this->thumb_height;
        //获得图像信息
        $img_info=getimagesize($img);
        $img_w=$img_info[0];
        $img_h=$img_info[1];
        $img_type=image_type_to_extension($img_info[2]);
        //获得图像尺寸
        $thumb_size=$this->thumb_size($img_w, $img_h, $t_w, $t_h, $t_type);
        //原始图像资源
        $func="imagecreatefrom".substr($img_type, 1);
        $res_img=$func($img);
        //缩略图的资源
        if ($img_type=='.gif'||$img_type=='.png'){
            $res_thumb=imagecreate($thumb_size[0], $thumb_size[1]);
            $color=imagecolorallocate($res_thumb, 255,0,0);
        }else{
            $res_thumb=imagecreatetruecolor($thumb_size[0],  $thumb_size[1]);
        }
        //绘制缩略图
        if(function_exists("imagecopyresampled")){
            imagecopyresampled($res_thumb, $res_img, 0, 0, 0, 0, $thumb_size[0], $thumb_size[1], $thumb_size[2], $thumb_size[3]);//图像缩放
        }else{
            imagecopyresized($res_thumb, $res_img, 0, 0, 0, 0, $thumb_size[0], $thumb_size[1], $thumb_size[2], $thumb_size[3]);//图像缩放，算法比imagecopyresampled快但比其粗糙
        }
        //处理透明色
        if($img_type=='.gif'||$img_type=='.png'){
            imagecolortransparent($res_thumb,$color);//将某个颜色定义为透明色
        }
        //配置输出文件名
        $thumbPath=C("THUMB_PATH");
        dir::create($thumbPath);
        $info=pathinfo($img);
        $outfile=$outfile?$outfile:$this->thumb_prefix.$info['filename'].$this->thumb_endfix.".".$info['extension'];
        $outfile=$thumbPath.'/'.$outfile;
        //echo $outfile;
        $func="image".substr($img_type, 1);
        $func($res_thumb,$outfile);
        if (isset($res_thumb)) imagedestroy($res_thumb);
        if (isset($res_img)) imagedestroy($res_img);
        return $outfile;
    }
    /*
     * 水印处理
     * $img 操作的图像
     * $out 另存的图像
     * $water_img 水印图片
     * $pos 水印位置
     * $text 文字水印内容
     * $pet 透明度
     */
     public function watermark($img,$out_img='',$water_img='',$pos='',$text="",$pct=''){
         //验证原图像
         if (!$this->check($img)||!$this->water_on)
             return false;
         //验证水印图像
         $water_img=$water_img?$water_img:$this->water_img;
         $waterimg_on=$this->check($water_img)?1:0;
         //判断另存图像
         $out_img=$out_img?$out_img:$img;
         //水印位置
         $pos=$pos?$pos:$this->water_pos;
         //水印文字
         $text=$text?$text:$this->water_text;
         //水印透明度
         $pct=$pct?$pct:$this->water_pct;
         $img_info=getimagesize($img);
         $img_w=$img_info[0];
         $img_h=$img_info[1];  
         //获得水印信息
         if($waterimg_on){
             $w_info=getimagesize($water_img);
             $w_w=$w_info[0];
             $w_h=$w_info[1];
             switch ($w_info[2]){
                 case 1:
                     $w_img=imagecreatefromgif($water_img);
                     break;
                 case 2:
                     $w_img=imagecreatefromjpeg($water_img);
                     break;
                 case 3:
                     $w_img=imagecreatefrompng($water_img);
                     break;
             }
         }else{
             if (empty($text)||strlen($this->water_text_color)!=7)return false;
             $text_info=imagettfbbox($this->water_text_size, 0, $this->water_text_font, $text);
             $w_w=$text_info[2]-$text_info[6];
             $w_h=$text_info[3]-$text_info[7];
         }
         //建立原图资源
         if ($img_h<$w_h||$img_w<$w_w)
             return false;
         switch ($img_info[2]){
             case 1;
                $res_img=imagecreatefromgif($img);
                break;
             case 2:
                $res_img=imagecreatefromjpeg($img);
                break;
             case 3:
                $res_img=imagecreatefrompng($img);
                break;
         }
         //水印位置处理方法
         switch ($pos){
             case 1:
                 $x=$y=25;
                 break;
             case 2:
                 $x=($img_w-$w_w)/2;
                 $y=25;
                 break;
             case 3:
                 $x=$img_w-$w_w-10;
                 $y=25;
                 break;
             case 4:
                 $x=25;
                 $y=($img_h-$w_h)/2;
                 break;
             case 5:
                 $x=($img_w-$w_w)/2;
                 $Y=($img_h-$w_h)/2;
                 break;
             case 6:
                 $x=$img_w-$w_w;
                 $y=($img_h-$w_h)/2;
                 break;
             case 7:
                 $x=25;
                 $y=$img_h-$w_h-10;
                 break;
             case 8:
                 $x=($img_w-$w_w)/2;
                 $y=$img_h-$w_h-10;
                 break;
             case 9:
                 $x=$img_w-$w_w-10;
                 $y=$img_h-$w_h;
                 break;
             default:
                 $x=mt_rand(25, $img_w-$w_w);
                 $y=mt_rand(25, $img_h-$w_h);
             
         }
         if($waterimg_on){
             if ($w_info[2]==3){
                 imagecopy($res_img, $w_img, $x, $y, 0, 0, $w_w, $w_h);                 
             }else {
                 imagecopy($res_img, $w_img, $x, $y, 0, 0, $w_w, $w_h,$pct);
             }
         }else{
             $red=hexdec(substr($this->color,1,2));
             $green=hexdec(substr($this->color,3,2));
             $blue=hexdec(substr($this->color,5,2));
             $color=imagecolorallocate($res_img, $red, $green, $blue);
             imagettftext($res_img,$this->text_size,0,$x,$y,$color,$this->font,iconv('gbk', 'utf-8', $text));
         }
         switch ($img_info[2]){
             case 1:
                 imagegif($res_img,$out_img);
                 break;
             case 2:
                 imagejpeg($res_img,$out_img,$this->quality);
                 break;
             case 3:
                 imagepng($res_img,$out_img);
                 break;
         }
         if (isset($res_img)) 
             imagedestroy($res_img);
         if (isset($w_img)) {
             imagedestroy($w_img);
             return true;
         }
     }
    
}








