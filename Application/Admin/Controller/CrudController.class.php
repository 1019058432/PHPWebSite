<?php
namespace Admin\Controller;
use Admin\Model\Page;
use Think\Controller;
class crudController extends Controller{
    //添加商品
    public function addM(){//算完成
        if ($admin_name=session("admin_name")){
            $this->assign("admin_name",$admin_name);
            $userModel=M("user");
            $u_where =array("USERNAME"=> $admin_name,
            );
            if ($realPwd=$userModel->where($u_where)->getField('power')){
                if ($realPwd ==="M"){
                    $this->assign("admin",$admin_name);
                }
            }
            $waresModel=M("wares");
            $classModel=M("class");
            //如果更新信息
            if (IS_POST){
                $waresModel->create();
                $add_result=$waresModel->add();
                if ($add_result){
                    echo "<script>alert('添加成功！id为".$add_result."')</script>";
                }else{
                    echo "<script>alert('添加失败！')</script>";
                }
            }
            $class_list=$classModel->select();
            $this->assign("class_list",$class_list);
            $this->display();
        }else{
            $this->error("非法用户，请先登录！",U("Index/login"));
        }

    }
    //删除订单抽取到Public控制器进行代码复用了
    public function delM(){//未完成（最后）
        if ($admin_name=session("admin_name")){
            $this->assign("admin_name",$admin_name);
            $userModel=M("user");
            $u_where =array("USERNAME"=> $admin_name,
            );
            if ($realPwd=$userModel->where($u_where)->getField('power')){
                if ($realPwd ==="M"){
                    $this->assign("admin",$admin_name);
                }
            }
            $w_id=I('get.w_id',0);
            $w_where=array('w_id'=>$w_id);
            $waresModel=M("wares");
            $wares_list=$waresModel->where($w_where)->find();//没查到就返回上级目录（未完成）
            $this->assign("list",$wares_list);
            $this->assign("have",$w_id);
            $this->display();
        }else{
            $this->error("非法用户，请先登录！",U("Index/login"));
        }

    }
    //修改单个商品信息
    public function upM(){ //完成
        if ($admin_name=session("admin_name")){
            $this->assign("admin_name",$admin_name);
            $userModel=M("user");
            $u_where =array("USERNAME"=> $admin_name,
            );
            if ($realPwd=$userModel->where($u_where)->getField('power')){
                if ($realPwd ==="M"){
                    $this->assign("admin",$admin_name);
                }
            }
            $w_id=I('get.w_id',0);
            $w_where=array('wares.w_id'=>$w_id);
            $waresModel=M("wares");
            $classModel=M("class");
            //如果更新信息
            if (IS_POST){
                $w_id=I('post.w_id',0);
                $w_where=array('wares.w_id'=>$w_id);
                $waresModel->create();
                $up_result=$waresModel->save();
                if ( false!==$up_result){
                    echo "<script>alert('更新成功！')</script>";
                }else{
                    echo "<script>alert('更新失败！')</script>";
                }
            }
            $wares_one=$waresModel
                ->join('class on class.class_id=wares.class_id')
                ->field('wares.w_id,wares.class_id,wares.w_name,wares.w_commit,wares.w_lead,wares.w_stock,wares.w_price,wares.w_img,class.class_name')
                ->where($w_where)
                ->find();//没查到就返回上级目录（未完成）
            $class_list=$classModel->select();
            $this->assign("class_list",$class_list);
            $this->assign("list",$wares_one);
            $this->display();
        }else{
            $this->error("非法用户，请先登录！",U("Index/login"));
        }
    }
    //修改、下架商品管理页面
    public function shellM(){
        if ($admin_name=session("admin_name")){
            $this->assign("admin_name",$admin_name);
            $u_where =array("USERNAME"=> $admin_name,
            );
            //定义数据库模板
            $userModel=M("user");
            $waresModel=M("wares");
            $classModel=M("class");
            if ($realPwd=$userModel->where($u_where)->getField('power')){
                if ($realPwd ==="M"){
                    $this->assign("admin",$admin_name);
                }
            }
            //查询上架商品
            $sid_where = array();
            $sid_where['s_id'] = array('exp',' is not null AND s_id != ""');
            $sid_where['t_id'] = array('exp',' is null ');
            //分页
            $nowPage=isset($_GET["p"]) ? $_GET["p"]:'1';
            $curren_page=10;//每页条数
            //如果分类
            if ($class_id=I("get.class_id",0)){
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
            $this->assign("html",$html);
            $this->assign("class_list",$class_list);
            $this->display();
        }else{
            $this->error("非法用户，请先登录！",U("Index/login"));
        }
    }
    //用户订单管理
    public function paidM(){
        if ($admin_name=session("admin_name")){
            $this->assign("admin_name",$admin_name);
            $userModel=M("user");
            $u_where =array("USERNAME"=> $admin_name,
            );
            if ($realPwd=$userModel->where($u_where)->getField('power')){
                if ($realPwd ==="M"){
                    $this->assign("admin",$admin_name);
                }
            }
//            $waresModel=M("wares");
//            $waresModel
            $unpaidModel=M("unpaid");
            //分页
            $nowPage=isset($_GET["p"]) ? $_GET["p"]:'1';
            $curren_page=5;//每页条数
            $unpaid_count=$unpaidModel->count();//总条数
            $unpaid_list=$unpaidModel
                ->join('user on unpaid.u_id =user.u_id')
                ->join('wares on unpaid.w_id=wares.w_id')
                ->field('unpaid.up_id,unpaid.p_number,unpaid.p_count,unpaid.into_time,user.username,wares.w_price')
                ->limit(($nowPage-1)*$curren_page,$curren_page)
                ->select();
            $page_handel=new Page($unpaid_count,$curren_page);
            $html=$page_handel->show();
            $this->assign("unpaids",$unpaid_list);
            $this->assign("html",$html);
            $this->display();
        }else{
            $this->error("非法用户，请先登录！",U("login"));
        }
    }
//    查询未上架且未加入回收站的商品
    public function shellUp(){//置空s_id 添加t_id 可以以时间(纯int)id
        if ($admin_name=session("admin_name")){
            $this->assign("admin_name",$admin_name);
            $u_where =array("USERNAME"=> $admin_name,
            );
            //定义数据库模板
            $userModel=M("user");
            $waresModel=M("wares");
            $classModel=M("class");
            if ($realPwd=$userModel->where($u_where)->getField('power')){
                if ($realPwd ==="M"){
                    $this->assign("admin",$admin_name);
                }
            }
            //查询未上架且未加入回收站商品
            $sid_where = array();
            $sid_where['s_id'] = array('exp',' is null ');
            $sid_where['t_id'] = array('exp',' is null');
            //分页
            $nowPage=isset($_GET["p"]) ? $_GET["p"]:'1';
            $curren_page=10;//每页条数
            //如果分类
            if ($class_id=I("get.class_id",0)){
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
            $this->assign("html",$html);
            $this->assign("class_list",$class_list);
            $this->display();
        }else{
            $this->error("非法用户，请先登录！",U("Index/login"));
        }
    }
    //上架商品
    public function upsid(){
        if ($admin_name=session("admin_name")) {
            $this->assign("admin_name", $admin_name);
            $u_where = array("USERNAME" => $admin_name,
            );
            //定义数据库模板
            $userModel = M("user");
            $waresModel = M("wares");
            if ($realPwd = $userModel->where($u_where)->getField('power')) {
                if ($realPwd === "M") {
                    $this->assign("admin", $admin_name);
                }
            }
            $w_id = I("get.w_id", 0);
            $wares_where = array("w_id" => $w_id);
            $data['s_id'] = date("YmdHis");
            $up_result = $waresModel->where($wares_where)->save($data);
            if ($up_result) {
                $this->success("上架成功", U("shellUp"));
            } else {
                $this->success("上架失败", U("shellUp"));
            }
        }else{
            $this->error("非法用户，请先登录！",U("Index/login"));
        }
    }
    //下架商品
    public function delsid(){
        if ($admin_name=session("admin_name")) {
            $this->assign("admin_name", $admin_name);
            $u_where = array("USERNAME" => $admin_name,
            );
            //定义数据库模板
            $userModel = M("user");
            $waresModel = M("wares");
            if ($realPwd = $userModel->where($u_where)->getField('power')) {
                if ($realPwd === "M") {
                    $this->assign("admin", $admin_name);
                }
            }
            $waresModel=M("wares");
            $w_id=I("get.w_id",0);
            $wares_where=array("w_id"=>$w_id);
            $data['s_id'] =array('exp','null');
            $up_result=$waresModel->where($wares_where)->save($data);
            if ($up_result){
                $this->success("下架成功",U("shellM"));
            }else{
                $this->success("下架失败",U("shellM"));
            }
        }else{
            $this->error("非法用户，请先登录！",U("Index/login"));
        }
    }
    //加入回收站
    public function toTemp(){//置空s_id 添加t_id 以时间(纯int)id
        if ($admin_name=session("admin_name")){
            $this->assign("admin_name",$admin_name);
            $u_where =array("USERNAME"=> $admin_name,
            );
            //定义数据库模板
            $userModel=M("user");
            $waresModel=M("wares");
            $classModel=M("class");
            if ($realPwd=$userModel->where($u_where)->getField('power')){
                if ($realPwd ==="M"){
                    $this->assign("admin",$admin_name);
                }
            }
            //加入回收站
            $w_id = I("get.w_id", 0);
            $wares_where = array("w_id" => $w_id);
            $data['t_id'] = date("YmdHis");
            $up_result = $waresModel->where($wares_where)->save($data);
            if ($up_result) {
                $this->success("加入回收站成功", U("shellUp"),0,0);
            } else {
                $this->success("加入回收站失败", U("shellUp"));
            }
        }else{
            $this->error("非法用户，请先登录！",U("Index/login"));
        }
    }
//    还原商品
    public function outTemp(){//置空s_id 添加t_id 可以以时间(纯int)id
        if ($admin_name=session("admin_name")){
            $this->assign("admin_name",$admin_name);
            $u_where =array("USERNAME"=> $admin_name,
            );
            //定义数据库模板
            $userModel=M("user");
            $waresModel=M("wares");
            if ($realPwd=$userModel->where($u_where)->getField('power')){
                if ($realPwd ==="M"){
                    $this->assign("admin",$admin_name);
                }
            }
            //商品还原
            $w_id=I("get.w_id",0);
            $wares_where=array("w_id"=>$w_id);
            $data['t_id'] =array('exp','null');
            $up_result=$waresModel->where($wares_where)->save($data);
            if ($up_result){
                $this->success("商品还原成功",U("Temp"));
            }else{
                $this->success("商品还原失败",U("Temp"));
            }
        }else{
            $this->error("非法用户，请先登录！",U("Index/login"));
        }
    }
    //查询回收站商品并且分页
    public function Temp(){//置空s_id 添加t_id 可以以时间(纯int)id
        if ($admin_name=session("admin_name")){
            $this->assign("admin_name",$admin_name);
            $u_where =array("USERNAME"=> $admin_name,
            );
            //定义数据库模板
            $userModel=M("user");
            $waresModel=M("wares");
            $classModel=M("class");
            if ($realPwd=$userModel->where($u_where)->getField('power')){
                if ($realPwd ==="M"){
                    $this->assign("admin",$admin_name);
                }
            }
            //查询未上架商品
            $sid_where = array();
            $sid_where['t_id'] = array('exp',' is not null AND t_id != ""');
            //分页
            $nowPage=isset($_GET["p"]) ? $_GET["p"]:'1';
            $curren_page=10;//每页条数
            //如果分类
            if ($class_id=I("get.class_id",0)){
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
            $this->assign("html",$html);
            $this->assign("class_list",$class_list);
            $this->display();
        }else{
            $this->error("非法用户，请先登录！",U("Index/login"));
        }
    }
    //彻底删除商品
    public function delwares(){
        if ($admin_name=session("admin_name")) {
            $this->assign("admin_name", $admin_name);
            $u_where = array("USERNAME" => $admin_name,
            );
            //定义数据库模板
            $userModel = M("user");
            $waresModel = M("wares");
            if ($realPwd = $userModel->where($u_where)->getField('power')) {
                if ($realPwd === "M") {
                    $this->assign("admin", $admin_name);
                }
            }
            $w_id=I("get.w_id",0);
            if (0!==$w_id){
                $w_where=array("w_id"=>$w_id);
                $statu=$waresModel->where($w_where)->delete();
                if (false!==$statu){
                    $this->success("删除成功",U("Crud/Temp"));
                }
            }else{
                $this->error("删除失败",U("Crud/Temp"));
            }
        }else{
            $this->error("非法用户，请先登录！",U("Index/login"));
        }
    }
    //用户管理
    public function userM(){
        if ($admin_name=session("admin_name")) {
            $this->assign("admin_name", $admin_name);
            $u_where = array("USERNAME" => $admin_name,
            );
            //定义数据库模板
            $userModel = M("user");
            $waresModel = M("wares");
            $classModel = M("class");
            if ($realPwd = $userModel->where($u_where)->getField('power')) {
                if ($realPwd === "M") {
                    $this->assign("admin", $admin_name);
                }
            }
            $userModel = M("user");
            $user_list = $userModel->select();
            $this->assign("user_list", $user_list);
            $this->display();
        }else{
            $this->error("非法用户，请先登录！",U("Index/login"));
        }
    }
    //添加分类
    public function addclass(){
        if ($admin_name=session("admin_name")) {
            $this->assign("admin_name", $admin_name);
            $u_where = array("USERNAME" => $admin_name,
            );
            //定义数据库模板
            $userModel = M("user");
            $classModel = M("class");
            if ($realPwd = $userModel->where($u_where)->getField('power')) {
                if ($realPwd === "M") {
                    $this->assign("admin", $admin_name);
                }
            }
            $class_name=I("post.class_name");
            $data["class_name"] =$class_name;
            $class_id= $classModel->add($data);
            $class_list=$classModel->select();
            $this->ajaxReturn($class_list);
            }else{
        $this->error("非法用户，请先登录！",U("Index/login"));
        }
    }
    //删除分类
    public function delclass(){
        if ($admin_name=session("admin_name")) {
            $this->assign("admin_name", $admin_name);
            $u_where = array("USERNAME" => $admin_name,
            );
            //定义数据库模板
            $userModel = M("user");
            $classModel = M("class");
            $waresModel = M("wares");
            if ($realPwd = $userModel->where($u_where)->getField('power')) {
                if ($realPwd === "M") {
                    $this->assign("admin", $admin_name);
                }
            }
            $class_id=I("post.class_id",0);
//            $w_id=I("post.w_id",0);
            $data["class_id"] =$class_id;
            $statu= $classModel->where($data)->delete();
//            $statu2=$waresModel->find();
            $class_list=$classModel->select();
            $this->ajaxReturn($class_list);
            }else{
        $this->error("非法用户，请先登录！",U("Index/login"));
        }
    }
}