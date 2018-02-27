<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/11 0011
 * Time: 21:47
 */
class CaptchaController
{
    public function captcha(){
        //生成随机字符串
        $str="23456789QWERTYUIOPASDFGHJKLZXCVBNM";
//随机打乱字符串
        $string=str_shuffle($str);
//随机截取
        $str1=substr($string,0,4);
//保存session
        @session_start();
        $_SESSION['yan']=$str1;
//创建画布
        $wdith=100;
        $hegit=35;
//创建画布
        $image=imagecreatetruecolor($wdith,$hegit);
//选择颜色
        $color=imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
//填充颜色
        imagefill($image,0,0,$color);
//混淆验证码
        for ($i=1;$i<=200;$i++){
            $cr=imagecolorallocate($image,mt_rand(100,255),mt_rand(100,255),mt_rand(100,255));
            imagesetpixel($image,mt_rand(0,$wdith),mt_rand(0,$hegit),$cr);
        }
        for($i=1;$i<=5;$i++){
            $cr=imagecolorallocate($image,mt_rand(10,55),mt_rand(10,55),mt_rand(10,55));
            imageline($image,mt_rand(0,$wdith),mt_rand(0,$hegit),mt_rand(0,$wdith),mt_rand(0,$hegit),$cr);
        }
//写字
//准备字体颜色
        $c=imagecolorallocate($image,mt_rand(10,50),mt_rand(10,50),mt_rand(10,50));
//写字
        imagestring($image,5,$wdith/2.8,$hegit/3,$str1,$c);
//上传图片
        header('Content-Type: image/jpeg');
        imagejpeg($image);
//销毁
        imagedestroy($image);

    }
}