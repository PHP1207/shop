<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/20 0020
 * Time: 10:35
 */
class ReplyModel extends Model
{
    //保存回复内容
    public function reply($data){
        $time=time();
        //写sql语句
        $sql="insert into reply set people='{$data['people']}',com_id='{$data['id']}',reply_time='{$time}',reply='{$data['reply']}'";
        //执行sql
        $rs=$this->db->execute($sql);
        //返回值
        return $rs;
    }
    //查询回复内容
    public function getAll($id){
        //写sql语句
        $sql="select * from reply where com_id={$id}";
        //执行sql语句
        $reply=$this->db->fetchAll($sql);
        //返回值
        return $reply;
    }
}