<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 16-8-6
 * Time: 下午11:23.
 */

namespace Home\Controller;

use Think\Controller;
use Home\Service\ReportService;

class MainController extends Controller
{
    //显示教师管理视图

    public function _initialize()
    {
        if (session('user_name') == null) {
            session('[destroy]');
            echo "<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>";
            exit();
        }
    }

    public function getCourse()
    {
       $user =D('Report','Service');
        //$user =new ReportService();
        if($user)
        {
            $user->getCourse();
        }else{
            echo "调用错误";
        }

    }
    //
    //测试
    public function index()
    {

        echo "我是正确的";
    }


}
