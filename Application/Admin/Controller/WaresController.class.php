<?php


namespace Admin\Controller;
use Admin\Model\Page;
use Think\Controller;

class WaresController extends Controller{
    //上架商品查询
    public function shell(){
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
            $nowPage=isset($_GET["p"]) ? $_GET["p"]:'1';
            $curren_page=9;//每页条数
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
            $this->assign("s_class_list",$class_list);
            $this->display();
        }else{
            $this->error("非法用户，请先登录！",U("Index/login"));
        }
    }
    //购物车查询
    public function unpaid(){
        if ($admin_name=session("admin_name")){
            $this->assign("admin_name",$admin_name);
            $userModel=M("user");
            $u_where =array("USERNAME"=> $admin_name,
            );
            if ($realPwd=$userModel->where($u_where)->find()){
                if ($realPwd['power'] ==="M"){
                    $this->assign("admin",$admin_name);
                }else{
                    $u_id=$realPwd['u_id'];
                }
            }
//            $waresModel=M("wares");
//            $waresModel
            $unpaidModel=M("unpaid");
            $id_where = array();
            $id_where["unpaid.u_id"]=$u_id;
            $id_where['p_id'] = array('exp',' is null');
            //分页
            $nowPage=isset($_GET["p"]) ? $_GET["p"]:'1';
            $curren_page=5;//每页条数
            $unpaid_count=$unpaidModel->where($id_where)->count();//总条数
            $unpaid_list=$unpaidModel
                ->join('user on unpaid.u_id =user.u_id')
                ->join('wares on unpaid.w_id=wares.w_id')
                ->field('unpaid.up_id,unpaid.w_id,unpaid.p_count,user.u_id,wares.w_price,wares.w_stock,wares.w_lead,wares.w_name,wares.w_img')
                ->where($id_where)
                ->limit(($nowPage-1)*$curren_page,$curren_page)
                ->select();
            $page_handel=new Page($unpaid_count,$curren_page);
            $html=$page_handel->show();
            $this->assign("unpaids",$unpaid_list);
            $this->assign("u_id",$u_id);
            $this->assign("html",$html);
            $this->display();
        }else{
            $this->error("非法用户，请先登录！",U("Index/login"));
        }
    }
    //订单查询
    public function paid(){
        if ($admin_name=session("admin_name")){
            $this->assign("admin_name",$admin_name);
            $userModel=M("user");
            $unpaidModel=M("unpaid");
            $u_where =array("USERNAME"=> $admin_name,
            );
            if ($realPwd=$userModel->where($u_where)->find()){
                if ($realPwd['power'] ==="M"){
                    $this->assign("admin",$admin_name);
                }else{
                    $u_id=$realPwd['u_id'];
                }
            }
            $id_where = array();
            $id_where["unpaid.u_id"]=$u_id;
            $id_where['p_id'] = array('exp',' is not null AND p_id != ""');
            //分页
            $nowPage=isset($_GET["p"]) ? $_GET["p"]:'1';
            $curren_page=5;//每页条数
            $unpaid_count=$unpaidModel->where($id_where)->count();//总条数
            $unpaid_list=$unpaidModel
                ->join('user on unpaid.u_id =user.u_id')
                ->join('wares on unpaid.w_id=wares.w_id')
                ->field('unpaid.up_id,unpaid.w_id,unpaid.p_count,user.u_id,wares.w_price,wares.w_stock,wares.w_lead,wares.w_name,wares.w_img')
                ->where($id_where)
                ->limit(($nowPage-1)*$curren_page,$curren_page)
                ->select();
            $page_handel=new Page($unpaid_count,$curren_page);
            $html=$page_handel->show();
            $this->assign("unpaids",$unpaid_list);
            $this->assign("html",$html);
            $this->assign("u_id",$u_id);
            $this->display();
        }else{
            $this->error("非法用户，请先登录！",U("Index/login"));
        }
    }
    //精品推荐
    public function top(){
        if ($admin_name=session("admin_name")){
            $this->assign("admin_name",$admin_name);
            $userModel=M("wares");
            $order="w_talk desc";//根据评论order by
            //查询上架商品
            $sid_where = array();
            $sid_where['s_id'] = array('exp',' is not null AND s_id != ""');
            $sid_where['t_id'] = array('exp',' is null ');
            //分页
            $nowPage=isset($_GET["p"]) ? $_GET["p"]:'1';
            $curren_page=10;//每页条数
            $user_count=$userModel->where($sid_where)->count();//总条数
            $user_list=$userModel->where($sid_where)->order($order)->limit(($nowPage-1)*$curren_page,$curren_page)->select();
            $page_handel=new Page($user_count,$curren_page);
            $html=$page_handel->show();
            $this->assign("users",$user_list);
            $this->assign("html",$html);
            $this->display();
        }else{
            $this->error("非法用户，请先登录！",U("Index/login"));
        }
    }
    //商品详情页面
    public function detail(){
        if ($admin_name=session("admin_name")){
            $this->assign("admin_name",$admin_name);
            $waresModel=M("wares");
            $userModel=M("user");
            $u_where=array("USERNAME"=>$admin_name);
            $u_id=$userModel->where($u_where)->getField('u_id');
            $w_id=I('get.w_id',0);
            $where=array('w_id'=>$w_id);
            $wares_list=$waresModel->where($where)->find();
            $this->assign("list",$wares_list);
            $this->assign("u_id",$u_id);//写出id
            $this->assign("w_price",$wares_list["w_price"]);
            $this->display();
        }else{
            $this->error("非法用户，请先登录！",U("Index/login"));
        }
    }
    //下单
    public function gopaid(){
        if ($admin_name=session("admin_name")){
            $this->assign("admin_name",$admin_name);
            //定义数据库模板
            $unpaidModel=M("unpaid");
            $fr=I('get.fr',0);
            $w_id=I('get.w_id',0);
            $u_id=I('get.u_id',0);
            $up_id=I('get.up_id',0);
            $p_count=I('get.p_count',0);
            //根据来源决定插入数据或者更新数据
            $p_id=$w_id.$u_id.date("Ymd");
            $p_number=date("YmdHis");
            if ($fr==='unpaid'){
                if ($u_id==0){
                    $this->error("无效id",U("Index/login"));
                }
                $where=array(
                    'w_id'=>$w_id,
                    'u_id'=>$u_id,
                    'up_id'=>$up_id,
                );
                $data["w_id"]=$w_id;
                $data["u_id"]=$u_id;
                $data['p_id'] = strlen($p_id) > 11 ? substr($p_id,0,11) : $p_id;
                $data['p_number'] =$p_number;
                $data["p_count"]=$p_count;
                $paid_statu=$unpaidModel->where($where)->save($data);
            } elseif ($fr==='detail'){
                $data['p_id'] = strlen($p_id) > 11 ? substr($p_id,0,11) : $p_id;
                $data['p_number'] =$p_number;
                $data["w_id"]=$w_id;
                $data["u_id"]=$u_id;
                $data["p_count"]=$p_count;
                $unpaidModel->create($data);
                $paid_statu=$unpaidModel->add();
            }
            if (false===$paid_statu){
                $this->error("服务器繁忙，请稍后尝试",U("Wares/shell"));
            }else{
                $this->success("购买成功",U("Wares/paid"));
            }
        }else{
            $this->error("非法用户，请先登录！",U("Index/login"));
        }
    }
    //加入购物车
    public function gounpaid(){
        if ($admin_name=session("admin_name")){
            $this->assign("admin_name",$admin_name);
            //定义数据库模板
            $unpaidModel=M("unpaid");
            $w_id=I('get.w_id',0);
            $u_id=I('get.u_id',0);
            $p_count=I('get.p_count',0);
            //根据来源决定插入数据或者更新数据
            $data["w_id"]=$w_id;
            $data["u_id"]=$u_id;
            $data["p_count"]=$p_count;
            $unpaidModel->create($data);
            $paid_statu=$unpaidModel->add();
            if (false===$paid_statu){
                $this->error("服务器繁忙，请稍后尝试",U("Wares/shell"));
            }else{
                $this->success("成功加入购物车",U("Wares/unpaid"));
            }
        }else{
            $this->error("非法用户，请先登录！",U("Index/login"));
        }
    }
    //删除订单记录
    public function delpaidhistory(){
        if ($admin_name=session("admin_name")){
            $this->assign("admin_name",$admin_name);
            //定义数据库模板
            $unpaidModel=M("unpaid");
            $up_id=I('get.up_id',0);
            //根据来源决定插入数据或者更新数据
            $data["up_id"]=$up_id;
            $paid_statu=$unpaidModel->where($data)->delete();
            if (false===$paid_statu){
                $this->error("服务器繁忙，请稍后尝试",U("Wares/paid"));
            }else{
                $this->success("成功删除订单记录",U("Wares/paid"));
            }
        }else{
            $this->error("非法用户，请先登录！",U("Index/login"));
        }
    }
    //一次性下单多件商品
    public  function mixtopaid(){
        if ($admin_name=session("admin_name")){
            $this->assign("admin_name",$admin_name);
            $list_mixidcount=I("get.mixid");
            $split=explode(',',substr($list_mixidcount,1));
            //定义数据库模板
            $userModel=M("unpaid");
            //根据来源决定插入数据或者更新数据
            $u_id=I("get.u_id",'');
            $p_number=date("YmdHis");
            $success=0;
            $false=0;
            foreach ($split as $item){
                $one=explode('=',$item);
                $w_id=$one[0];
                $p_id=$w_id.$u_id.date("Ymd");
                $p_count=$one[1];
                $data["p_count"]=$p_count;
                $data["p_id"]=$p_id;
                $data["p_number"]=$p_number;
                $where_up=array("up_id"=>$one[2]);
                $mix_up_result=$userModel->where($where_up)->save($data);
                if ($mix_up_result===false||$mix_up_result===0){
                    $false+=1;
                }else{
                    $success+=1;
                }
            }
            if($success!=0){
                $this->success("成功结算$success 个商品",U("Wares/paid"));
            }else{
                $this->error("服务器繁忙，商品结算失败",U("Wares/unpaid"));
            }
        }else{
            $this->error("非法用户，请先登录！",U("Index/login"));
        }

    }
