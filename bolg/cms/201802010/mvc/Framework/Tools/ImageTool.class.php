<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/1 0001
 * Time: 19:35
 */
class ImageTool
{
    //私有属性保存错误信息
    private $error;
    //返回信息
    public function getError(){
        return $this->error;
    }
    //制作缩略图

    /**
     * @param
     * @param $thumb_wdith
     * @param $thumb_hegthi
     * @return 返回图片路径
     */
    public function thumb($src,$thumb_wdith,$thumb_hegthi){
//        var_dump($src);
        if(!is_file($src)){
            $this->error='图片原图为空!';
            return false;
        }
//        $mim=explode();

        //获取原图的宽高
        $kuanao=getimagesize("{$src}");
//        var_dump($kuanao['mime']);

        list($src_wdith,$src_hegith)=$kuanao;
        //得到原图的mime类型
        $mime=$kuanao['mime'];
        //拼接方法名
        $suxxff=explode('/',$mime)[1];
        $fun='imagecreatefrom'.$suxxff;
//        var_dump($fun);
        //可变方法名,方法在使用的时候名称可以使用一个变量来代替
        $src_image=$fun($src);
        //创建新图
        $thumb_image=imagecreatetruecolor($thumb_wdith
        ,$thumb_hegthi);
        //选择颜色将图片不白
        $color=imagecolorallocate($thumb_image,255,255,255);
        //填充颜色
        imagefill($thumb_image,0,0,$color);
        //将原图放到新图上
          //等比例缩放
        $num=max($src_wdith/$thumb_wdith,$src_hegith/$thumb_hegthi);
          //原图计算缩放后的宽高
        $a=$src_wdith/$num;
        $b=$src_hegith/$num;
          //合并
        imagecopyresampled($thumb_image,$src_image,($thumb_wdith-$a)/2,($thumb_hegthi-$b)/2,0,0,$a,$b,$src_wdith,$src_hegith);
        //上传图片pathinfo
//       pathinfo($src);

        $thumb_path='image'.$suxxff;
        //获取文件路径信息
        $info=pathinfo($src);
        //得到保存路径
        $Url=$info['dirname'].'/'.$info['filename'].$thumb_wdith."x".$thumb_hegthi.'.'.$info['extension'];
        $thumb_path($thumb_image,$Url);
        //销毁图片
        imagedestroy($thumb_image);
        imagedestroy($src_image);
        //将路径返回
        return $Url;
    }
}