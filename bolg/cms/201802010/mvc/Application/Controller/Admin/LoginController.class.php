<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/11 0011
 * Time: 21:10
 */
class LoginController extends Controller
{
    //显示登录页面
    public function login(){
        //接收数据
        //处理数据
        //显示页面
        $this->display('login');
    }
    //验证登录信息
    public function chexd(){
        //接收数据
//        var_dump($_POST);die;
        $data=$_POST;
        //处理数据
        $chexd=new AdminModel();
        $rs=$chexd->chexd($data);
        //显示页面
        if ($rs===false){
            self::redirect('index.php?p=Admin&c=Login&a=login',$chexd->getError(),3);
        }
        self::redirect('index.php?p=Admin&c=Admin&a=per');
    }
    //退出功能
    public function logut(){
       @session_start();
       unset($_SESSION['user']);
       setcookie('id',null,-1,'/');
       setcookie('password',null,-1,'/');
       self::redirect('index.php?p=Admin&c=Login&a=login');
    }
}