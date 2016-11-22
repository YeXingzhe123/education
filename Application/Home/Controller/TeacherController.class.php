<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 16-8-6
 * Time: 下午11:23
 */

namespace Home\Controller;

use Think\Controller;

class TeacherController extends Controller
{
    //显示教师管理视图
    //
    public function _initialize()
    {
        if (session("user_name") == null) {
            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
    }

    public function teacher($value = '')
    {

        $this->display("addteacher");
    }

    public function get_week($value='')
    {


       $this->toJson('200','',$data);
    }

    private function toJson($error='200',$message='',$data)
    {


        return json_encode($array);
    }
    //测试使用
    // public function get_1week()
    // {

    //    echo "wwioidsjsdcsc";
    // }

}

