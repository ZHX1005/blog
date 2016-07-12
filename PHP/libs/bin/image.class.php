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
        $this->water_img=C("WATER_IMG");
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
        return extension_loaded('gd')&&file_exists($img)&&in_array($img_type, $haystack);
    }
    /*
     * 获得缩略图尺寸信息
     *  $img_w     原图宽度
     *  $img_h     原图高度
     *  $t_w       缩略图宽度
     *  $t_h       缩略图高度
     *  $t_type    处理方式
     */
    private function thumb_size($img_w,$img_h,$t_w,$t_h,$t_type)
}








