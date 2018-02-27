<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/19 0019
 * Time: 22:48
 */
class AnonymousController extends PlatformController
{
   //显示列表
    public function index(){
        $id=$_GET['id']??'';
        //处理数据
        $anony=new AnonymousModel();
        $rows=$anony->getAll($id);
        foreach ($rows as $key=>$v){
            $anony_art=new AnonymousModel();
//            var_dump($v);die;
            $row=$anony_art->art($v['art_id']);
            $rows[$key]['name']=$row['name'];
        }
        //分配数据
        $this->assign('rows',$rows);
        //显示页面
        $this->display('index');
    }
    //删除功能
    public function delete(){
      //接收数据
        $id=$_GET['id'];
      //处理数据
        $del=new AnonymousModel();
        $rs=$del->delete($id);
        if($rs===false){
            self::redirect('index.php?p=Admin&c=Anonymous&a=index','删除失败!',3);
        }
        self::redirect('index.php?p=Admin&c=Anonymous&a=index');
    }
}