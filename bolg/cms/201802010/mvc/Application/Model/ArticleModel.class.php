<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/12 0012
 * Time: 22:18
 */
class ArticleModel extends Model
{
    //查询所有sql语句
    public function getAll($sta,$page){
//        var_dump($sta);
        $where=' where status=1 ';
        if(!empty($sta)){
            $where = $where.' and '.implode(' and ',$sta);
        }
        //每页显示多少条
        $pageSize=3;
        //总记录数
        $sql_conut="select count(*) from article $where";
        //执行
        $count=$this->db->fetchColumn($sql_conut);
//        var_dump($conut);die;
        //总页数
        $totalPage=ceil($count/$pageSize);
//        var_dump($totalPage);die();
        $stau=($page-1)*$pageSize;
        $page<1?1:$page;
        $page>$totalPage?$totalPage:$page;
        $limit=" limit $stau,$pageSize";
        $where=$where==''?'where':$where;
        //写sql
        $sql="select * from article $where  $limit";
        //执行
       $rows=$this->db->fetchAll($sql);
       //返回值
        return ['list'=>$rows,'count'=>$count,'page'=>$page,'pageSize'=>$pageSize,'totalPage'=>$totalPage];
    }
    //查询管理员
    public function add(){
        //写sql语句
        $sql="select * from admin";
        //执行sql语句
        $row=$this->db->fetchAll($sql);
        //返回值
        return $row;
    }
    //添加保存
    public function add_save($data){
        if(empty($data['name'])){
            $this->error='文章标题不能为空!';
            return false;
        }
        if (empty($data['desc'])){
            $this->error='文章描述不能为空!';
            return false;
        }
        if ($data['status']===''){
            $this->error='状态不能为空!';
            return false;
        }
//        var_dump($data);die;
        $time=time();
        //写sql语句
        $sql="insert into article set `name`='{$data['name']}',`desc`='{$data['desc']}',user_id='{$data['user_id']}',logo='{$data['logo']}',add_time='{$time}',status='{$data['status']}',category_id={$data['parent_id']}";
        //执行sql语句
        $rs=$this->db->execute($sql);
        return $rs;
    }
    //查询管理员表
    public function admin($id){
        //写sql语句
        $sql="select * from admin where id={$id}";
        //执行
        $row=$this->db->fetchRow($sql);
        //返回值
        return $row;
    }
    //删除数据
    public function delete($id){
        //写sql语句
        $sql="update article set status=-1 where id={$id}";
        //执行
        $rs=$this->db->execute($sql);
        //返回值
        return $rs;
    }
    //修改回显
    public function edit($id){
        //写sql语句
        $sql="select * from article where id={$id}";
        //执行
        $row=$this->db->fetchRow($sql);
        //返回值
        return $row;
    }
    //修改
    public function edit_save($data){
//        判断是否修改图片
        if(array_key_exists('logo',$data)===false){
            //写sql语句
            $time=time();
            $sql="update article set `name`='{$data['name']}',`desc`='{$data['desc']}',user_id='{$data['user_id']}',update_time='{$time}',status='{$data['status']}' where id={$data['id']}";
            //执行sql语句
            $rs=$this->db->execute($sql);
            return $rs;
        }else{
            $time=time();
          //写sql语句
            $sql="update article set `name`='{$data['name']}',`desc`='{$data['desc']}',user_id='{$data['user_id']}',update_time='{$time}',logo='{$data['logo']}',status='{$data['status']}' where id={$data['id']}";
            //执行sql语句
            $rs=$this->db->execute($sql);
            return $rs;
        }
    }
    //查询分类列表
    public function coll(){
        //写sql语句
        $sql="select `id`,`name` from category";
        //执行sql语句
        $rows=$this->db->fetchAll($sql);
        //返回值
        return $rows;
    }
}