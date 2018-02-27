<?php

/**
 *评论功能
 */
class AnonymousController extends Controller
{
    //显示评论列表
    public function index(){
        //接收数据
        $id=$_GET['id']??'';
        //处理数据
        $anony_conut=new AnonymousModel();
        $count=$anony_conut->getRow();
        $this->assign('count',$count);

        $add=new AnonymousModel();
        $row=$add->add();
        $this->assign('row',$row);
//        var_dump($row);die;
        $anony=new AnonymousModel();
        $rows=$anony->getAll($id);
        //显示页面
         foreach($rows as &$v){
             $reply=new ReplyModel();
             $ro=$reply->getAll($v['com_id']);
             $v['reply']=$ro;
         }
        $this->assign('rows',$rows);
        $this->display('index');
    }
    //添加
    public function add(){
//        var_dump($_POST);
            //接收数据
            $data=$_POST;
            //处理数据
            $add_save=new AnonymousModel();
            $rs=$add_save->add_save($data);
            //显示页面
          if($rs===false){
              self::redirect('index.php?p=Home&c=Anonymous&a=index',$add_save->getError(),3);
          }
        //添加评论次数
        $com=new AnonymousModel();
        $num=$com->row($data['art_id']);
        $comment=new AnonymousModel();
        $comment->comment($data['art_id'],$num);
          self::redirect('index.php?p=Home&c=Anonymous&a=index','评论成功',3);
    }
}