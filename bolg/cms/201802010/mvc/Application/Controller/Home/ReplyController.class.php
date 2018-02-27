<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/20 0020
 * Time: 10:35
 */
class ReplyController extends Controller
{
    //显示回复表单
    public function reply(){
       if($_SERVER['REQUEST_METHOD']=='POST'){
           //接受数控
           $data=$_POST;
           //处理数据
//           var_dump($data);die;
           $reply=new ReplyModel();
           $rs=$reply->reply($data);
           //显示页面
           if($rs===false){
               self::redirect('index.php?p=Home&c=Reply&a=reply','回复失败',3);
           }
           self::redirect('index.php?p=Home&c=Anonymous&a=index');
       }else{
           //接收数据
           $id=$_GET['id'];
//        var_dump($id);die;
           $row['id']=$id;
           //处理数据
           //分配数据
           $this->assign('row',$row);
           //显示页面
           $this->display('reply');
       }
    }
}