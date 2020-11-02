<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品详细信息</title>
    <link rel="stylesheet" type="text/css" href="/tp/Public/static/css/bootstrap.min.css">
<!--    <link rel="stylesheet" type="text/css" href="/tp/Public/static/css/common2.css">无用-->
    <link rel="stylesheet" type="text/css" href="/tp/Public/static/css/route-detail.css">
    <style>
        .table-css,.header{
            float: left;
        }
        .table-css{
            width:75%;
        }
    </style>
</head>
<body>
<!--引入头部-->
<header class="header">
    <!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
  <!-- Bootstrap -->
  <link href="/tp/Public/static/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body{
        width: 100%;
    }
    .top-menu{
        padding-top: 10px;
        height: 20px;
        background: #579142;
    }
    .menu-content{
        background:#ffbe94;
    }
    #header_padding{
        width: 200px;
        /*设置文字不能被选中     以下为css样式*/
        -webkit-user-select:none;
        -moz-user-select:none;
        -ms-user-select:none;
        user-select:none;
    }
    #shellM,#u_menu{
      margin-right: 15px;
      top: 15px;
    }
    #m1,#m2{
      position: relative;
    }
    .btn-list-area,#uM_list{
      top: 15px;
      left: 0px;
    }
    .btn-list-area,.btn-list-area2,.btn-list-area3,#uM_list,#shell_c_list{
      background-color: #fff4e8;
      display: none;
      width: 300px;
    }
    .btn-list-area>a{
      margin: 3px 3px;
    }
    .btn-list-area2>a{
      margin: 3px 3px;
    }
    .btn-list-area3>a{
      margin: 3px 3px;
    }
    .li-css{
        height: 16px;
        padding: 0;
    }
    .find{
          width: 150px;
    }

  </style>
