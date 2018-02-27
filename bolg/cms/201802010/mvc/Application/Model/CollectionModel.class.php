<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/21 0021
 * Time: 13:57
 */
class CollectionModel extends Model
{
    //查询所有数据
    public function getAll(){
        //写sql语句
        $sql="select * from collection where status=0";
        //执行sql语句
        $rows=$this->db->fetchAll($sql);
        //返回数据
        return $rows;
    }
    //删除
    public function delete($id){
        //写sql语句
        $sql="update collection set status=-1 where id={$id}";
        //执行sql语句
        $rs=$this->db->execute($sql);
        //返回值
        return $rs;
    }
    //添加收藏
    public function add($id){
        //写sql语句
        $sql="select * from article where id={$id}";
        //执行sql语句
        $rows=$this->db->fetchRow($sql);
        //返回值
        return $rows;
    }
    public function add_save($rows){
//        var_dump($rows);die;
        $time=time();
        //写sql语句
        $sql="insert into collection set art_id={$rows['id']},ad_id={$rows['user_id']},`time`={$time},status=0";
        //执行
        $rs=$this->db->execute($sql);
        //返回
        return $rs;
    }
    //查询收藏数量
    public function collection($id){
        //写sql语句
        $sql="select `Collection` from article where id={$id}";
        //执行
        $num=$this->db->fetchColumn($sql);
        //返回值
        return $num;
    }
    //修改收藏数量
    public function coll($id,$Collection){
        //写sql
        $sql="update article set Collection=$Collection+1 where id={$id}";
        //执行
        $this->db->execute($sql);
    }
    //根据id查询文章
    public function art($art_id){
        //写sql语句
        $sql="select `name` from article where id={$art_id}";
        //执行
        $rows=$this->db->fetchRow($sql);
        return $rows;
    }
    //查询用户
    public function adm($ad_id){
        //写sql语句
        $sql="select `username` from admin where id={$ad_id}";
        //执行
        $rows=$this->db->fetchRow($sql);
        return $rows;
    }
}