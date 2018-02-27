<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/11 0011
 * Time: 22:45
 */
class PlatformController extends Controller
{
    public function __construct()
    {
        if(!isset($_SESSION['user'])){
            if(isset($_COOKIE['id']) && isset($_COOKIE['password'])){
                //接收数据
                //取出cookie里面的值
                $id=$_COOKIE['id'];
                $password=$_COOKIE['password'];
                //处理数据
                $cookie=new AdminModel();
                $rs=$cookie->cookie($id,$password);
                //显示页面
                if($rs===false){
                    self::redirect('index.php?p=Admin&c=Login&a=login',$cookie->getError(),3);
                }
                self::redirect('index.php?p=Admin&c=Admin&a=index');
            }
            self::redirect('index.php?p=Admin&c=Login&a=login');
        }
    }
}