</head>
<body>
  <div id="header_padding">
    <div class="menu-content">
        <div class="top-menu"></div>
        <ul>
            <?php if($admin_name == ''): ?><li><a href="<?php echo U('Admin/Index/login');?>" >登录</a></li>
                <li><a href="<?php echo U('Admin/Index/register');?>">注册</a></li>
            <?php else: ?>
                <li>
                    <nobr><a href="<?php echo U('Users/User/user');?>"><span style="font-size: 8px;text-overflow:ellipsis;width: 80px"><?php echo ($admin_name); ?>,你好!</span></a>
                        <a href="<?php echo U('Admin/Index/logout');?>" >注销</a>
                    </nobr>
                </li><?php endif; ?>
            <li>
                <a  href="<?php echo U('Admin/Index/index');?>">首页</a>
            </li>
        </ul>
        <?php if($admin == ''): ?><ul >
                <li class="[statu1]" >
                    <a href="<?php echo U('Admin/Wares/paid');?>">我的订单 <span class="sr-only">(current)</span></a>
                </li>
                <li class="[statu2]" id="shell_class_list">
                    <a href="<?php echo U('Admin/Wares/shell');?>">分类商城广场</a>
                    <br>
                    <span id="shell_c_list">
                        <?php if(is_array($s_class_list)): $i = 0; $__LIST__ = $s_class_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$manu): $mod = ($i % 2 );++$i; if($manu["class_id"] == 1 ): else: ?>
                                 <a  href="<?php echo U('Admin/Wares/shell?class_id='.$manu[class_id]);?>"><?php echo ($manu["class_name"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </span>
                </li>
                <li class="[statu3]">
                        <a href="<?php echo U('Admin/Wares/unpaid');?>">我的购物车</a>
                </li>
                <li class="[statu4]">
                        <a href="<?php echo U('Admin/Wares/top');?>">人气推荐</a>
                </li>
            </ul>
        <?php else: ?>
            <ul class="">
                <li class="[statu1]" >
                        <a href="<?php echo U('Admin/Crud/paidM');?>">订单管理 <span class="sr-only">(current)</span></a>
                </li>
                <li class="[statu2]" >
                    <span id="shellM">商品管理<br>
                        <span class="btn-list-area" >
                            <span id="m1">
                                   <a href="<?php echo U('Admin/Crud/shellM');?>">商品下架及修改</a>
                              <span class="btn-list-area2">
                                <?php if(is_array($class_list)): $i = 0; $__LIST__ = $class_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$manu): $mod = ($i % 2 );++$i;?><ul>
                                    <?php if($manu["class_id"] == 1 ): else: ?>
                                         <li class="li-css">
                                                <a  href="<?php echo U('Admin/Crud/shellM?class_id='.$manu[class_id]);?>"><?php echo ($manu["class_name"]); ?></a>
                                         </li><br><?php endif; ?>
                                    </ul><?php endforeach; endif; else: echo "" ;endif; ?>
                              </span>
                            </span><br>
                            <span id="m2">
                                   <a href="<?php echo U('Admin/Crud/shellUp');?>">上架回收商品</a><br>
                                <span class="btn-list-area3">
                                    <?php if(is_array($class_list)): $i = 0; $__LIST__ = $class_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$manu): $mod = ($i % 2 );++$i; if($manu["class_id"] == 1 ): else: ?>
                                                    <a  href="<?php echo U('Admin/Crud/shellUp?class_id='.$manu[class_id]);?>"><?php echo ($manu["class_name"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                </span>
                            </span><br>
                            <span >
                                   <a href="<?php echo U('Admin/Crud/addM');?>">添加商品</a>
                            </span>
                        </span>
                    </span>
                </li>
                <li id="u_menu"><span>用户管理</span><br>
                    <span id="uM_list">
                        <a href="<?php echo U('Admin/Crud/userM');?>">会员列表</a>
                    </span>
                </li>
                <li>
                    <a href="<?php echo U('Admin/Crud/Temp');?>">商品回收站</a>
                </li>
            </ul><?php endif; ?>
      <ul >
          <li>
              <form class="" method="get" action="<?php echo U('Admin/Wares/shell');?>" >
                  <div class="form-group">
                      <input type="text" name="like" class=" find" placeholder="Search">
                  </div>
                  <button type="submit" class="btn btn-default">搜索</button>
              </form>
          </li>
      </ul>
    </div>
  <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
  <script src="/tp/Public/static/js/jquery.js"></script>
  <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
  <script src="/tp/Public/static/js/bootstrap.min.js"></script>
    <script>
      $(function () {
        //商品管理列表
        // $("#shellM").hover(function () {
        //   $(".btn-list-area").show();
        // },function () {
        //   $(".btn-list-area").hide();
        // });
        $("#shellM").click(function (event) {
            $(".btn-list-area").toggle(null,null,false);
            $(this).css("height","16px")
        });
        // $("#m1").click(function (event) {
        //     $(".btn-list-area2").show()
        // })
        $("#m1").hover(function () {
            $(".btn-list-area3").hide();
          $(".btn-list-area2").show();
        },function () {
          // $(".btn-list-area2").hide();
        });
        $("#m2").hover(function () {
            $(".btn-list-area3").show();
        },function () {
          // $(".btn-list-area3").hide();
        });
        //用户管理菜单列表
        // $("#u_menu").hover(function () {
        //   $("#uM_list").show();
        // },function () {
        //   $("#uM_list").hide();
        // });
          $("#u_menu").click(function () {
              $("#uM_list").toggle()
          })
          //用户管理菜单列表
          $("#shell_class_list").hover(function () {
              $("#shell_c_list").show();
          },function () {
              $("#shell_c_list").hide();
          });
      })
    </script>
  </div>
</body>
</html>
</header>
<!-- 详情 start -->

<div class="wrap table-css">
    <form action="/tp/index.php/Admin/Crud/upM" method="post">
    <div style="margin-left: 150px"><textarea style="width: 900px;height: 80px" name="w_name"><?php echo ($list["w_name"]); ?></textarea></div>
        <div class="prosum_box">
            <dl class="prosum_left">
                <dt>
                    <img alt="" class="big_img" src="<?php echo ($list["w_img"]); ?>">
                </dt>
                <dd id="dd">
                    <a class="up_img up_img_disable"></a>修改图片连接
                    <input type="text" name="w_img" value="<?php echo ($list["w_img"]); ?>">
                    <a title="" class="little_img cur_img" data-bigpic="http://www.jinmalvyou.com/Public/uploads/goods_img/img_size4/201703/m49788843d72171643297ccc033d9288ee.jpg">
                        <div  style="display: none"  ><input name="w_id" value="<?php echo ($list["w_id"]); ?>"></div>
                        <img src="<?php echo ($list["w_img"]); ?>">
                    </a>
                    <a class="down_img down_img_disable" style="margin-bottom: 0;"></a>
                </dd>
            </dl>
            <div class="prosum_right">
                <p class="pros_title"><span id="rname"> 【新品特卖】全国销售</span></p>
                <p class="hot"><span id="routeIntroduce"> <textarea id="commit" name="w_commit" ><?php echo ($list["w_commit"]); ?></textarea></span></p>
                <div class="pros_other">
                    <p><span id="sname">经营商家  ：<input type="text" id="lead" name="w_lead" value="<?php echo ($list["w_lead"]); ?>"></span></p>
                    <p><div id="class_id">分类:<br>
                        <span>当前分类:<?php echo ($list["class_name"]); ?></span><br>
                        <span>修改分类:</span>
                        <select name="class_id" id="class_list">
                            <?php if(is_array($class_list)): $i = 0; $__LIST__ = $class_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["class_name"] == $list["class_name"] ): ?><option value="<?php echo ($vo["class_id"]); ?>" selected="selected"><?php echo ($vo["class_name"]); ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo ($vo["class_id"]); ?>"><?php echo ($vo["class_name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                        </select><input type="button" id="delclass" value="删除该分类" style="height: 20px;font-size: 14px;line-height: 19px"></div>
                        <div>添加分类
                            <input type="text" id="class_name" name="class_name" placeholder="请输入新增分类">
                                <input id="classadd" type="button" value="增加">
                        </div>
                    </p>
                    <p><span id="consphone">咨询电话 : 168-168-168</span></p>
                    <p><span id="address">地址 ： 憨憨实体店</span></p>
                </div>
                <div class="pros_price">
                    <p class="count"><input type="text" id="stock"  name="w_stock" value="<?php echo ($list["w_stock"]); ?>"><span>货存数量</span></p>
                    <p class="price"><input type="text" id="price" name="w_price" value="<?php echo ($list["w_price"]); ?>"><span>起</span></p>
                    <p class="collect">
                        <input type="submit"  value="更新商品">

                        <a href="/tp/index.php/Admin/Crud/toTemp?w_id=<?php echo ($list["w_id"]); ?>">放入回收站</a>
                        <span>本月已售100单</span>
                    </p>
                </div>
            </div>
        </div>
    </form>
    <div class="you_need_konw">
        <span>买家须知</span>
        <div class="notice">
            <h4>本平台承诺</h4>
            <p>
                本平台卖家销售并发货的商品，由平台卖家提供发票和相应的售后服务。请您放心购买！
                注：因厂家会在没有任何提前通知的情况下更改产品包装、产地或者一些附件，本司不能确保客户收到的货物与商城图片、产地、附件说明完全一致。只能确保为原厂正货！并且保证与当时市场上同样主流新品一致。若本商城没有及时更新，请大家谅解！ <br>
            <h4>品质保障</h4>
            <p>本商城向您保证所售商品均为正品行货，本自营商品开具机打发票或电子发票。</p>
            <h4>权利声明：</h4>
            <p>
               本品台上的所有商品信息、客户评价、商品咨询、网友讨论等内容，是本平台重要的经营资源，未经许可，禁止非法转载使用。
                注：本站商品信息均来自于合作方，其真实性、准确性和合法性由信息拥有者（合作方）负责。本站不提供任何保证，并不承担任何法律责任。</p>
            <h4>价格说明：</h4>
            <p>
                <p><strong>售价：</strong> 售价为商品的销售价，是您最终决定是否购买商品的依据。</p>

                <p><strong>划线价：</strong>商品展示的划横线价格为参考价，并非原价，该价格可能是品牌专柜标价、商品吊牌价或由品牌供应商提供的正品零售价（如厂商指导价、建议零售价等）或该商品在京东平台上曾经展示过的销售价；由于地区、时间的差异性和市场行情波动，品牌专柜标价、商品吊牌价等可能会与您购物时展示的不一致，该价格仅供您参考。</p>

                <p><strong>折扣：</strong>如无特殊说明，折扣指销售商在原价、或划线价（如品牌专柜标价、商品吊牌价、厂商指导价、厂商建议零售价）等某一价格基础上计算出的优惠比例或优惠金额；如有疑问，您可在购买前联系销售商进行咨询。</p>

                <p><strong>异常问题：</strong>商品促销信息以商品详情页“促销”栏中的信息为准；商品的具体售价以订单结算页价格为准；如您发现活动商品售价或促销信息有异常，建议购买前先联系销售商咨询。</p></p>

        </div>
    </div>
</div>
<!-- 详情 end -->

<!--引入头部-->
<footer>
    <!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
  <!-- Bootstrap -->
  <link href="/tp/Public/static/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .foot2 {
      position: fixed;
      left: 0px;
      bottom: 0px;
      width: 100%;
      height: 50px;
      background-color: #eee;
      z-index: 9999;
      text-align: center;
      margin-top: 50px;
    }

  </style>
