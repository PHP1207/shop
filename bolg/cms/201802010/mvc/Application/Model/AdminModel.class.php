<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/10 0010
 * Time: 21:24
 */
class AdminModel extends Model
{
   //查询所有的用户信息
    public function getAll($status,$page){
//        var_dump($status);die;
        $where='';
        if(!empty($status)){
//            echo 1;die;
            $where=' where '.implode(' and ',$status);
        }
        //每页显示多少条
        $pageSize=2;
        //求总记录数
         $sql_count="select count(*) from admin  $where";
         //执行
       $count=$this->db->fetchColumn($sql_count);
//       var_dump($count);die;
        //总页数
        $totalPage =ceil($count/$pageSize);
        $sta=($page-1)*$pageSize;
        $page<1?1:$page;
        $page>$totalPage?$totalPage:$page;
        $limit=" limit $sta,$pageSize ";
        //写sql语句
        $sql="select * from admin $where $limit";
        //执行
       $rows=$this->db->fetchAll($sql);
        return ['list'=>$rows,'count'=>$count,'page'=>$page,'pageSize'=>$pageSize,'totalPage'=>$totalPage];
    }
    //添加保存
    public function add_save($data){
        //判断用户名不能为空
        if(empty($data['username'])){
            $this->error='用户名不能为空!';
            return false;
        }
        //判断昵称不能为空
        if(empty($data['nickname'])){
            $this->error='昵称不能为空!';
            return false;
        }
        //判断邮箱不能为空
        if(empty($data['email'])){
            $this->error='邮箱不能为空!';
            return false;
        }
        //判断两次密码是否一致
        if($data['password']!=$data['pwd']){
            $this->error='两次密码不一致!';
            return false;
        }
        //定义一个变量于状态值
        $status=0;
        foreach ($data['status'] as $v){
            $status=$status | $v;
        }
        $password=md5($data['password']);
        $time=time();
        //写sql
        $sql="insert into admin set username='{$data['username']}',nickname='{$data['nickname']}',email='{$data['email']}',status='{$status}',password='{$password}',logo='{$data['logo']}',add_time='{$time}'";
        //执行
       return $this->db->execute($sql);
    }
    //删除=
    public function del($id){
        //写sql语句
        $sql="delete from admin where id={$id}";
        //执行
        $this->db->execute($sql);
    }
    //修改回显
    public function edit($id){
        //写sql
        $sql="select * from admin where id={$id}";
        //执行sql
        $row=$this->db->fetchRow($sql);
        return $row;
    }
    //修改保存
    public function edit_save($data){
//        var_dump($data);die;
        if($data['password']!=''){
            $sql="select `password` from admin where id={$data['id']}";
            //执行
            $row=$this->db->fetchColumn($sql);
            $Password=md5($data['password']);
            if($Password!=$row){
                $this->error='新旧密码错误!';
                return false;
            }
            if ($data['newPwd']!=$data['pwd']){
                $this->error='两次密码不正确!';
                return false;
            }
             if($_FILES['logo']['error']==4){
                 $status=0;
                 foreach ($data['status'] as $v){
                     $status=$status | $v;
                 }
                 $newPwd=md5($data['newPwd']);
                 $time=time();
                 //写sql语句
                 $sql="update admin set username='{$data['username']}',nickname='{$data['nickname']}',email='{$data['email']}',status='{$status}',password='{$newPwd}',update_time='{$time}' where id={$data['id']}";
                 //执行
                 return $this->db->execute($sql);
             }else{
                 $status=0;
                 foreach ($data['status'] as $v){
                     $status=$status | $v;
                 }
                 $newPwd=md5($data['newPwd']);
                 $time=time();
                 //写sql语句
                 $sql="update admin set username='{$data['username']}',nickname='{$data['nickname']}',email='{$data['email']}',status='{$status}',logo='{$data['logo']}',password='{$newPwd}',update_time='{$time}' where id={$data['id']}";
                 return $this->db->execute($sql);
             }
        }else{
            if($_FILES['logo']['error']==4){
                $status=0;
                foreach ($data['status'] as $v){
                    $status=$status | $v;
                }
                $time=time();
                //写sql语句
                $sql="update admin set username='{$data['username']}',nickname='{$data['nickname']}',email='{$data['email']}',status='{$status}',update_time='{$time}' where id={$data['id']}";
                return $this->db->execute($sql);
            }else{
                $status=0;
                foreach ($data['status'] as $v){
                    $status=$status | $v;
                }
                $time=time();
                //写sql语句
                $sql="update admin set username='{$data['username']}',nickname='{$data['nickname']}',email='{$data['email']}',status='{$status}',logo='{$data['logo']}',update_time='{$time}' where id={$data['id']}";
                return $this->db->execute($sql);
            }
        }
    }
    //验证登录信息
    public function chexd($data){
        @session_start();
        if(strtoupper($_SESSION['yan'])!=strtoupper($data['captcha'])){
            $this->error='验证码错误!';
            return false;
        }
        //写sql语句
        $sql="select * from admin where username='{$data['username']}'";
        //执行
        $row=$this->db->fetchRow($sql);
//        echo 1;
//        var_dump($row);die;
        if(!isset($row)){
            $this->error='用户名错误!';
            return false;
        }
        $password=md5($data['password']);
        if($row['password']!=$password){
            $this->error='密码错误!';
            return false;
        }
        @session_start();
        $_SESSION['user']=$row;
        //写sql
        if(array_key_exists('rember',$data)===true){
//            var_dump($row['id']);die;
            $id=$row['id'];
               setcookie('id',$id,time()+24*7*3600,'/');
               setcookie('password',md5($row['password'].'lijizheng'),time()+24*7*3600,'/');
        }
//        var_dump($_SERVER['SERVER_ADDR']);die;
        $ip=ip2long($_SERVER['SERVER_ADDR']);
//        var_dump($ip);die;
        $time=time();
//        var_dump($time);
//        var_dump($ip);die;
        $sql="update admin set login_last_ip='{$ip}',login_last_time='{$time}' where id={$row['id']}";
        //执行
        $this->db->execute($sql);
        return $row;
    }
    //验证自动登录
    public function cookie($id,$password){
        var_dump($id);
//        var_dump($password);
        //写sql语句
        $sql="select * from admin where id={$id}";
//        echo 2;
//        var_dump($sql);die;
        //执行
        $row=$this->db->fetchRow($sql);
        if (!isset($row)){
            $this->error='用户id不存在!';
            return false;
        }
        $pwd=md5($row['password'].'lijizheng');
//        var_dump($pwd);die;
        if($pwd!=$password){
            $this->error='密码错误!';
            return false;
        }
        @session_start();
        $_SESSION['user']=$row;
        return $row;
    }
}