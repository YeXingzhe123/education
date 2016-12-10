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


class ReportController extends Controller
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
    public function student_info()
    {
        $this->display('student_info');
    }
    /**
     * [getStudent description]
     * @param   $name [description]
     * @param  [type] $php  [description]
     * @return        [description]
     */
    public function getStudent($name ,$php)
    {
        $name = I('post.name');
        $reportService = new ReportService();
        $reportService->getStudent( $name,);
        return $aa;

    }

}
