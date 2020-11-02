<?php
namespace Admin\Controller;
use Admin\Model\Page;
use Think\Controller;
class IndexController extends Controller{

    public function index(){
        if ($admin_name=session("admin_name")){
            $this->assign("admin_name",$admin_name);
            $userModel=M("user");
            $where =array("USERNAME"=> $admin_name,
            );
            if ($realPwd=$userModel->where($where)->getField('power')){
                if ($realPwd ==="M"){
                    $this->assign("admin",$admin_name);
                }
            }
        }
            $this->display();
    }
    //    登录
    public  function  login(){
        if (IS_POST){
            $u_code=strtolower($_POST['checkcode']);//转小写对比验证码
            if ($u_code===strtolower(session('checkcode'))){
                $adminModel =M("user");
                  $adminInfo = $adminModel->create();
                  $where =array("USERNAME"=> $adminInfo["USERNAME"],
                    );
                if ($realPwd=$adminModel->where($where)->find()){
                    //密码加盐验证
                    if ($realPwd['password'] ===md5($adminInfo["PASSWORD"].$realPwd['salt'])){
                        session('admin_name',$adminInfo['USERNAME']);
                        $this->success('用户合法，登陆中，请等待...',U('index'));
                        return;
                    }else{
                        $this->assign("error_in",'用户名或密码不正确，请重试！');
                    }
                }else{
                    $this->assign("error_in",'用户名或密码不正确，请重试！');
                }
            }else{
                $this->assign('error_code',"验证码输入错误!");
            }
        }
        $this->display();
    }
//    注册
    public function register(){
        if (IS_POST){
            $u_code=strtolower($_POST['checkcode']);//转小写对比验证码
            if ($u_code===strtolower(session('checkcode'))){
                $adminModel =M("user");
                $adminInfo = $adminModel->create();
                $where =array("USERNAME"=> $adminInfo["USERNAME"]);
                if ($realUser=$adminModel->where($where)->getField("USERNAME")){
                    $this->assign("error_in",'用户名注册失败，用户已存在！');
                }else{
                    $salt=date("YMdHis");//定义一个salt值，最好够长，或者随机
                    //$md_passwd= md5($password,$salt); //返回加salt后的散列
                    $adminInfo['PASSWORD']=md5($adminInfo['PASSWORD'].$salt);
                    $adminInfo['salt']=$salt;
                    if ($realUser =$adminModel->add($adminInfo)){
                        session('admin_name',$adminInfo['USERNAME']);
                        $this->success('用户注册成功，登陆中，请等待...',U('index'));
                        return;
                    }else{
                        $this->assign("error_in",'用户注册失败，请重试！');
                    }
                }
            }else{
                $this->assign('error_code',"验证码输入错误!");
            }
        }
        $this->display();
    }
    /* 退出登录 */
    public function logout(){
        $is_login=session('admin_name');
        if(!empty($is_login)){
            session('admin_name',null);
            $this->success('退出成功！', U('index'));
        } else {
            $this->redirect('index');
        }
    }
//    验证码
    public function vcode(){
//        验证码宽高及长度等参数
        $img_w=78;
        $img_h=30;
        $char_len =5;
        $font =5;
        $char = array_merge(range('A','Z'),range('a','z'),range(1, 9));
        $rand_keys = array_rand($char,$char_len);//array_rand($array,$lenth)返回键名(即数组下标)
        shuffle($rand_keys);
        $code='';
        foreach($rand_keys as $key){
            $code .=$char[$key];
        }
        //将验证码写入session
        session('checkcode',$code);
        //写入画布
        //生成画布
        $img =$this->creatImagetruecolor($img_w  ,$img_h,$color=array(0xcc,0xcc,0xcc),$font,$char_len,$code);
    }
    //验证码工具类
    public function creatImagetruecolor($width ,$height,$color,$font,$char_len,$code){

        //生成画布
        list($red,$green,$blue)=$color;
        $img=imageCreateTrueColor($width,$height);
        $bg_color=imageColorAllocate($img ,0xcc,0xcc,0xcc);
        imageFill($img,0,0,$bg_color);

        //干扰像素
        for($i=0; $i<=200;++$i){
            $mix_color=imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
            imagesetpixel($img,mt_rand(0,$width),mt_rand(0,$height),$mix_color);
        }
        //干扰线
        for($i=0; $i<=5;++$i){
            $mix_color=imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
            imageline($img,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),$mix_color);
        }
        //边框
        $rect_color = imagecolorallocate($img,0x90,0x90,0x90);
        imagerectangle($img,0,0,$width-1,$height-1,$rect_color);

        //操作画布

        $str_color =imagecolorallocate($img,mt_rand(0,100),mt_rand(0,100),mt_rand(0,100));
        $font_w = imagefontwidth($font);
        $font_h = imagefontheight($font);
        $str_w= $font_w* $char_len;

        imagestring($img,$font,($width-$str_w)/2,($height-$font_h)/2,$code,$str_color);

        ob_clean();//清除缓冲区
        //输出图片内容
        header('content-type:image/png');
        imagepng($img);

        //销毁画布
        imagedestroy($img);

    }

}