</head>
<div >
<div class="foot2 ">
  <div >
      <div class="links">
        <a rel="nofollow"  href="#">
          关于我们
        </a>
        |
        <a rel="nofollow"  href="#">
          联系我们
        </a>
        |
        <a rel="nofollow"  href="#">
          人才招聘
        </a>
        |
        <a rel="nofollow"  href="#">
          商家入驻
        </a>
        |
        <a rel="nofollow"  href="#">
          广告服务
        </a>
        |
        <a rel="nofollow"  href="#">
          手机商店
        </a>
        |
        <a  href="#">
          友情链接
        </a>
        |
        <a  href="#">
          销售联盟
        </a>
        |
        <a href="#" >
          社区
        </a>
        |
        <a href="#" >
          公益
        </a>
        |
        <a  href="#" clstag="pageclick|keycount|20150112ABD|9">English Site</a>
      </div>
      <div class="copyright">
        company&nbsp;©&nbsp;2020-2020&nbsp;&nbsp;憨憨&nbsp;版权所有
      </div>
  </div>

</div>
<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="/tp/Public/static/js/jquery.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="/tp/Public/static/js/bootstrap.min.js"></script>
</div>
</html>
</footer>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/tp/Public/static/js/jquery-3.3.1.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/tp/Public/static/js/bootstrap.min.js"></script>
<script>
    //异步请求
    $(function () {
        // 添加分类
        $("#classadd").click(function () {
            let class_id=$("#class_list").val()
            let class_name=$("#class_name").val()
            $.post("/tp/index.php/Admin/Crud/addclass",{class_name:class_name},function (class_list) {
                let options=''
                for (const item of class_list) {
                    if (item.class_id==class_id){
                        options+="<option value='"+item.class_id+"' selected='selected'>"+item.class_name+"</option>"
                    }else {
                        options+="<option value='"+item.class_id+"'>"+item.class_name+"</option>"
                    }
                }
                //可使用html覆盖防数据同时更改
                $("#class_list").html(options);
            });
        })
        //删除分类
        $("#delclass").click(function () {
            let class_id=$("#class_list").val()
            // let class_name=$("#class_name").val()
            $.post("/tp/index.php/Admin/Crud/delclass",{class_id:class_id},function (class_list) {
                let options=''
                for (const item of class_list) {
                    if (item.class_id==class_id){
                        options+="<option value='"+item.class_id+"' selected='selected'>"+item.class_name+"</option>"
                    }else {
                        options+="<option value='"+item.class_id+"'>"+item.class_name+"</option>"
                    }
                }
                //可使用html覆盖防数据同时更改
                $("#class_list").html(options);
            });
        })

    });

</script>
</body>
</html>