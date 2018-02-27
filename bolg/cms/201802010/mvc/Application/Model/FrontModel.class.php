<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/21 0021
 * Time: 20:45
 */
class FrontModel extends Model
{
    //查询最新的十篇文章最先发部的一篇
    public function art(){
        //写sql语句
        $sql="select `add_time` from article";
        //执行
        $ar=$this->db->fetchAll($sql);
        foreach ($ar as $value){
//            var_dump($value);
            $val[]=$value['add_time'];
        }
        rsort($val);
//        var_dump($val);
        //循环取出数组中最大的十个值
        for($i=0;$i<=9;$i++){
            $v[]=$val[$i];
        }
//        var_dump($v);die;
        return $v;
    }
    //查询最新的十篇文章
    public function index($v,$page,$status){
//        var_dump($status);
        //每页显示多少条
       $where = "where add_time>={$v}   ";
       if(!empty($status)){
           $where=$where.' and '.implode(' and ',$status);
       }

        $pageSize=3;
        //总记录数
        //写查询总记录数的sql
        $sql_count="select count(*) from article  $where";
        //执行
        $count=$this->db->fetchColumn($sql_count);
//        var_dump($count);die;
        //总页数
        $totalPage=ceil($count/$pageSize);
        $page<1?1:$page;
        $page>$totalPage?$totalPage:$page;
        //每页显示多少条
        $sta=($page-1)*$pageSize;
//        var_dump($sta);die;
        $limit=" limit $sta,$pageSize";
        //写sql语句
        $sql="select * from article $where $limit";
//        var_dump($sql);die;
        //执行sql语句
        $art_icle=$this->db->fetchAll($sql);
//        var_dump($art_icle);die;
        //返回值
        //返回值
        return ['list'=>$art_icle,'count'=>$count,'page'=>$page,'pageSize'=>$pageSize,'totalPage'=>$totalPage];
    }
    //查询出所有的文章分类
    public function cate(){
        //写sql语句
        $sql="select * from category where is_show=1";
        //执行sql语句
        $rows=$this->db->fetchAll($sql);
        //返回值
        return $rows;
    }
    //查询出所有分类下面的文章
    public function category($id,$sta,$page){
        $where ="where category_id={$id}";
        if(!empty($sta)){
            $where=$where.' and '.implode(' and ',$sta);
        }
        //每页显示多少条
        $pageSize=3;
        //获取总记录数
        //写sql语句
        $sql_count="select count(*) from article $where";
        //执行sql语句
        $count=$this->db->fetchColumn($sql_count);
        //获取总页数
        $totalPage=ceil($count/$pageSize);
        //获取当前页数
        $stau=($page-1)*$pageSize;
        //判断$page
        $page<1?1:$page;
        $page>$totalPage?$totalPage:$page;
        //写limit字句
        $limit=" limit $stau,$pageSize";
        //写sql语句
        $sql="select * from article $where $limit";
//        var_dump($sql);
        //执行
        $category_list=$this->db->fetchAll($sql);
        return ['list'=>$category_list,'count'=>$count,'page'=>$page,'pageSize'=>$pageSize,'totalPage'=>$totalPage];

    }
    //查询文章评论数量排前十的文章
    public function anony(){
        //写sql语句
        $sql="select `comment` from article";
        //执行
        $num=$this->db->fetchAll($sql);
        foreach ($num as $value){
            $nu[]=$value['comment'];
        }
        rsort($nu);
        for($i=0;$i<=9;$i++){
            $v[]=$nu[$i];
        }
        //返回数据
        return $v;
    }
    //查询出
    public function anony_art($num){
        //写sql语句
        $sql="select * from article where comment>={$num}";
        //执行
        $anon=$this->db->fetchAll($sql);
        //返回
        return $anon;
    }
    //查询收藏数量前十的文章
    public function collection(){
        //写sql语句
        $sql="select `Collection` from article";
        //执行
        $rows=$this->db->fetchAll($sql);
        foreach ($rows as $row){
            $colle[]=$row['Collection'];
        }
        rsort($colle);
        for($i=0;$i<=9;$i++){
            $val[]=$colle[$i];
        }
        $value=array_pop($val);
        return $value;
    }
    public function collect($n){
        //写sql
        $sql="select * from article where Collection>={$n}";
        //执行
        $rows=$this->db->fetchAll($sql);
        //返回
        return $rows;
    }
}