<?php
class  db{
    //数据库链接
    protected $mysqli;
    //表名
    protected $table;
    //选项
    protected $opt;
    /**
     * 构造方法
     * @param 表名
     */
    function _construct($tab_name){
        $this->config($tab_name);
    }
   /**
    * 配置方法
    */
    protected  function config($tab_name){
      $this->mysqli=new mysqli(DBHOST,DBUSER,DBPWD,DBNAME);
      if (mysqli_connect_errno()){
          echo "数据库链接错误".mysqli_connect_errno();
          exit();
      }
      $this->db->query("SET NAMES 'utf-8'");
      $this->tbFields();
    }
    /*
     * 获得表的字段
     */
    function tbFilds(){
        $result=$this->db->query("DESC{$this->table}");
        $fileArr=array();//保存表信息
        while(($row=$result->fetch_assoc())!=false){
            $fieldArr[]=$row["Field"];
        }
        $this->opt['fields']=$fieldArr;
        $this->fields;
    }
    /*
     * 获得查询字段
     */
    function field ($field){
        $fieldArr=is_string($field)?explode(",",$field):$field;
        if (is_array($fieldArr)){//字符串
            $field='';
            foreach ($fieldArr as $v){
                $field.="`".$v."`".",";
            }
        }
        $this->opt['field']=rtrim($field,',');
        return $this;
    }
   /*
    * sql条件
    */
    function where($where){
        $this->opt['where']=is_string($where)?"WHERE ".$where:'';
        return $this;
    }
    /*
     * limit
     */
    function limit($limit){
        $this->opt['limit']=is_string($limit)?"LIMIT ".$limit:'';
        return $this;
    }
    /*
     * 排序order
     */
    function order($order){
        $this->opt['order']=is_string($order)?"ORDER ".$order:'';
        return $this;
    }
    /*
     * 分组
     */
    function group($group){
        $this->opt['group']=is_string($group)?"GROUP ".$group:'';
        return $this;
    }
    /*
     * 查询
     */
    function select(){
        $sql="SELECT{$this->opt['field']} FROM{$this->table} {$this->where}
        {$this->opt['group']}{$this->opt['limit']}{$this->opt['order']}";
        return $this->sql{$sql};
    }
    
    /*
     * 删除语句
     */
    function del($id=''){
        if(empty($this->opt['where'])||$id=='')
            die("查询条件不能为空");
        if($id!=''){
            if (is_array($id)){
               $id=implode(',',$id); 
            }
            $this->opt['where']="WHERE id IN(".$id.")";
        }
        $sql="DELETE FROM{$this->table} {$this->opt[where]}{$this->opt['limit']}";
        return  $this->query($sql);
    }
    /*
     * 查找单条记录
     */
    function find($id){
        $sql="SELECT {$this->opt['fields']} FROM {$this->table} WHERE `id`={$id}";
        return $this->sql($sql);
    }
    /*
     * 发送sql 获得结果集
     */
    function sql($sql){
        $result=$this->db->query($sql)or die($this->dbError());
        $resultArr=array();
        while (($row=$result->fetch_assoc())!=false){
            $resultArr[]=$row;
        }
        return $resultArr;
    }
    /*
     * 没有结果集SQL
     */
    function query($sql){
        $this->db->query($sql) or die($this->dbError());
        return $this->affected_rows;
    }
    /*
     * 返回错误
     */
    function dbError(){
        return $this->db->error;
    }
}
