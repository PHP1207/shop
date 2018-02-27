<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/20 0020
 * Time: 22:19
 */
class CategoryController extends PlatformController
{
     //显示分类列表
    public function index(){
        //接收数据
        //处理数据
//        $catgory=new CategoryModel();
//        $rows=$catgory->getAll();
        //显示页面
        $getList=new CategoryModel();
        $rows=$getList->getList();
//        var_dump($categoryList_new);die;
        //分配数据
//        var_dump($rows);die;
        $this->assign('rows',$rows);
        //显示页面
        $this->display('index');
    }
    //添加分类功能
    public function add(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //接收数据
            $data=$_POST;
//            var_dump($_POST);die;
            //处理数据
            $add=new CategoryModel();
           $rs=$add->add_save($data);
            //显示页面
            if($rs===false){
                self::redirect('index.php?p=Admin&c=Category&a=add',$add->getError(),3);
            }
            self::redirect('index.php?p=Admin&c=Category&a=index');
        }else{
            //接收数据
            //处理数据
            $getList=new CategoryModel();
           $categoryList_new=$getList->getList();
            //显示页面
            //分配数据
            $this->assign('categoryList_new',$categoryList_new);
            $this->display('add');
        }
    }
    //删除分类记录
    public function delete(){
        //接收数据
        $id=$_GET['id'];
//        var_dump($id);die;
        //处理数据
        $del=new CategoryModel();
        $rs=$del->delete($id);
        //显示页面
        if($rs===false){
            self::redirect('index.php?p=Admin&c=Category&a=index','删除失败',3);
        }
        self::redirect('index.php?p=Admin&c=Category&a=index');
    }
    //修改和回显功能
    public function edit(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
             //接收数据
            $data=$_POST;
            //处理数据
            $edit_save=new CategoryModel();
            $rs=$edit_save->edit_save($data);
            //显示页面
            if($rs===false){
                self::redirect('index.php?p=Admin&c=Category&a=edit&id='.$data['id'],$edit_save->getError(),3);
            }
            self::redirect('index.php?p=Admin&c=Category&a=index');
        }else{
            //接收数据
            $id=$_GET['id'];
//            var_dump($id);die;
            //处理数据
            $edit=new CategoryModel();
            $row=$edit->edit($id);
            //分配数据
            $this->assign($row);
//            var_dump($row);die;
            //显示页面
           $this->display('edit');
        }
    }
}