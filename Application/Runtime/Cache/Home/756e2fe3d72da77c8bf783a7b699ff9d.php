<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>智能培训考勤管理系统</title>
    <link rel="stylesheet" type="text/css" href="./skin/easyui/themes/default/easyui.css" />
    <link rel="stylesheet" type="text/css" href="./skin/easyui/themes/icon.css" />
    <link rel="stylesheet" type="text/css" href="./skin/css/main.css" />
    <script type="text/javascript" src="./skin/easyui/jquery.min.js"></script>
    <script type="text/javascript" src="./skin/easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="./skin/easyui/locale/easyui-lang-zh_CN.js" ></script>

    <script type="text/javascript">
        $(function () {
            $('#box').layout({
                fit : true,
            });
            $('#tree_admin_op').tree({
                url : './skin/js/tree_admin_op.json',
                animate : true,
                lines : true,

                onClick : function (node) {
                    if (node.url){

                        if($('#tabs').tabs('exists',node.text)){
                            $('#tabs').tabs('select', node.text)
                        }
                        else{
                            $('#tabs').tabs('add',{
                                title:node.text,
                                href:node.url,
                                closable:true,
                                iconcls:node.inconcls


                            })
                        }
                    }




                }
            });

            $('#tabs').tabs({
                fit : true,
                border:false,
            });



            var ischart = '';
            objmain={
                click:function(data,url){

                    if($('#tabs').tabs('exists',data)){
                        $('#tabs').tabs('select',data);
                    }
                    else{
                        $('#tabs').tabs('add',{
                            title:data,
                            href:url,
                            closable:true

                        })

                    }
                    return false;
                }
            };


        })
    </script>

</head>


<body  class="easyui-layout">

<div data-options="region:'north',title:'header',
split:false,noheader:true" style="height:65px;background:#fff;;">
    <div class="think_title_logo">
    </div><div style="position: absolute;left:275px;top: 12px;background-image:url(./skin/Img/center_village_op.jpg); width:120px;height:40px"></div>
    <div class="think_title_left">
        <a href="http://localhost/education/index.php/index.php/home/index/logout" style=";color:#fe8007;text-decoration:none;font-weight: bold">【退出登录】
        </a>
    </div>
</div>
<div
        data-options="region:'south',title:'footer',split:false,noheader:true"
        style="height:35px;line-height:30px;text-align:center;">
    @技术支持：潍坊科技学院千行工作室
</div>
<div data-options="region:'west',title:'菜  单',iconCls:'icon-user',split:true" style="width:180px;">
    <ul id="tree_admin_op"></ul>
</div>
<div data-options="region:'center'" style="overflow:hidden;height:100%;width:100%;">

    <div id="tabs" >
        <div iconCls="icon-house"  title="主控台" style="padding:0 10px;display:block;"  href="">

        </div>
    </div>
</div>


</body>
</html>