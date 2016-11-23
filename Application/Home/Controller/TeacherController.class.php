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

    public function getWeek()
    {
    }


}

