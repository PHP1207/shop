<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/20 0020
 * Time: 22:19
 */
class CategoryModel extends Model
{
    //查询所有数据
    public function getAll(){
        //写sql语句
        $sql="select * from category";
        //执行sql语句
        $row=$this->db->fetchAll($sql);
        //返回数据
        return $row;
    }
    //添加数据
    public function add_save($data){
        if($data['name']==''){
            $this->error='分类名称不能为空!';
            return false;
        }
        if($data['cenetn']==''){
            $this->error='分类详情不能为空!';
            return false;
        }
        $is_show=$data['is_show']??0;
        //写sql语句
        $sql="insert into category set `name`='{$data['name']}',cenetn='{$data['cenetn']}',is_show='{$is_show}',parent_id='{$data['parent_id']}'";
        //执行sql语句
        $rs=$this->db->execute($sql);
        //返回值
        return $rs;
    }
    //删除数据
    public function delete($id){
        //写sql语句
        $sql="delete from category where id={$id}";
        //执行sql语句
        $rs=$this->db->execute($sql);
        //返回数据
        return $rs;
    }
    //修改回显
    public function edit($id){
        //写sql语句
        $sql="select * from category where id={$id}";
        //执行sql语句
        $row=$this->db->fetchRow($sql);
        //返回值
        return $row;
    }
    //修改保存
    public function edit_save($data){
        if($data['name']==''){
            $this->error='分类名称不能为空!';
            return false;
        }
        if($data['cenetn']==''){
            $this->error='分类详情不能为空!';
            return false;
        }
        $is_show=$data['is_show']??0;
        //写sql语句
        $sql="update category set `name`='{$data['name']}',cenetn='{$data['cenetn']}',is_show='{$is_show}' where id={$data['id']}";
       //执行sql语句
        $rs=$this->db->execute($sql);
        //返回值
        return $rs;
    }
    public function getList($parent_id=0){
        //1.准备sql语句
        $sql = "select * from category";
        //2.执行sql语句
        $categoryList = $this->db->fetchAll($sql);

        //排序
        $categoryList_new = $this->getChildren($categoryList,$parent_id);
//            var_dump($categoryList_new);
        //3.返回
        return $categoryList_new;
    }
    /**
     * 找儿子的方法
     * @param $categoryList 所有的数据
     * @param $parent_id 要找哪个分类的儿子，传入对于分类的id
     * @param $deep 层级
     * @return  返回对应分类的子孙分类
     */
    private function getChildren(&$categoryList,$parent_id,$deep=0){
        static $children = [];//保存找到的儿子
        //循环所有的数据，比对每条数据中的parent_id,如果等于传入的$parent_id说明儿子找到了
        foreach ($categoryList as $child){
            if($child['parent_id'] == $parent_id){
                $child['name_txt'] = str_repeat("&emsp;",$deep*2).$child['name'];//保存有缩进的名称
                $children[] = $child;
//                var_dump($children);
                $this->getChildren($categoryList,$child['id'],$deep+1);
            }
        }
        //返回找到的儿子
        return $children;
    }

}