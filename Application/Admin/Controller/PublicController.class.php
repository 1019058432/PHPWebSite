<?php

namespace Admin\Controller;
use Admin\Model\Page;
use Think\Controller;
class PublicController extends Controller {
    //删除订单
    public function delpaid(){
        if ($admin_name=session("admin_name")) {
            $this->assign("admin_name", $admin_name);
            $u_where = array("USERNAME" => $admin_name,
            );
            //定义数据库模板
            $userModel = M("user");
            $unpaidModel = M("unpaid");
            if ($realPwd = $userModel->where($u_where)->getField('power')) {
                if ($realPwd === "M") {
                    $this->assign("admin", $admin_name);
                }
            }
            $up_id=I("get.up_id",0);
            $u_id=I("get.u_id",0);
            $fr=I("get.fr",0);
            $data["up_id"] =$up_id;
            $statu= $unpaidModel->where($data)->delete();
            if (false!==$statu){
                if ($fr=="M"){
                    $this->success("删除成功",U("Crud/paidM"));
                }else{
                    $this->success("删除成功",U("Wares/unpaid?u_id=".$u_id));
                }
            }
        }else{
            $this->error("非法用户，请先登录！",U("Index/login"));
        }
    }
    //上架商品查询
    public function shell(){

        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Methods:*');
        header('Access-Control-Allow-Headers:*');
        header('Access-Control-Expose-Headers:*');

        //定义数据库模板
//        $userModel=M("user");
        $waresModel=M("wares");
        $classModel=M("class");

        $like=I("get.like","");
        //查询上架商品
        $sid_where = array();
        $sid_where['s_id'] = array('exp',' is not null AND s_id != ""');
        $sid_where['t_id'] = array('exp',' is null ');
        //模糊查找
        if (!empty($like)){
            $sid_where["w_name"] =array("like" ,"%".$like."%");
        }
        //分页
        $nowPage=isset($_GET["page"]) ? $_GET["page"]:'1';
        $curren_page=30;//每页条数
        //如果分类
        if ($class_id=I("get.type",0)){
            $sid_where["class_id"]=$class_id;
            $wares_count=$waresModel->where($sid_where)->count();//总条数
            $wares_list=$waresModel
                ->where($sid_where)
                ->limit(($nowPage-1)*$curren_page,$curren_page)
                ->select();
        }else{
            $wares_count=$waresModel->where($sid_where)->count();//总条数
            $wares_list=$waresModel->where($sid_where)->limit(($nowPage-1)*$curren_page,$curren_page)->select();
        }
        $page_handel=new Page($wares_count,$curren_page);
        $html=$page_handel->show();
        //查分类类名
        $class_list=$classModel->select();
        //定义前台模板变量
        $this->assign("wares",$wares_list);
        $this->assign("s_class_list",$class_list);
        $apidata=array(
            'wares'=>$wares_list,
            's_class_list'=>$class_list
        );
        $this->ajaxReturn($apidata);

    }
    //商品详情页面
    public function detail(){

        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Methods:*');
        header('Access-Control-Allow-Headers:*');
        header('Access-Control-Expose-Headers:*');

        $waresModel=M("wares");
        $userModel=M("user");
        // $u_where=array("USERNAME"=>$admin_name);
        // $u_id=$userModel->where($u_where)->getField('u_id');
        $w_id=I('get.wid',0);
        $where=array('w_id'=>$w_id);
        $wares_list=$waresModel->where($where)->find();//没查到就返回上级目录（未完成）
        $this->assign("list",$wares_list);
        // $this->assign("u_id",$u_id);//写出id
        $this->assign("w_price",$wares_list["w_price"]);
        $this->ajaxReturn($wares_list);

    }
    //上架商品查询测试版
    public function test(){

        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Methods:*');
        header('Access-Control-Allow-Headers:*');
        header('Access-Control-Expose-Headers:*');

        //定义数据库模板
//        $userModel=M("user");
        $waresModel=M("wares");
        $classModel=M("class");

        $like=I("get.like","");
        //查询上架商品
        $sid_where = array();
//        $sid_where['s_id'] = array('exp',' is not null AND s_id != ""');
        $sid_where['g_id'] = array('exp',' in (select g_id from goodtopimg) ');
        //模糊查找
        if (!empty($like)){
            $sid_where["w_name"] =array("like" ,"%".$like."%");
        }
        //分页
        $nowPage=isset($_GET["page"]) ? $_GET["page"]:'1';
        $curren_page=30;//每页条数
        //如果分类
        if ($class_id=I("get.type",0)){
            $sid_where["class_id"]=$class_id;
            $wares_count=$waresModel->where($sid_where)->count();//总条数
//            $wares_list=$waresModel->query('select * from goods where g_id in ( select g_id from goodtopimg )');
            $wares_list=$waresModel
                ->where($sid_where)
                ->limit(($nowPage-1)*$curren_page,$curren_page)
                ->select();
        }else{
            $wares_count=$waresModel->where($sid_where)->count();//总条数
            $wares_list=$waresModel->where($sid_where)->limit(($nowPage-1)*$curren_page,$curren_page)->select();
        }
        $page_handel=new Page($wares_count,$curren_page);
        $html=$page_handel->show();
        //查分类类名
        $class_list=$classModel->select();
        //定义前台模板变量
        $this->assign("wares",$wares_list);
        $this->assign("s_class_list",$class_list);
        $apidata=array(
            'wares'=>$wares_list,
            's_class_list'=>$class_list
        );
        $this->ajaxReturn($apidata);
//        goods={
//            g_id,
//            goodtopimg{
//                img1,
//                img2,
//                ...
//            },
//            g_name,
//            g_commit
//
//
//        }

    }
}