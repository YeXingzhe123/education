<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 16-8-6
 * Time: 下午11:23.
 */

namespace Home\Service;

class ReportService
{
    //显示教师管理视图



        //显示course表中remain_times中少于5的数据并返回
        public function getCourse(){
            echo "hasasaasjk";
           $course = M("Course");
           $select = $course ->select();
           var_dump($select);
        }

        //测试使用函数
        public function test(){
            echo "我是测试";
        }
}




