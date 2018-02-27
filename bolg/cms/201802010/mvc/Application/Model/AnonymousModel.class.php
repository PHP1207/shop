<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/19 0019
 * Time: 15:15
 */
class AnonymousModel extends Model
{
    public function getRow(){
        $sql_count="select count(*) from anonymous";
        //执行
        $num=$this->db->fetchColumn($sql_count);
//        var_dump($num);die;
        return $num;
    }
   //查询所有评论信息
    public function getAll($id){
       //查询评论条数
        //查询所有的评论内容
        $where='';
        if(!empty($id)){
            $where=" where art_id={$id}";
        }
        $sql="select * from anonymous $where";
        //执行
        $rows=$this->db->fetchAll($sql);
        return $rows;
    }
    //添加评论
    public function add_save($data){
//        var_dump($data);die;
        if($data['nickname']==''){
            $this->error='评论名称不能为空!';
            return false;
        }
        if($data['niming']==''){
            $this->error='是否匿名不能为空!';
            return false;
        }
        if($data['anony']==''){
            $this->error='评论内容不能为空!';
            return false;
        }
        $time=time();
        //写sql语句
        $sql="insert into anonymous set nickname='{$data['nickname']}',niming='{$data['niming']}',`time`='{$time}',art_id='{$data['art_id']}',`anony`='{$data['anony']}'";
        //执行sql语句
        $rs=$this->db->execute($sql);
        //返回值
        return $rs;
    }
    //显示文章
    public function add(){
        //写sql语句
        $sql="select * from article where status=1";
        //执行
        $rows=$this->db->fetchAll($sql);
        //返回值
        return $rows;
    }
    //查询文章标题
    public function art($id){
        //写sql语句
        $sql="select `name` from article where id='{$id}'";
        //执行
        $rows=$this->db->fetchRow($sql);
        //返回值
        return $rows;
    }
    //删除
    public function delete($id){
        //写sql语句
        $sql="delete from anonymous where com_id={$id}";
        //执行
        $rs=$this->db->execute($sql);
        //返回
        return $rs;
    }
    //查询评论数
    public function row($art_id){
        //写sql语句
        $sql="select `comment` from article where id={$art_id}";
        //执行
        $comment=$this->db->fetchColumn($sql);
        //返回值
        return $comment;
    }
    //添加评论次数
    public function comment($id,$comment){
        //写sql语句
        $sql="update article set comment=$comment+1 where id={$id}";
        //执行
        $this->db->execute($sql);
    }
}