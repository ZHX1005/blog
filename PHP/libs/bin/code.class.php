<?php
/** 
*==============================================
* 素梅好翔博客  http://www.wanysys.cc
* ----------------------------------------------
* @date: 2016年7月10日 上午10:23:00
* @author: 张昊翔
* ==============================================
**/
class code{
    //资源
    private $img;
    //画布宽度
    //public $width=85; 改写到配置文件里
    public $width;
    //画布高度
    //public $height=25;
    public $height;
    //背景颜色
    //public $bg_color="#dcdcdc";
    public $bg_color;
    //验证码
    public $code;   
    //验证码的随机种子
    //public $code_str="1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
    public $code_str;
    //验证码长度
    //public $code_len=4;
    public $code_len;
    //验证码字体
    public $font;
    //验证码字体大小
    //public $font_size=16;
    public $font_size;
    //验证码字体颜色
    //public $font_color="#000000";
    public $font_color;
    /*
     * 构造函数
     */
    public function __construct(){
        //$this->font="font".DIRECTORY_SEPARATOR.'arial.ttf';
        $this->code_str=C("CODE_STR");
        $this->code_len=C("CODE_LEN");
        $this->width=C("CODE_WIDTH");
        $this->height=C("CODE_HEIGHT");
        $this->font=C("FONT");  
        $this->bg_color=C("CODE_BG_COLOR");
        $this->font_size=C("CODE_FONT_SIZE");
        $this->font_color=C("CODE_FONT_COLOR");
        $this->create();
    }
    /*
     * 生成验证码  (无误)
     */
    private function create_code(){
        $code='';
        for ($i=0;$i<$this->code_len;$i++){
            $code.=$this->code_str[mt_rand(0, strlen($this->code_str)-1)];//mt_rand生成随机数
        }
        //$this->code=$code;
        $this->code=strtoupper($code);//转化为大写
        $_SESSION[C("CODE")]=$this->code;
        //var_dump($this->code);
    }   
    /*
     * 返回验证码
     */
    public function getstr(){
        //return strtoupper($this->code);//strtoupper() 函数把字符串转换为大写
        return $this->code;  
    }
    /*
     * 建画布
     */
    public function create(){
        $w=$this->width;      
        $h=$this->height;       
        $bg_color=$this->bg_color;
        if (!$this->checkgd())return false;  //验证GD库
        //echo "yanzhenma";
        $img=imagecreatetruecolor($w, $h);//图像生成函数
        $bg_color=imagecolorallocate($img, hexdec(substr($bg_color, 1,2)),hexdec(substr($bg_color, 3,2)),hexdec(substr($bg_color, 5,2)));//hexdec() 函数把十六进制转换为十进制  imagecolorallocate：为一幅图像分配颜色
        imagefill($img, 0, 0, $bg_color);//将图片坐标 (x,y) 所在的区域着色
        $this->img=$img;     
        $this->create_font();
        $this->create_pix();
    }
    /*
     * 写入验证码文字
     */
    public function create_font(){
       // echo "yanzhenma";
        $this->create_code();//引入生成验证码函数
        $color=$this->font_color;
        //$font_color=imagecolorallocate($this->img, hexdec(substr($color, 1,2)),hexdec(substr($color, 3,2)),hexdec(substr($color, 5,2)));
        $font_color= imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
        $x=$this->width/$this->code_len;
        for ($i = 0; $i < $this->code_len; $i++) {           
            if (empty($color)){
                $font_color=imagecolorallocate($this->img, mt_rand(50, 155), mt_rand(50, 155), mt_rand(50, 155));    
            }
            imagettftext($this->img, $this->font_size, mt_rand(-30, 30), $x*$i+mt_rand(3, 6), mt_rand($this->height/1.2, $this->height-5), $font_color, $this->font, $this->code[$i]);
        }
        $this->font_color=$font_color;      
    }
    /*
     * 画线
     */
    private function create_pix(){      
        $pix_color=$this->font_color;
        for ($i=0;$i<100;$i++){
            imagesetpixel($this->img, mt_rand(0, $this->width), mt_rand(0, $this->height), $pix_color);
        }
        for ($j=0;$j<2;$j++){
            imagesetthickness($this->img, mt_rand(1, 2));
            imageline($this->img, mt_rand(0, $this->width), mt_rand(0, $this->height),mt_rand(0, $this->width), mt_rand(0, $this->height), $pix_color);
           
        }
    }
    /*
     * 显示验证码
     */
    public function getimage(){
        ob_clean();//关键代码，防止出现'图像因其本身有错无法显示'的问题
        header('Content-type:image/png');
        imagepng($this->img);//生成png格式 
        imagedestroy($this->img);
        
    }
    /*
     * 验证GD库是不是打开  ，imagepng函数是否可用
     */
    private function checkgd(){
        return extension_loaded('gd')&&function_exists("imagepng");
    }
}








