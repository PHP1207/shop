<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/12 0012
 * Time: 22:15
 */
class ArticleController extends PlatformController
{
    //显示页面
    public function index(){
//        var_dump($_POST);
        //接收数据
        $data=$_REQUEST;
        $sta=[];
        $page=$_REQUEST['page']??1;
//        var_dump($sta);die;
        if(!empty($data['name'])){
            $sta[]="name='{$data['name']}'";
        }
        unset($_REQUEST['page']);
        $url_name=http_build_query($_REQUEST);
        //处理数据
        $article=new ArticleModel();
        $rows=$article->getAll($sta,$page);
        $rows['url_name']=$url_name;
//        var_dump($rows);die;
        foreach ($rows['list'] as $key=>&$v){
            $article_admin=new ArticleModel();
            $row=$article_admin->admin($v['user_id']);
//            var_dump($row);die;
            $rows['username']=$row['username']??'';
//            var_dump($rows[$key]['username']);die;
        }
//        var_dump($rows);die;
        extract($rows);
        //显示页面
        //分配数据
//        var_dump($rows);die;
        $this->assign($rows);
        $this->display('index');
    }
    //添加和显示添加表单
    public function add(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
             //接收数据
            $data=$_POST;
//            var_dump($data);die;
            //上传图片
            $upload=new UploadTool();
            $logo=$upload->upload($_FILES['logo'],'article');
            //赋值
            $data['logo']=$logo;
            //制作缩略图
            $image=new ImageTool();
            $img=$image->thumb($data['logo'],50,50);
            $data['logo']=$img;
            //处理数据
            $add=new ArticleModel();
            $rs=$add->add_save($data);
            //显示页面
            if($rs===false){
                self::redirect('index.php?p=Admin&c=Article&a=add',$add->getError(),3);
            }
            self::redirect('index.php?p=Admin&c=Article&a=index');
        }else{
            //接收数据
            //处理数据
            $categoryList_new=new CategoryModel();
            $categoryList_new=$categoryList_new->getList();
            $this->assign('categoryList_new',$categoryList_new);
            $add=new ArticleModel();
            $row=$add->add();
            //分配数据
//            var_dump($row);die();
            $this->assign('row',$row);
            //显示页面
            $this->display('add');
        }
    }
    //删除功能
    public function delete(){
        //接收数据
        $id=$_GET['id'];
//        var_dump($id);die;
        //处理数据
        $del=new ArticleModel();
       $rs=$del->delete($id);
        //显示页面
        if($rs===false){
            self::redirect('index.php?p=Admin&c=Article&a=index','删除失败!',3);
        }
        self::redirect('index.php?p=Admin&c=Article&a=index');
    }
    //修改功能
    public function edit(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //接收数据
//            var_dump($_FILES);
            $data=$_POST;
//            echo 1;die;
//            var_dump($data);die();
            if($_FILES['logo']['error']==0){
                //上传图片
                $upload=new UploadTool();
                $logo=$upload->upload($_FILES['logo'],'article');
                //赋值
                $data['logo']=$logo;
                //制作缩略图
                $image=new ImageTool();
                $img=$image->thumb($data['logo'],50,50);
                //赋值
                $data['logo']=$img;
            }
           //处理数据
            $edit_save=new ArticleModel();
            $rs=$edit_save->edit_save($data);
            //显示页面
            if($rs===false){
                self::redirect('index.php?p=Admin&c=Article&a=edit&id='.$data['id'],$edit_save->getError(),3);
            }
            self::redirect('index.php?p=Admin&c=Article&a=index');
        }else{
            //接收数据
            $id=$_GET['id'];
            //处理数据
            $edit=new ArticleModel();
            $row=$edit->edit($id);
            //显示页面
//            var_dump($row);die();
            $this->assign($row);
            $add=new ArticleModel();
            $rows=$add->add();
            //分配数据
//            var_dump($row);die();
            $this->assign('rows',$rows);
            $categoryList_new=new CategoryModel();
            $categoryList_new=$categoryList_new->getList();
            $this->assign('categoryList_new',$categoryList_new);
            $this->display('edit');
        }
    }
}