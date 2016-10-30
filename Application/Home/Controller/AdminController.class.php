<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 16-8-6
 * Time: 下午11:23
 */

namespace Home\Controller;
use Think\Controller;

class AdminController extends Controller  {
    //显示教师管理视图
    public function teacher($value='')
    {
        if (session("user_name")==null) {
            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $this->display("addteacher");
    }
    public function readallteacher(){
        if(session("user_name")==null){

            session('[destroy]');
            echo('<script type="text/javascript">alert("发生错误，请重新登录");window.location.href="'.SRC_PATH.'";</script>"');
            exit();
        }
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        if(isset($_POST['teacher_name']) && !empty($_POST['teacher_name'])){
            $condition["teacher_name|teacher_no"]=array("like","%".I("post.teacher_name")."%");//姓名或学号搜索
        }
        $teacher=M("teacher");
        $result=$teacher->where($condition)->order($sort.' '.$order)->page($page,$pagesize)->select();
        $json = json_encode($result);

        $total=$teacher->where($condition)->count();
        echo '{"total":'.$total.',"rows":'.$json.'}';
    }
    public function addteacher_info(){

        $row = I("post.row");
        $data["teacher_no"]=$row["teacher_no"];
        $data["teacher_birthday"]=$row["teacher_birthday"];
        $data["teacher_education"]=$row["teacher_education"];
        $data["teacher_id_card"]=$row["teacher_id_card"];
        $data["teacher_major"]=$row["teacher_major"];
        $data["teacher_name"]=$row["teacher_name"];
        $data["teacher_password"]=$row["teacher_password"];//grade_name属性的value值是grade_id
        $data["teacher_remark"]=$row["teacher_remark"];//
        $data["teacher_salary"]=$row["teacher_salary"];//
        $data["teacher_sex"]=$row["teacher_sex"];

        if(session("user_name")==null){

            session('[destroy]');
            echo('<script type="text/javascript">alert("违法操作，请重新登录");window.location.href="'.SRC_PATH.'";</script>"');
            exit();
        }
        $teacher=M("teacher");
        $result=$teacher->add($data);
        if(!$result){
            echo "失败";
        }
        else{
            echo"成功";
        }
    }
    public function updateteacher_info(){
        $row = I("post.row");
        $data["teacher_no"]=$row["teacher_no"];
        $data["teacher_birthday"]=$row["teacher_birthday"];
        $data["teacher_education"]=$row["teacher_education"];
        $data["teacher_id_card"]=$row["teacher_id_card"];
        $data["teacher_major"]=$row["teacher_major"];
        $data["teacher_name"]=$row["teacher_name"];
        $data["teacher_password"]=$row["teacher_password"];//grade_name属性的value值是grade_id
        $data["teacher_remark"]=$row["teacher_remark"];//
        $data["teacher_salary"]=$row["teacher_salary"];//
        $data["teacher_sex"]=$row["teacher_sex"];
        if(session("user_name")==null){
            session('[destroy]');
            echo('<script type="text/javascript">alert("违法操作，请重新登录");window.location.href="'.SRC_PATH.'";</script>"');
            exit();
        }
        $teacher=M("teacher");
        $condition["teacher_id"]=$row['teacher_id'];
        $result=$teacher->where($condition)->save($data);
        if(!$result){
            echo "失败";
        }
        else{
            echo"成功";
        }
    }
    public function deleteteacher_info(){
        if(session("user_name")==null){

            session('[destroy]');
            echo('<script type="text/javascript">alert("违法操作，请重新登录");window.location.href="'.SRC_PATH.'";</script>"');
            exit();
        }

        $ids =I("post.ids");
        $teacher=M("teacher");
        $condition["teacher_id"]=Array("IN","$ids");
        $result=$teacher->where($condition)->delete();
        echo $result;
    }



        //显示学生管理视图
    public function student($value='')
    {
        if (session("user_name")==null) {
            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $this->display("addstudent");
    }
    public function readallstudent(){
        if(session("user_name")==null){

            session('[destroy]');
            echo('<script type="text/javascript">alert("发生错误，请重新登录");window.location.href="'.SRC_PATH.'";</script>"');
            exit();
        }
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        if(isset($_POST['student_name']) && !empty($_POST['student_name'])){
            $condition["student_name"]=array("like","%".I("post.student_name")."%");//姓名或学号搜索
        }
        $student=M("student");
        $result=$student->where($condition)->order($sort.' '.$order)->page($page,$pagesize)->select();
        $json = json_encode($result);

        $total=$student->where($condition)->count();
        echo '{"total":'.$total.',"rows":'.$json.'}';
    }
    public function addstudent_info(){

        $row = I("post.row");
        $data["student_birthday"]=$row["student_birthday"];
        $data["student_tel"]=$row["student_tel"];
        $data["student_name"]=$row["student_name"];
        $data["student_remark"]=$row["student_remark"];//
        $data["student_sex"]=$row["student_sex"];//

        if(session("user_name")==null){

            session('[destroy]');
            echo('<script type="text/javascript">alert("违法操作，请重新登录");window.location.href="'.SRC_PATH.'";</script>"');
            exit();
        }
        $student=M("student");
        $result=$student->add($data);
        if(!$result){
            echo "失败";
        }
        else{
            echo"成功";
        }
    }
    public function updatestudent_info(){
        if(session("user_name")==null){
            session('[destroy]');
            echo('<script type="text/javascript">alert("违法操作，请重新登录");window.location.href="'.SRC_PATH.'";</script>"');
            exit();
        }

        $row = I("post.row");
       $data["student_birthday"]=$row["student_birthday"];
       $data["student_tel"]=$row["student_tel"];
       $data["student_name"]=$row["student_name"];
       $data["student_remark"]=$row["student_remark"];//
       $data["student_sex"]=$row["student_sex"];//
        $student=M("student");
        $condition["student_id"]=$row['student_id'];
        $result=$student->where($condition)->save($data);
        if(!$result){
            echo "失败";
        }
        else{
            echo"成功";
        }
    }
    public function deletestudent_info(){
        if(session("user_name")==null){

            session('[destroy]');
            echo('<script type="text/javascript">alert("违法操作，请重新登录");window.location.href="'.SRC_PATH.'";</script>"');
            exit();
        }

        $ids =I("post.ids");
        $student=M("student");
        $condition["student_id"]=Array("IN","$ids");
        $result=$student->where($condition)->delete();
        echo $result;
    }
}





