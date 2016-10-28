<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="./skin/easyui/jquery.min.js"></script>

    <link type="text/css" rel="stylesheet" href="./skin/css/login.css">
    <title>寿光市交通局公路养护管理系统</title>
    <script>
        function newCode(){

            $('#vertify').attr("src","<?php echo U('verify');?>?id="+new Date());
            //obj.src="<?php echo U('verify');?>";
        }
        function validate_required(field,alerttxt)
        {
            with (field)
            {
                if (value==null||value=="")
                {alert(alerttxt);
                    return false;
                }
                else {return true}
            }
        }


        function validate_form(thisform)
        {
            with (thisform)
            {
                if (validate_required(username,"请输入账户名!")==false){
                    username.focus();
                    return false;
                }
                if (validate_required(password,"请输入密码!")==false){
                    password.focus();
                    return false;
                }
                if (validate_required(check,"请输入验证码!")==false){
                    check.focus();
                    return false;
                }
                if (check.value.length!=4){
                    alert("验证码长度必须为4位");
                    check.focus();
                    return false;
                }
            }
        }
    </script>
</head>
</head>

<body >
<div class="headbg"></div>
<div class="login">
    <div class="logo"><img src="./skin/Img/lonin-logo.jpg" width="300" height="106" style=" margin-top:70px; "/></div>
    <div class="line"></div>
    <div class="input">
        <div class="logo2"><img src="./skin/Img/l_titleemp.png" width="245" height="44" /></div>
        <form action="" name="login" method="post" onsubmit="return validate_form(this)" autocomplete="off">
            <div class="inpt">
                <div class="text"><span>账&nbsp;&nbsp;号：</span><input name="username" type="text" autocomplete="off" class="user" /></div>
                <div class="text" style="margin-top:9px;;"><span>密&nbsp;&nbsp;码：</span><input name="password" type="password"  class="pwd" /></div>
                <div class="text" style="margin-top:9px;"><span>角&nbsp;&nbsp;色：</span><select name="role" class="role" >
                    <option value="0">校长</option>
                    <option value="1">教师</option>
                    <option value="2">教务人员</option>
                    <option value="3">财务人员</option>
                </select>

                </div>
                <div class="text" style="margin-top:14px; margin-top:12px;\9;"><span>验证码：
                </span><input name="check"  type="text" class="code" maxlength="4" style=" width:48px;"/>
                    <img id="vertify" style="cursor:pointer" src="<?php echo U('verify');?>" height="23" onclick="newCode();"
                         alt="点击更换" title="点击更换" /></div>
            </div>
            <div class="submit"><input name="login" type="submit" class="but" value=" " /></div>
        </form>

    </div>
</div>
<div class="footbg">
    <div class="copy">Powered by 寿光市睿智科技有限公司</div></div>
</body>
</html>