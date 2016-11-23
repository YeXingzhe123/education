<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        if (session("user_name") == Null and !IS_POST) {
            $this->display('login');
            exit();
        }
        if (session("user_name") == Null and IS_POST) {
            $role = I('post.role');
            $user_name = I('post.username');
            $password = I('post.password');
            $check = I('post.check');
            if ($user_name == '' | $password == '' | $check == '') {
                echo('<script type="text/javascript">alert("请按照规范填写");window.location.href="' . SRC_PATH . '";</script>');
                exit();
            }
            if (!check_code($check)) {
                echo('<script type="text/javascript">alert("验证码不正确");window.location.href="' . SRC_PATH . '";</script>');
                exit();
            }

            if ($role == 0) {
                $Condition['name'] = $user_name;
                $Condition['password'] = $password;
                $admin = M('admin');
                $result = $admin->where($Condition)->find();
                if (!$result) {
                    echo('<script type="text/javascript">alert("用户名或密码不正确");window.location.href="' . SRC_PATH . '";</script>');
                    exit();
                } else {
                    session("user_name", $user_name);
                    session("role", $role);
                }
            } else if ($role == 1) {
                $Condition['teacher_no'] = $user_name;
                $Condition['teacher_password'] = $password;
                $teacher = M('teacher');
                $result = $teacher->where($Condition)->find();
                if (!$result) {
                    echo('<script type="text/javascript">alert("用户名或密码不正确");window.location.href="' . SRC_PATH . '";</script>');
                    exit();
                } else {
                    session('teacher_id',$result['teacher_id']);
                    session("user_name", $user_name);
                    session("role", $role);
                }

            } else if ($role == 2) {
                # code...
            } else if ($role == 3) {
                # code...
            }


        }
        if (session("user_name")) {
            if (session("role") == 0) {
                $this->display("main_admin_op");
            } elseif (session("role") == 1) {
                $this->display("main_teacher_op");
            }
        }
    }

    public function verify()
    {
        $arr = array(
            'imageW' => 120,
            'imageH' => 34,
            'fontSize' => 16,    // 验证码字体大小
            'length' => 4,     // 验证码位数
            'useNoise' => false, // 关闭验证码杂点
            'useCurve' => false,
            'fontttf' => '5.ttf',
            'bg' => array(155, 202, 238)
        );

        $Verify = new \Think\Verify($arr);
        $Verify->codeSet = '0123456789';
        $Verify->entry();
    }

    public function logout()
    {
        session('[destroy]');
        $this->success("注销成功", SRC_PATH);
        //echo("<script type='text/javascript'  > alert('注销成功');</script>");
    }


}

