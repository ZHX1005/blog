<?php
header("Content-Type:text/html;Charset=utf-8");
class page{
	private $total_rows;//总记录数
	private $total_page;//总页数
	private $onepage_rows;//每页显示行数
	private $self_page;//当前页
	private $url;//URL地址
	private $page_rows;//当前显示页码数量
	private $start_id;//当前页起始ID
	private $end_id;//当前页结束ID
	private $desc=array();
	
	//初始化配置
	function __construct($total,$rows=10,$page_rows=8,$desc=''){
		$this->total_rows = $total;//总条数
		$this->onepage_rows = $rows;//每页显示行数
		$this->page_rows = $page_rows;//页码数量
		$this->total_page = ceil($this->total_rows/$this->onepage_rows);//总页数
		$this->self_page = min($this->total_page,max((int)@$_GET['page'],1));//当前页
		$this->start_id = ($this->self_page-1)*$this->onepage_rows+1;//起始ID
		$this->end_id = min($this->total_rows,$this->self_page*$this->onepage_rows);
		$this->url = $this->requestUrl();//配置URL地址
		$this->desc = $this->desc($desc);//分页文字描述
		//var_dump($this->desc);
	}
	//配置URL地址
	private function requestUrl(){
		//重到URL地址
		$url = isset($_SERVER['REQUEST_URI'])?$_SERVER['REQUEST_URI']:$_SERVER['PHP_SELF'].$_SERVER['QUERY_STRING'];
		//解析URL地址，返回数组
		$request_Arr = parse_url($url);
		if(isset($request_Arr['query'])){
			//解析请求参数
			parse_str($request_Arr['query'],$arr);
			//删除参数中的page元素
			unset($arr['page']);
			//合并路径及请求参数为标准的URL地址
			$url = $request_Arr['path']."?".http_build_query($arr)."&page=";
		}else{
			//没有请求参数GET的情况
			$url = strstr($url,"?")?$url."page=":$url."?page=";
		}
		return $url;
	}
	/**
	 * 配置分页文字描述方法
	 * "pre"=>"上一页"
	 * "next"=>"下一页"
	 * "first"=>"首页"
	 * "end"=>"末页"
	 * "unit"=>"条"
	 */
	public function desc($desc){
		//默认文字描述
		$d = array(
			"pre"=>"上一页",
	 		"next"=>"下一页",
	 		"first"=>"首页",
	 		"end"=>"末页",
	 		"unit"=>"条",);
		if(empty($desc) || !is_array($desc)){
			return $d;
		}
		function filter($v){
			return !empty($v);
		}
		return array_merge($d,array_filter($desc,"filter"));
	}
	//SQL的limit语句
	public function limit(){
	    return "LIMIT ".max(0,($this->self_page-1)*$this->onepage_rows).",".$this->onepage_rows;
	}
	//上一页
	public function pre(){
	    return $this->self_page>1?"<a href='".$this->url.($this->self_page-1)."'>".$this->desc['pre']."</a>":$this->desc['pre'];
	}
	//下一页
	public function next(){
	    return $this->self_page<$this->total_page?"<a href='".$this->url.($this->self_page+1)."'>".$this->desc['next']."</a>":$this->desc['next'];
    }
    //首页
    public function first(){
        return $this->self_page>1?"<a href='{$this->url}1'>{$this->desc['first']}</a>":$this->desc['first'];
    }
    //尾页
    public function end(){
        return $this->self_page<$this->total_page?"<a href='{$this->url}{$this->total_page}'>{$this->desc['end']}</a>":$this->desc['end'];
    }
    //当前页的记录
    public function nowpage(){
        return "第".$this->start_id."{$this->desc['unit']}-{$this->end_id}{$this->desc['unit']}";
    }
    //返回当前页面码
    public function selfnum(){
        return $this->self_page;
    }
    //count 统计数据信息
    public function count(){
        return "<span>总页:{$this->total_page}页&nbsp;&nbsp;总计:{$this->total_rows}条</span>";
    }
    //前几页
    public function pres(){
        $num = $this->self_page-$this->page_rows;
        //return "<a href='{$this->url}{$num}'>前{$this->page_rows}页</a>";//在前几页的时候，显示前几页选项
        return $this->self_page>$this->page_rows?"<a href='{$this->url}{$num}'>前{$this->page_rows}页</a>":'';//在前几页的时候，不显示前几页选项
    }
    //后几页
    public function nexts(){
       $num = $this->self_page+$this->page_rows;      
       return $this->self_page<$this->total_page-$this->page_rows?"<a href='{$this->url}{$num}'>后{$this->page_rows}页</a>":'';
    }
    //获得页码数组
 /*    public  function pagelist(){
        $pagelist=array();
        $start="";
        $end="";
        for($i=1;$i<$this->total_page;$i++){
            $pagelist.="<a href='{$this->url}{$i}'>$i</a>&nbsp;";
        }
        return $pagelist;
    } */
    public  function pagelist(){
        $pagelist=array();
        //开始页等于要显示的页面总数除以2
        $start=max(1,
            min($this->self_page-ceil($this->page_rows/2),$this->total_page-$this->page_rows));
        $end=min($this->total_page,$start+$this->page_rows);
        for ($i=$start;$i<=$end;$i++){
            if($i==$this->self_page){
                $pagelist[$i]["url"]='';
                $pagelist[$i]['str']=$i;
                continue;
            }
            $pagelist[$i]["url"]=$this->url.$i;
            $pagelist[$i]['str']=$i;
        }
        return $pagelist;
        //echo "<br/>".$start."<br/>";
        /*for
         for($i=1;$i<$this->total_page;$i++){
             if($i=$this->self_page){
                $pagelist.="<strong>$i</strong>";
                continue;
            } 
            $pagelist.="<a href='{$this->url}{$i}'>$i</a>&nbsp;";
        }
        return $pagelist; */       
     }
     //字符串表示的页码列表
     public function strlist(){
         $arr = $this->pagelist();
         $pagelist = '';
         foreach ($arr as $v) {
             $pagelist.=empty($v['url'])?"<strong>".$v['str']."</strong>":"<a href='{$v['url']}'>{$v['str']}</a>";
         }
         return $pagelist;
     }
     //下拉列表框分页
     public function  select(){
         $arr=$this->pagelist();
         //$str="<select class='PageSelect' onchange='javascript:alert(this.options[selectedIndex].value)'>";
         $str="<select class='PageSelect' onchange='javascript:location.href=
             (this.options[selectedIndex].value)'>";
         foreach ($arr as $v){
             $str.=empty($v['url'])?"<option value='{$this->url}{$v['str']}'selected='selected'>
             {$v['str']}</option>":"<option value='{$v['url']}'>{$v['str']}</option>";
         }
         $str.="</select>";
         return $str;
     }
     //直接输入页码进行跳转
     public function input(){
         //onkeydown捕捉鼠标键盘操作,回车键码值为13
         $str="<input type='text' value='{$this->self_page}' id='pageinput'
class='pageinput'onkeydown=\"
         javascript:if(event.keyCode==13){
            //var pageinput = document.getElementById('pageinput');
            //lert(pageinput.value);
            location.href='{$this->url}'+this.value;
          };\"/>
          <button onclick=\"javascript:
                var url=document.getElementById('pageinput').value;
                //alert(url);
                location.href='{$this->url}'+url;
          \">跳转</button>
          ";
         return $str;
     }
     //分页风格，demo里修改风格即可选择不同风格
     public function show($style_id){
         switch($style_id){
             case 1:
                 return $this->first().$this->pres().$this->pre().$this->strlist().$this->next().$this->nexts().$this->end().$this->select().$this->input().$this->count()."当前页是：".$this->nowpage();
             case 2:
                 return $this->pre().$this->strlist().$this->next();
             case 3:
                 return $this->pres().$this->select().$this->nexts();
         }
     }
    
}