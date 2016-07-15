<?php
           class indexControl extends Control{
                function index(){
                  /*  dir::del("D:/wamp/www/blog2/blog/temp/");
                   var_dump($list); */
                    //dir::create("d:/wamp/www/blog/blog/blog/a/aa/aaa/aaaa/");
                  /* $static=  dir::copy("d:/wamp/www/blog/blog/php/11/","d:/wamp/www/blog/blog/blog/b/");
                    if ($static)echo "复制成功";
                    else echo("复制失败"); */
                    //var_dump($_SERVER);
                   //url::parseUrl();
                   //echo C("FONT");
                  /* $code=new code();
                   echo $code->getstr();  
                   echo $code->getimage();  */
                   //echo $code->create_code();
                  // echo $code->create_font();
              // $img=new images();
              //$img->thumb("a.png");
                /* $img=new images();
               $img->watermark("shuiyin.png");  */
                    $up=new upload();
                    $up->upload();
                }
           }     