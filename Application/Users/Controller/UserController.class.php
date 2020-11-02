<?php


namespace Users\Controller;
use Think\Controller;

class UserController extends Controller{
    public function user(){
        if ($admin_name=session("admin_name")) {
            $this->assign("admin_name", $admin_name);
            $u_where = array("USERNAME" => $admin_name,
            );
            //定义数据库模板
            $userModel = M("user");
            if ($realPwd = $userModel->where($u_where)->find()) {
                if ($realPwd["power"] === "M") {
                    $this->assign("admin", $admin_name);
                    $address=$realPwd["address"];
                    $this->assign("address",$address);
                }else{
                    $address=$realPwd["address"];
                    $this->assign("address",$address);
                }
            }
            $this->display();
        }else{
            $this->error("非法用户，请先登录！","../../Admin/Index/login");
        }
    }
    public function npwd(){
        if ($admin_name=session("admin_name")) {
            $this->assign("admin_name", $admin_name);
            $u_where = array("USERNAME" => $admin_name,
            );
            //定义数据库模板
            $userModel = M("user");
            if ($realPwd = $userModel->where($u_where)->getField('power')) {
                if ($realPwd === "M") {
                    $this->assign("admin", $admin_name);
                }
            }
        }
        if (IS_POST){
                $userModel = M("user");
                $userHandel=$userModel->create();
                $USERNAME=$userHandel['USERNAME'];
                $email=$userHandel['Email'];
                $data['USERNAME']=$USERNAME;
                $data['Email']=$email;
                $statu=$userModel->where($data)->find();
                if (false!==$statu&$statu!=null){
                    $u_id=$statu['u_id'];
                    $salt=date("YMdHis");//定义一个salt值，最好够长，或者随机
                    //$md_passwd= md5($password,$salt); //返回加salt后的散列
                    $userHandel['PASSWORD']=md5($userHandel['PASSWORD'].$salt);
                    $userHandel['salt']=$salt;
                    $u_where=array("u_id"=>$u_id);
                    $statu2=$userModel->where($u_where)->save($userHandel);
                    if (false!==$statu2){
                        $this->assign("log","修改成功");
                    }else{
                        $this->assign("log","修改失败");
                    }
                }else{
                    $this->assign("log","信息有误,请仔细确认后再次尝试");
                }
                $this->display();
        }else{
                $this->display();
            }
    }
    //Ajax修改密码/地址
    public function address(){
        if ($admin_name=session("admin_name")) {
            $this->assign("admin_name", $admin_name);
            $u_where = array("USERNAME" => $admin_name,
            );
            //定义数据库模板
            $userModel = M("user");
            $u_id=null;
            if ($realPwd = $userModel->where($u_where)->find()) {
                if ($realPwd['power'] === "M") {
                    $this->assign("admin", $admin_name);
                    $u_id=$realPwd['u_id'];
                }else{
                    $u_id=$realPwd['u_id'];
                }
            }
            if (IS_POST){
                $userHandel=$userModel->create();
                $data['u_id']=$u_id;
                //根据来源操作
                $fr=I("post.fr",0);
                if ($fr==="upwd"){
                    $email=$userHandel['Email'];
                    $data['Email']=$email;
                    $f_statu=$userModel->where($data)->find();
                    if (false===$f_statu||$f_statu==null){
                        $success_log="修改密码失败!";
                        $this->ajaxReturn($success_log);
                    }else{
                        $salt=date("YMdHis");//定义一个salt值，最好够长，或者随机
                        //$md_passwd= md5($password,$salt); //返回加salt后的散列
                        $userHandel['PASSWORD']=md5($userHandel['PASSWORD'].$salt);
                        $userHandel['salt']=$salt;
                        $success_log="修改密码成功!";
                    }
                }elseif ($fr==="uaddre"){
                    $success_log="修改地址成功!";
                }
                $add_statu=$userModel->where($data)->save($userHandel);
                if (false!==$add_statu){
                    $this->ajaxReturn($success_log);
                }
            }
        }else{
            $this->error("非法用户，请先登录！","../../Admin/Index/login");
        }
    }
}