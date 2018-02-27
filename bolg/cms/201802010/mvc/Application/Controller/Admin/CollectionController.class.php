<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/21 0021
 * Time: 13:55
 */
class CollectionController extends PlatformController
{
    //显示页面
    public function index(){
        //接收数据
        //处理数据
        $collection=new CollectionModel();
        $rows=$collection->getAll();
        foreach ($rows as $key=>$v){
            $coll=new CollectionModel();
            $row=$coll->art($v['art_id']);
//            var_dump($row);
            $rows[$key]['art_name']=$row['name'];
        }
        foreach ($rows as $key=>$val){
            $colle=new CollectionModel();
            $adm=$colle->adm($val['ad_id']);
            $rows[$key]['ad_name']=$adm['username'];
        }
        //分配数据
        $this->assign('rows',$rows);
        //显示页面
        $this->display('index');
    }
    //删除
    public function delete(){
        //接收数据
        $id=$_GET['id'];
        //处理数据
        $delete=new CollectionModel();
        $rs=$delete->delete($id);
        //显示页面
        self::redirect('index.php?p=Admin&c=Collection&a=index');
    }
}