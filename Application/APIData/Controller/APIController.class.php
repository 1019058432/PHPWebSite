<?php


namespace APIData\Controller;
use APIData\Model\Page;
use Org\Util\Date;
use Think\Controller;

class APIController extends Controller{
    //商品列表接口
    public function shell(){

        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Methods:*');
        header('Access-Control-Allow-Headers:*');
        header('Access-Control-Expose-Headers:*');

        //定义数据库模板
        // $userModel=M("user");
        $waresModel=M("goods");
        $topimgModel=M("goodtopimg");
        $classModel=M("class");

        $like=I("get.like","");
        //查询上架商品
        $sid_where = array();
//        $sid_where['s_id'] = array('exp',' is not null AND s_id != ""');
//        $sid_where['t_id'] = array('exp',' is null ');
        //模糊查找
        if (!empty($like)){
            $sid_where["g_name"] =array("like" ,"%".$like."%");
        }
        //分页
        $nowPage=isset($_GET["page"]) ? $_GET["page"]:'1';
        $curren_page=30;//每页条数
        //如果分类
        if ($class_id=I("get.type",0)){
            $sid_where["goods.class_id"]=$class_id+1;
            $wares_count=$waresModel->where($sid_where)->count();//总条数
            $wares_list=$waresModel
                // ->join('goodtopimg on goods.g_id =goodtopimg.og_id')
                // ->join('goodserver on goods.g_id =goodserver.og_id')
                // ->join('goodsize on goods.g_id =goodsize.og_id')
                // ->join('goodcolor on goods.g_id =goodcolor.og_id')
                // ->join('goodimg on goods.g_id =goodimg.og_id')
                // ->join('goodparams on goods.g_id =goodparams.og_id')
                // ->join('class on goods.class_id =class.class_id')
                ->where($sid_where)
                ->limit(($nowPage-1)*$curren_page,$curren_page)
                ->select();
            // echo $waresModel->_sql();
        }else{
            $wares_count=$waresModel
                ->where($sid_where)
                ->count();//总条数
            $wares_list=$waresModel
                // ->join('goodtopimg on goods.g_id =goodtopimg.og_id')
                // ->join('goodserver on goods.g_id =goodserver.og_id')
                // ->join('goodsize on goods.g_id =goodsize.og_id')
                // ->join('goodcolor on goods.g_id =goodcolor.og_id')
                // ->join('goodimg on goods.g_id =goodimg.og_id')
                // ->join('goodparams on goods.g_id =goodparams.og_id')
                // ->join('class on goods.class_id =class.class_id')
                ->where($sid_where)
                ->limit(($nowPage-1)*$curren_page,$curren_page)
                ->select();
        }
        foreach ($wares_list as &$item){
            $data['og_id']= $item['g_id'];
            $imgList=$topimgModel->where($data)->getField('gt_imglink',true);
            // echo $topimgModel->_sql();
            // array_push($item,$imgList);
            $item['imgList']=$imgList;
            
        }
        // var_dump($wares_list);
        $page_handel=new Page($wares_count,$curren_page);
        $html=$page_handel->show();
        //查分类类名
        $class_list=$classModel->select();
        //定义前台模板变量
        $this->assign("goods",$wares_list);
        $this->assign("s_class_list",$class_list);
        $apidata=array(
            'goods'=>$wares_list,
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

        $waresModel=M("goods");
        $topimgModel=M("goodtopimg");
        $goodimgModel=M("goodimg");
        $serverModel=M("goodserver");
        $colorModel=M("goodcolor");
        $sizeModel=M("goodsize");
        $paramsModel=M("goodparams");
        // $u_where=array("USERNAME"=>$admin_name);
        // $u_id=$userModel->where($u_where)->getField('u_id');
        $w_id=I('get.wid',0);
        $where=array('g_id'=>$w_id);
        $whereo=array('og_id'=>$w_id);
        $wares_list=$waresModel->where($where)->find();//没查到就返回上级目录（未完成）
        $topimg=$topimgModel->where($whereo)->field('gt_imglink')->select();
        $img=$goodimgModel->where($whereo)->field('gi_imglink')->select();
        $server=$serverModel->where($whereo)->field('gse_commit')->select();
        $color=$colorModel->where($whereo)->field('gc_commit')->select();
        $size= $sizeModel->where($whereo)->field('gsi_commit')->select();
        $params=$paramsModel->where($whereo)->field('gp_commit')->select();
        $this->assign("list",$wares_list);
        // $this->assign("u_id",$u_id);//写出id
//        $this->assign("w_price",$wares_list["g_olprice"]);
        // 用户评价
        $comments=[];
        $comments['talknum']=100;
        $comments['sellnum']=135;
        $comments['users']=[
            array('avatar'=>'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1596266279510&di=5c05aa40c50d5e266185cd3851a7e1ba&imgtype=0&src=http%3A%2F%2Fqcloud.dpfile.com%2Fpc%2FrhEsbTCGOH7x8NuXYvfRkw5hdperKeNSk2XdyizgwYcaWV7jnGXDu6q3ZNCC13ooTYGVDmosZWTLal1WbWRW3A.jpg',
            'name'=>"杰克马",
            'evaluate'=>'物流很快对东西很满意非常愉快的一次购物下次还会光临！',
            'time'=>"1567865521"
            ),
            array('avatar'=>'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1596266279510&di=5c05aa40c50d5e266185cd3851a7e1ba&imgtype=0&src=http%3A%2F%2Fqcloud.dpfile.com%2Fpc%2FrhEsbTCGOH7x8NuXYvfRkw5hdperKeNSk2XdyizgwYcaWV7jnGXDu6q3ZNCC13ooTYGVDmosZWTLal1WbWRW3A.jpg',
            'name'=>"逗萝",
            'evaluate'=>'质量非常好，与卖家描述的完全一致，非常满意,真的很喜欢，完全超出期望值，发货速度非常快，包装非常仔细、严实，物流公司服务态度很好，运送速度很快，很满意的一次购物！',
            'time'=>"1567875222"
            )
            ];
        
        
        $topimgList=[];
        foreach ($topimg as $item){
            foreach ($item as $value){
                array_push($topimgList,$value);
            }
        }
        $imgList=[];
        foreach ($img as $item){
            foreach ($item as $value){
                array_push($imgList,$value);
            }
        }
        $serverList=[];
        foreach ($server as $item){
            foreach ($item as $value){
                array_push($serverList,$value);
            }
        }
        $colorList=[];
        foreach ($color as $item){
            foreach ($item as $value){
                array_push($colorList,$value);
            }
        }
        $sizeList=[];
        foreach ($size as $item){
            foreach ($item as $value){
                array_push($sizeList,$value);
            }
        }
        $paramsList=[];
        foreach ($params as $item){
            foreach ($item as $value){
                array_push($paramsList,$value);
            }
        }
        $goodList=array(
            'base'=>$wares_list,
            'topimg'=>$topimgList,
            'img'=>$imgList,
            'server'=>$serverList,
            'color'=>$colorList,
            'size'=>$sizeList,
            'params'=>$paramsList,
            'comments'=>$comments
        );
        $this->ajaxReturn($goodList);

    }
    //登录/注册接口
    //    登录
    public  function  login(){
        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Methods:*');
        header('Access-Control-Allow-Headers:*');
        header('Access-Control-Expose-Headers:*');
        if (IS_POST||IS_GET){
//            $u_code=strtolower($_POST['checkcode']);//转小写对比验证码
//            if ($u_code===strtolower(session('checkcode'))){
                $userInfo["USERNAME"]=I('get.username',false)?I('get.username'):I('post.username');
                $userInfo["PASSWORD"]=I('get.password',false)?I('get.password'):I('post.password');
                $adminModel =M("user");
                $adminInfo = $adminModel->create();
                $where =array("USERNAME"=> $userInfo["USERNAME"],
                );
                if ($realPwd=$adminModel->where($where)->find()){
                    //密码加盐验证
                    if ($realPwd['password'] ===md5($userInfo["PASSWORD"].$realPwd['salt'])){
                        $datatime=new Date();
                        session($realPwd['USERNAME'],$realPwd['password']);
                        $this->ajaxReturn($realPwd['password']);
                    }else{
                        $this->ajaxReturn(false);
                    }
                }else{
                    $this->ajaxReturn(false);
                }
//            }else{
//                $this->assign('error_code',"验证码输入错误!");
//            }
        }
        $this->display();
    }
//    注册
    public function register(){
        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Methods:*');
        header('Access-Control-Allow-Headers:*');
        header('Access-Control-Expose-Headers:*');
        if (IS_POST){
//            $u_code=strtolower($_POST['checkcode']);//转小写对比验证码
//            if ($u_code===strtolower(session('checkcode'))){
                $userInfo["USERNAME"]=I('get.username',false)?I('get.username'):I('post.username');
                $userInfo["PASSWORD"]=I('get.password',false)?I('get.password'):I('post.password');
                $adminModel =M("user");
                $adminInfo = $adminModel->create();
                $where =array("USERNAME"=> $userInfo["USERNAME"]);
                if ($realUser=$adminModel->where($where)->getField("USERNAME")){
                    $this->ajaxReturn('用户名注册失败，用户已存在！');
                }else{
                    $salt=date("YMdHis");//定义一个salt值，最好够长，或者随机
                    //$md_passwd= md5($password,$salt); //返回加salt后的散列
                    $adminInfo['PASSWORD']=md5($adminInfo['PASSWORD'].$salt);
                    $adminInfo['salt']=$salt;
                    if ($realUser =$adminModel->add($adminInfo)){
                        session($userInfo['USERNAME'],$adminInfo['USERNAME']);
                        $this->ajaxReturn('用户注册成功，登陆中，请等待...');
                    }else{
                        $this->ajaxReturn('用户注册失败，请重试！');
                    }
                }
//            }else{
//                $this->assign('error_code',"验证码输入错误!");
//            }
        }
        $this->display();
    }

}