//    //混合下单订单查询测试
//    public function testpaid(){
//        if ($admin_name=session("admin_name")){
//            $this->assign("admin_name",$admin_name);
//            $userModel=M("user");
//            $unpaidModel=M("test");
//            $u_where =array("USERNAME"=> $admin_name,
//            );
//            if ($realPwd=$userModel->where($u_where)->find()){
//                if ($realPwd['power'] ==="M"){
//                    $this->assign("admin",$admin_name);
//                }else{
//                    $u_id=$realPwd['u_id'];
//                }
//            }
//            $id_where = array();
////            $id_where["unpaid.u_id"]=$u_id;
//            $id_where['mix_idpcount'] = array('exp',' is not null AND mix_idpcount != ""');
//            //分页
//            $nowPage=isset($_GET["p"]) ? $_GET["p"]:'1';
//            $curren_page=5;//每页条数
//            $unpaid_count=$unpaidModel->where($id_where)->count();//总条数
//            $unpaid_list=$unpaidModel
////                ->join('user on unpaid.u_id =user.u_id')
//                ->join('wares on unpaid.w_id=wares.w_id')
//                ->field('unpaid.up_id,unpaid.w_id,unpaid.p_count,user.u_id,wares.w_price,wares.w_stock,wares.w_lead,wares.w_name,wares.w_img')
//                ->where($id_where)
//                ->limit(($nowPage-1)*$curren_page,$curren_page)
//                ->select();
//            $page_handel=new Page($unpaid_count,$curren_page);
//            $html=$page_handel->show();
//            $this->assign("unpaids",$unpaid_list);
//            $this->assign("html",$html);
//            $this->assign("u_id",$u_id);
//            $this->display();
//        }else{
//            $this->error("非法用户，请先登录！",U("Index/login"));
//        }
//    }
//    public  function test(){
//        if ($admin_name=session("admin_name")){
//            $this->assign("admin_name",$admin_name);
//            $userModel=M("user");
//            $data["USERNAME1111"]=$admin_name;//字段错误默认从第一条查起
//            $userModel->create($data);
//            $u_id=$userModel->where($data)->getField('u_id');
//            $this->assign("u_id",$u_id);//写出id
//            var_dump($u_id);
//            $this->display();
//        }else{
//            $this->error("非法用户，请先登录！",U("Index/login"));
//        }
//
//    }
}