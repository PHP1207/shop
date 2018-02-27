<?php

/**
 *完成管理员的crud
 */
class AdminController extends PlatformController
{
    //显示管理员列表
    public function index(){
        //接收数据
        $status=[];
        $page=$_REQUEST['page']??1;
        if(!empty($_REQUEST['username'])){
            $status[]="username='{$_REQUEST['username']}'";
        }
        if(!empty($_REQUEST['email'])){
            $status[]="email='{$_REQUEST['email']}'";
        }
        if(!empty($_REQUEST['status'])){
            $status[]="status&'{$_REQUEST['status']}'";
        }
        unset($_REQUEST['page']);
        $url_name=http_build_query($_REQUEST);
        //处理数据
        $adminModel=new AdminModel();
        $rows=$adminModel->getAll($status,$page);
        $rows['url_name']=$url_name;
//        var_dump($rows);die;
        extract($rows);
        //显示页面
//        var_dump($rows);
        $this->assign($rows);
        $this->display('index');
    }
    //添加管理员
    public function add(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
//           var_dump($_POST);
            //接收数据
            $data=$_POST;
            //处理数据
            //制作图片
            $upload=new UploadTool();
            $logo=$upload->upload($_FILES['logo'],'admin');
            //赋值
            $data['logo']=$logo;
            //制作缩略图
            $img=new ImageTool();
            $image=$img->thumb($data['logo'],100,100);
            $data['logo']=$image;
            $adminModel=new AdminModel();
            $rs=$adminModel->add_save($data);
            //显示页面
            if($rs===false){
                self::redirect('index.php?p=Admin&c=Admin&a=add',$adminModel->getError(),3);
            }
            self::redirect('index.php?p=Admin&c=Admin&a=index');
        }else{
            //接收数据
            //处理数据
            //显示页面
            $this->display('add');
        }
    }
    //删除
    public function delete(){
        //接收数据
        $id=$_GET['id'];
        //处理数据
        $delete=new AdminModel();
        $delete->del($id);
        //显示页面
        self::redirect('index.php?p=Admin&c=Admin&a=index');
    }
    //修改
    public function edit(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //接收数据
              $data=$_POST;
            //处理数据
             if($_FILES['logo']['error']==0){
                 $upolad=new UploadTool();
                 $logo=$upolad->upload($_FILES['logo'],'admin');
                 //赋值
                 $data['logo']=$logo;
                 //制作缩略图
                 $img=new ImageTool();
                 $image=$img->thumb($data['logo'],100,100);
                 //赋值
                 $data['logo']=$image;
             }
             $edit_save=new AdminModel();
             $rs=$edit_save->edit_save($data);
            //显示页面
            if($rs===false){
                self::redirect('index.php?p=Admin&c=Admin&a=edit&id='.$data['id'],$edit_save->getError(),3);
            }
//            echo 1;die;
            self::redirect('index.php?p=Admin&c=Admin&a=index');
        }else{
            //接收数据
            $id=$_GET['id'];
            //处理数据
            $edit=new AdminModel();
            $row=$edit->edit($id);
            //显示页面
            $this->assign($row);
            $this->display('edit');
        }
    }
    //显示个人资料
    public function per(){
        //接收数据
        //处理数据
        //显示页面
        $this->display('per');
    }
    public function edit_save(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //接收数据
            $data=$_POST;
            //处理数据
            if($_FILES['logo']['error']==0){
                $upolad=new UploadTool();
                $logo=$upolad->upload($_FILES['logo'],'admin');
                //赋值
                $data['logo']=$logo;
                //制作缩略图
                $img=new ImageTool();
                $image=$img->thumb($data['logo'],100,100);
                //赋值
                $data['logo']=$image;
            }
            $edit_save=new AdminModel();
            $rs=$edit_save->edit_save($data);
//            echo 1;die;
            //显示页面
            if($rs===false){
                self::redirect('index.php?p=Admin&c=Admin&a=edit_save&id='.$data['id'],$edit_save->getError(),3);
            }
            self::redirect('index.php?p=Admin&c=Login&a=logut');
        }else{
//            var_dump($_SESSION);die;
            //接收数据
            @session_start();
            $id=$_SESSION['user']['id'];
            //处理数据
            $edit=new AdminModel();
            $row=$edit->edit($id);
            //显示页面
            $this->assign($row);
            $this->display('edit_save');
        }
    }
}