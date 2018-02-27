<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/21 0021
 * Time: 20:44
 */
class FrontController extends Controller
{
   //显示首页
    public function index(){
        //接受数据
        $data=$_REQUEST;
        $status=[];
        if(!empty($data['name'])){
            $status[]="name='{$data['name']}'";
        }
        unset($_REQUEST['page']);
        $url_name=http_build_query($_REQUEST);
        //处理数据
        //查询最新的十篇文章
        $art=new FrontModel();
        $val=$art->art();
        //截取前最新的位中最小的
        $v=array_pop($val);
        //查询出最新的十篇文章
        $page=$_GET['page']??1;
        $article=new FrontModel();
        $art_icle=$article->index($v,$page,$status);
        $art_icle['url_name']=$url_name;
        extract($art_icle);
        //分配最新发布的十篇文章数据
        $this->assign($art_icle);
        //查询文章分类
        $category=new FrontModel();
        $rows=$category->cate();
        //分配数据
        $this->assign('rows',$rows);
        //查询评论数量拍前十的文章
        $anony=new FrontModel();
        $nu=$anony->anony();
//        var_dump($nu);die;
       $num=array_pop($nu);
//       var_dump($num);die;
        $anony_art=new FrontModel();
       $anon=$anony_art->anony_art($num);
//       var_dump($anon);die;
       //分配数据
        $this->assign('anon',$anon);
        //查询收藏数量前十的文章
        $collection=new FrontModel();
        $n=$collection->collection();
//        var_dump($n);die;
        $collect=new FrontModel();
        $collec=$collect->collect($n);
//        var_dump($value);die;
        //分配数据
        $this->assign('collec',$collec);
        //显示页面
        $this->display('index');
    }
   //查询所有分类下的文章
    public function category(){
        //接收数据
        $id=$_GET['id'];
        $page=$_GET['page']??1;
        $data=$_REQUEST;
        //定义一个空数组保存搜索的内容
        $sta=[];
        if(!empty($data['name'])){
            $sta[]="`name`='{$data['name']}'";
        }
        unset($_REQUEST['page']);
        $url_name=http_build_query($_REQUEST);
        //处理数据
        $category=new FrontModel();
        $category_list=$category->category($id,$sta,$page);
        $category_list['url_name']=$url_name;
        extract($category_list);
        //分配数据
        $this->assign($category_list);
        //显示页面
        $this->display('category');
    }
}