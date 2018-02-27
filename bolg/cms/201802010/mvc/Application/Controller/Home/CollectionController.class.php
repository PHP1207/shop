<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/22 0022
 * Time: 14:50
 */
class CollectionController extends Controller
{
   //添加收藏
    public function add(){
        //接收数据
        $id=$_GET['id'];
        //处理数据
        $add=new CollectionModel();
        $rows=$add->add($id);
        $add_save=new CollectionModel();
        $rs=$add_save->add_save($rows);
        //显示页面
        if($rs===false){
            self::redirect('index.php?p=Home&c=Front&a=index','收藏不成功!',3);
        }
        $Collection=new CollectionModel();
        $num=$Collection->collection($id);
        $coll=new CollectionModel();
//        var_dump($id);die();
        $coll->coll($id,$num);
        self::redirect('index.php?p=Home&c=Front&a=index');
    }
}