       <?php
           class indexControl extends Control{
                function index(){
                  /*  dir::del("D:/wamp/www/blog2/blog/temp/");
                   var_dump($list); */
                    //var_dump($_SERVER);
                   //url::parseUrl();
                   //echo C("font");
                   $code=new code();
                   echo $code->getstr();  
                   //echo $code->getimage();
                   //echo $code->create_code();
                }
           }     