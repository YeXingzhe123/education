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
        if(isset($_POST['name']) && !empty($_POST['name'])){
            $condition["name|no"]=I("post.name");//姓名或学号搜索
        }
        $student=M("teacher");
        $result=$student->where($condition)->order($sort.' '.$order)->page($page,$pagesize)->select();
        $json = json_encode($result);

        $total=$student->where($condition)->count();
        echo '{"total":'.$total.',"rows":'.$json.'}';
    }
    public function addteacher_info(){

        $row = I("post.row");
        $data["no"]=$row["no"];
        $data["birthday"]=$row["birthday"];
        $data["education"]=$row["education"];
        $data["id_card"]=$row["id_card"];
        $data["major"]=$row["major"];
        $data["name"]=$row["name"];
        $data["passowrd"]=$row["passowrd"];//grade_name属性的value值是grade_id
        $data["remark"]=$row["remark"];//
        $data["salary"]=$row["salary"];//
        $data["sex"]=$row["sex"];

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
        $data["no"]=$row["no"];
        $data["birthday"]=$row["birthday"];
        $data["education"]=$row["education"];
        $data["id_card"]=$row["id_card"];
        $data["major"]=$row["major"];
        $data["name"]=$row["name"];
        $data["password"]=$row["password"];//grade_name属性的value值是grade_id
        $data["remark"]=$row["remark"];//
        $data["salary"]=$row["salary"];//
        $data["sex"]=$row["sex"];
        if(session("user_name")==null){
            session('[destroy]');
            echo('<script type="text/javascript">alert("违法操作，请重新登录");window.location.href="'.SRC_PATH.'";</script>"');
            exit();
        }
        $teacher=M("teacher");
        $condition["id"]=$row['id'];
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
        $condition["id"]=Array("IN","$ids");
        $result=$teacher->where($condition)->delete();
        echo $result;

    }




    public function basicconfig(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        if(!IS_POST){
        $config=M('config');
        $result=$config->find();
        $this->assign("result",$result);
        $this->display("basicconfig");
        }
        else{
            $config=M('config');

            $data["start_time"]=I("post.start_time");
            $data["advisor_choosetype"]=I("post.advisor_choosetype");

            $result=$config->where("id=1")->save($data);
            if($result){
                echo("成功");

            }
            else{
                echo("失败");
            }
        }
    }
    //班级管理
    public function grade_management(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $this->display("grade_management");
    }
    public function readallgrade_management_group(){
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        $condition["grade_college_id"]=session("college_id");

        $condition["grade_id"]=Array("GT",50);

        $grade=M("grade");
        $result=$grade->where($condition)->order($sort.' '.$order)->page($page,$pagesize)->select();
        $json = json_encode($result);
        $count=$grade->where($condition)->count();
        echo '{"total":'.$count.',"rows":'.$json.'}';
    }
    public function addgrade_management_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }

        $row = I("post.row");
        $data["grade_name"]=$row["grade_name"];


        $data["grade_college_id"]=session("college_id");

        $grade=M("grade");
        $result=$grade->add($data);
        if(!$result){
            echo "失败";
        }
        else{
            echo"成功";
        }
    }
    public function updategrade_management_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }

        $row = I("post.row");
        $data["grade_name"]=$row["grade_name"];

        $condition["grade_id"]=$row["grade_id"];
        $grade=M("grade");
        $result=$grade->where($condition)->save($data);
        if(!$result){
            echo "失败";
        }
        else{
            echo"成功";
        }
    }
    public function deletegrade_management_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $ids =I("post.ids");
        $grade=M("grade");
        $student=M("student");

        $data["student_grade_id"]=session("college_id");

        $condition["grade_id"]=Array("IN","$ids");
        $condition1["student_grade_id"]=Array("IN","$ids");
        $result=$grade->where($condition)->delete();
        $result1=$student->where($condition1)->save($data);


        echo $result;
    }
    //系部管理
    public function faculty_management(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $this->display("faculty_management");
    }
    public function readallfaculty_management_group(){
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        $condition["faculty_college_id"]=session("college_id");

        $condition["id"]=Array("GT",50);

        $faculty=M("faculty");
        $result=$faculty->where($condition)->order($sort.' '.$order)->page($page,$pagesize)->select();
        $json = json_encode($result);
        $count=$faculty->where($condition)->count();
        echo '{"total":'.$count.',"rows":'.$json.'}';
    }
    public function addfaculty_management_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }

        $row = I("post.row");
        $data["faculty_name"]=$row["faculty_name"];


        $data["faculty_college_id"]=session("college_id");

        $faculty=M("faculty");
        $result=$faculty->add($data);
        if(!$result){
            echo "失败";
        }
        else{
            echo"成功";
        }
    }
    public function updatefaculty_management_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }

        $row = I("post.row");
        $data["faculty_name"]=$row["faculty_name"];

        $condition["id"]=$row["id"];
        $faculty=M("faculty");
        $result=$faculty->where($condition)->save($data);
        if(!$result){
            echo "失败";
        }
        else{
            echo"成功";
        }
    }
    public function deletefaculty_management_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $ids =I("post.ids");
        $faculty=M("faculty");
        $advisor=M("advisor");
        $data["faculty_id"]=session("college_id");//与数据库表设计有关，设计了50个保留字段

        $condition["id"]=Array("IN","$ids");
        $condition1["faculty_id"]=Array("IN","$ids");
        $result=$faculty->where($condition)->delete();

        $result2=$advisor->where($condition1)->save($data);

        echo $result;
    }
    public function passwordchange(){
        if(session("user_name")==""||session("role")!=2){
            session('[destroy]');
            echo(" <script type='text/javascript'>alert('发生错误，请重新登录');window.location.reload();</script>");
            exit();
        }
        $this->display("passwordchange");
    }
    public function password_update(){

        if(session("user_name")==""||session("role")!=2){
            session('[destroy]');
            echo(" <script type='text/javascript'>alert('发生错误，请重新登录');window.location.reload();</script>");
            exit();
        }
        $condition["username"]=session("user_name");
        $condition["password"]=I("post.old_psd");
        $data["password"]=I("post.new_psd");
        $admin=M("admin");
        $result=$admin->where($condition)->save($data);
        if(!$result){
            echo "失败";
        }
        else{
            echo"成功";
        }

    }
    //学生管理
    public function addstudent(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo('<script type="text/javascript">alert("发生错误，请重新登录");window.location.href="'.SRC_PATH.'";</script>"');
            exit();
        }
        $this->display("addstudent");
    }
    public function readallstudent(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo('<script type="text/javascript">alert("发生错误，请重新登录");window.location.href="'.SRC_PATH.'";</script>"');
            exit();
        }
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        $condition["student_college_id"]=session("college_id");
        if(isset($_POST['student_name']) && !empty($_POST['student_name'])){
            $condition["student_name|student_no"]=I("post.student_name");//姓名或学号搜索

        }
        $student=M("student");
        $result=$student->join('grade on student.student_grade_id=grade.grade_id')->where($condition)->order($sort.' '.$order)->page($page,$pagesize)->select();
        $json = json_encode($result);

        $total=$student->where($condition)->count();
        echo '{"total":'.$total.',"rows":'.$json.'}';
    }
    public function addstudent_info(){

        $row = I("post.row");
        $data["student_name"]=$row["student_name"];
        $data["student_no"]=$row["student_no"];
        $data["student_password"]=$row["student_password"];
        $data["student_tel"]=$row["student_tel"];
        $data["student_email"]=$row["student_email"];
        $data["student_sex"]=$row["student_sex"];
        $data["student_grade_id"]=$row["grade_name"];//grade_name属性的value值是grade_id
        $data["student_college_id"]=session("college_id");

        if(session("user_name")==null||session("role")!=2){

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
        $row = I("post.row");
        $data["student_name"]=$row["student_name"];
        $data["student_no"]=$row["student_no"];
        $data["student_password"]=$row["student_password"];
        $data["student_tel"]=$row["student_tel"];
        $data["student_email"]=$row["student_email"];
        $data["student_sex"]=$row["student_sex"];
        $data["student_grade_id"]=$row["grade_name"];//grade_name属性的value值是grade_id
        $data["student_college_id"]=session("college_id");
        $condition["student_id"]=$row["student_id"];
        if(session("user_name")==null||session("role")!=2){
            session('[destroy]');
            echo('<script type="text/javascript">alert("违法操作，请重新登录");window.location.href="'.SRC_PATH.'";</script>"');
            exit();
        }
        $student=M("student");
        $result=$student->where($condition)->save($data);
        if(!$result){
            echo "失败";
        }
        else{
            echo"成功";
        }

    }
    public function deletestudent_info(){
        if(session("user_name")==null||session("role")!=2){

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

    ///添加导师
    public function addadvisor(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $this->display("addadvisor");


    }
    public function readalladvisor(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        $condition["college_id"]=session("college_id");
        if(isset($_POST['advisor_name']) && !empty($_POST['advisor_name'])){
            $condition["advisor_name|advisor_no"]=I("post.advisor_name");//姓名或学号搜索

        }
        $advisor=M("advisor");
        $result=$advisor->join('faculty on advisor.faculty_id=faculty.id')->where($condition)->order($sort.' '.$order)->page($page,$pagesize)->select();
        $json = json_encode($result);

        $total=$advisor->where($condition)->count();
        echo '{"total":'.$total.',"rows":'.$json.'}';
    }
    public  function  addadvisor_info(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }

        $row = I("post.row");
        $data["advisor_name"]=$row["advisor_name"];
        $data["advisor_no"]=$row["advisor_no"];
        $data["advisor_password"]=$row["advisor_password"];
        $data["tel"]=$row["tel"];
        $data["email"]=$row["email"];
        $data["student_total"]=$row["student_total"];
        $data["student_remain"]=$row["student_total"];
        if(is_int($row["faculty_name"])){
            $data["faculty_id"]=$row["faculty_name"];//
        }

        $data["college_id"]=session("college_id");

        $advisor=M("advisor");
        $result=$advisor->add($data);
        if(!$result){
            echo "失败";
        }
        else{
            echo"成功";
        }


    }
    public function updateadvisor_info(){
        $row = I("post.row");
        $data["advisor_name"]=$row["advisor_name"];
        $data["advisor_no"]=$row["advisor_no"];
        $data["advisor_password"]=$row["advisor_password"];
        $data["tel"]=$row["tel"];
        $data["email"]=$row["email"];
        $data["student_total"]=$row["student_total"];
        if($row["faculty_name"]==""){
            $data["faculty_id"]=1;
        }
        else{
        $data["faculty_id"]=$row["faculty_name"];
        }//
        $data["college_id"]=session("college_id");

        $condition["advisor_id"]=$row["advisor_id"];
        $advisor=M("advisor");
        $result=$advisor->where($condition)->find();
        if($result){
            if($result["student_total"]==$result["student_remain"]){//如果相等说明还没有选导师
                $data["student_remain"]==$row["student_total"];
            }
            else{
                $data["student_remain"]=$result["student_remain"]+($row["student_total"]-$result["student_total"]);
            }
            $result1=$advisor->where($condition)->save($data);
            if($result1){
                echo("成功");
            }
            else{
                echo("失败");
            }
        }
    }
    public function deleteadvisor_info(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }

        $ids =I("post.ids");
        $advisor=M("advisor");
        $condition["advisor_id"]=Array("IN","$ids");
        $result=$advisor->where($condition)->delete();
        echo $result;

    }
    //分配导师
    public function student_advisor(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $this->display("student_advisor");
    }
    public function readalladvisor_assign(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        $condition["college_id"]=session("college_id");
        $condition["student_remain"]=Array("GT",0);//只读取有剩余学生数的 导师。

        if(isset($_POST['advisor_name']) && !empty($_POST['advisor_name'])){
            $condition["advisor_name|advisor_no"]=I("post.advisor_name");//姓名或学号搜索

        }
        $advisor=M("advisor");
        $result=$advisor->join('faculty on advisor.faculty_id=faculty.id')->where($condition)->order($sort.' '.$order)->page($page,$pagesize)->select();
        $json = json_encode($result);

        $total=$advisor->where($condition)->count();
        echo '{"total":'.$total.',"rows":'.$json.'}';
    }
    public function readallstudent_assign(){//读取所有未分配老师学生信息
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        $condition["student_college_id"]=session("college_id");
        $condition["advisor_id"]=0;
        if(isset($_POST['student_name']) && !empty($_POST['student_name'])){
            $condition["student_name|student_no"]=I("post.student_name");//姓名或学号搜索

        }
        $student=M("student");
        $result=$student->join('grade on student.student_grade_id=grade.grade_id')->where($condition)->order($sort.' '.$order)->page($page,$pagesize)->select();
        $json = json_encode($result);

        $total=$student->where($condition)->count();
        echo '{"total":'.$total.',"rows":'.$json.'}';
    }
    public function advisor_student_assign(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $ids =I("post.ids");
        $data["advisor_id"]=I("post.advisor_id");
        $data["schedule_id"]=21;
        $condition1["advisor_id"]=I("post.advisor_id");
        $student=M("student");
        $advisor=M("advisor");
        $result1=$advisor->where($condition1)->find();
        if(!$result1){
            echo("错误");
            exit();
        }

        $condition["student_id"]=Array("IN","$ids");
        $student->startTrans();
        $result2=$student->where($condition)->save($data);
        if(!$result2){
            echo("错误");
            exit();
        }
        else{
            if($result2>$result1["student_remain"]){
                $student->rollback();
                echo("错误");
                exit();
            }
            else{
                $data1["student_remain"]=$result1["student_remain"]-$result2;
                $result3=$advisor->where($data)->save($data1);
                if(!$result3){
                    $student->rollback();
                    echo("错误");
                    exit();
                }
                else{
                    $student->commit();
                    echo("成功");
                    exit();
                }
            }
        }
    }
    public function student_advisor_alert(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $this->display("student_advisor_alert");

    }
    public function read_allstudent_alert(){//读取已经选择导师的学生信息 所有的
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        $condition["student_college_id"]=session("college_id");
        $student=M("student");
        //$condition["student"]["advisor_id"]=Array("GT",0);
        if(isset($_POST['student_name']) && !empty($_POST['student_name'])){
            $condition["student_name|student_no"]=I("post.student_name");//姓名或学号搜索


        }
        $result=$student->join('grade on student.student_grade_id=grade.grade_id')->
            join('advisor on student.advisor_id=advisor.advisor_id')->where("student.advisor_id>0")->where($condition)->order($sort.' '.$order)->page($page,$pagesize)->select();
        $json = json_encode($result);
        $total=$student->where("student.advisor_id>0")->where($condition)->count();
        echo '{"total":'.$total.',"rows":'.$json.'}';

    }
    public  function advisor_alert_window(){//读取弹出窗口数据。
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $student_id=I("get.student_id");
        $this->assign("id",$student_id);
        $this->display("advisor_alert_window");
    }
    public  function advisor_alert_submit(){//提交更改
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $condition_student["student_id"]=I("post.student_id");
        $condition_advisor["advisor_id"]=I("post.advisor_id");//更新后的导师id信息
        $student=M("student");

        $result_student=$student->where($condition_student)->find();
        if($result_student){
            $condition_advisor_old["advisor_id"]=$result_student["advisor_id"];
            $advisor=M("advisor");
            $result_advisor=$advisor->where($condition_advisor)->find();
            if($result_advisor&&$result_advisor["student_remain"]>0){
                $advisor->startTrans();
                $result1=$advisor->where($condition_advisor)->setDec("student_remain",1);
                $result2=$advisor->where($condition_advisor_old)->setInc("student_remain",1);
                if($result1&&$result2){
                   $result3= $student->where($condition_student)->save($condition_advisor);

                   if($result3){
                       $advisor->commit();
                       echo("成功");
                   }
                    else{
                        $advisor->rollback();
                        echo("失败1");
                    }
                }
                else{
                    $advisor->rollback();
                    echo("失败2");
                }
            }

        }

    }
    //通知信息发布区域
    public function public_templete(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $this->display("public_templete");
    }
    public function readalltemplete(){
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        $condition["college_id"]=session("college_id");

        //$condition["student"]["advisor_id"]=Array("GT",0);
        if(isset($_POST['templete_name']) && !empty($_POST['templete_name'])){
            $condition1["templete_name"]=Array("LIKE","%".I("post.templete_name")."%");//姓名或学号搜索


        }
        $templete=D("templete");
        $result=$templete->where($condition)->where($condition1)->order($sort.' '.$order)->page($page,$pagesize)->select();
        $json = json_encode($result);
        $count=$templete->where($condition)->where($condition1)->count();
        echo '{"total":'.$count.',"rows":'.$json.'}';

    }
    public function add_templete(){
        $this->display("add_templete");
    }
    public function save_templete(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
       $data["templete_name"]=I("post.templete_name");
        $data["templete_file"]=I("post.templetefile_name");
        $data["submit_time"]=date('Y-m-d H:i:s',time());
        $data["college_id"]=session("college_id");
        $templete=M("templete");
        $result=$templete->add($data);
        if(!$result){
            echo("错误");
        }
        else{
            echo("成功");
        }



    }
    public function delete_templete(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $ids =I("post.ids");
        $templete=M("templete");
        $condition["id"]=Array("IN","$ids");
        $result=$templete->where($condition)->delete();
        echo $result;

    }
    //添加信息
    public function public_notice(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $this->display("public_notice");

    }
    public function readallnotice(){
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        $condition["college_id"]=session("college_id");

        //$condition["student"]["advisor_id"]=Array("GT",0);
        if(isset($_POST['notice_name']) && !empty($_POST['notice_name'])){
            $condition1["title"]=Array("LIKE","%".I("post.notice_name")."%");//姓名或学号搜索


        }
        $notice=D("notice");
        $result=$notice->where($condition)->where($condition1)->order($sort.' '.$order)->page($page,$pagesize)->select();
        $json = json_encode($result);
        $count=$notice->where($condition)->where($condition1)->count();
        echo '{"total":'.$count.',"rows":'.$json.'}';
    }
    public function addnotice(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $this->display("addnotice");
    }
    public function save_notice(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $data["title"]=I("post.notice_title");
        $data["is_top"]=I("post.is_top");
        $data["type"]=I("post.notice_type");
        $data["content"]=I("post.content");
        $data["submit_time"]=date('Y-m-d H:i:s',time());
        $data["college_id"]=session("college_id");
        $notice=M("notice");
        $notice->add($data);
        if($notice){
            echo("成功");
        }
        else{
            echo("失败");

        }

    }
    public function shownotice(){

        $condition["id"]=I("get.id");
        $notice=M("notice");
        $result=$notice->where($condition)->find();
        if(!$result){
            $this->display("ceshi");
        }
        else{
            $this->assign("result",$result);
            $this->display("shownotice");
        }

    }
    public function update_notice(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $condition["id"]=I("get.id");
        $notice=M("notice");
        $result=$notice->where($condition)->find();

        if(!$result){
            $this->display("ceshi");
        }
        else{
            $this->assign("result",$result);
            $this->display("update_notice");
        }

    }
    public function save_update_notice(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $condition["id"]=I("post.id");
        $data["title"]=I("post.notice_update_title");
        $data["is_top"]=I("post.update_is_top");
        $data["type"]=I("post.notice_update_type");
        $data["content"]=I("post.update_content");
       // $data["submit_time"]=date('Y-m-d H:i:s',time());
       // $data["college_id"]=session("college_id");
        $notice=M("notice");
       $result=$notice->where($condition)->save($data);
        if(!$result){
           echo("失败");
        }
        else{
            echo("成功");
        }

    }
    public function delete_notice(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $ids =I("post.ids");
        $notice=M("notice");
        $condition["id"]=Array("IN","$ids");
        $result=$notice->where($condition)->delete();
        echo $result;
    }
    //答辩分组管理
    public function proposal_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $this->display("proposal_group");
    }
    public function readallproposal_group(){
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        $condition["proposal_college_id"]=session("college_id");

        //$condition["student"]["advisor_id"]=Array("GT",0);

        $proposal_group=M("proposal_group");
        $result=$proposal_group->where($condition)->order($sort.' '.$order)->page($page,$pagesize)->select();
        $json = json_encode($result);
        $count=$proposal_group->where($condition)->count();
        echo '{"total":'.$count.',"rows":'.$json.'}';

    }
    public function addproposal_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }

        $row = I("post.row");
        $data["group_name"]=$row["group_name"];
        $data["remark"]=$row["remark"];

        $data["proposal_college_id"]=session("college_id");

        $proposal_group=M("proposal_group");
        $result=$proposal_group->add($data);
        if(!$result){
            echo "失败";
        }
        else{
            echo"成功";
        }
    }
    public function updateproposal_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }

        $row = I("post.row");
        $data["group_name"]=$row["group_name"];
        $data["remark"]=$row["remark"];
        $condition["id"]=$row["id"];
        $proposal_group=M("proposal_group");
        $result=$proposal_group->where($condition)->save($data);
        if(!$result){
            echo "失败";
        }
        else{
            echo"成功";
        }
    }
    public function deleteproposal_group(){
    if(session("user_name")==null||session("role")!=2){

        session('[destroy]');
        echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
        exit();
    }
    $ids =I("post.ids");
    $proposal_group=M("proposal_group");
    $student=M("student");
    $advisor=M("advisor");
    $data["proposal_group_id"]=0;

    $condition["id"]=Array("IN","$ids");
    $condition1["proposal_group_id"]=Array("IN","$ids");
    $result=$proposal_group->where($condition)->delete();
    $result1=$student->where($condition1)->save($data);
     $result2=$advisor->where($condition1)->save($data);

        echo $result;
    }
////导师开题分组管理
    public function proposal_advisor_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $this->display("proposal_advisor_group");

    }
    public function read_advisor_proposal_group_alert(){

        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        $condition["college_id"]=session("college_id");
        $advisor=M("advisor");
        //$condition["student"]["advisor_id"]=Array("GT",0);
        if(isset($_POST['advisor_proposal_name']) && !empty($_POST['advisor_proposal_name'])){
            $condition["advisor_name|advisor_no"]=I("post.advisor_name");//姓名或学号搜索


        }
        $result=$advisor->join('faculty on advisor.faculty_id=faculty.id')
            ->join('proposal_group on proposal_group.id=advisor.proposal_group_id')
            ->where('proposal_group_id>0')
            ->where($condition)->order($sort.' '.$order)->page($page,$pagesize)->select();// join('left join proposal_group on proposal_group.id=advisor.proposal_group_id')->
        $json = json_encode($result);

        $total=$result=$advisor->join('faculty on advisor.faculty_id=faculty.id')
            ->join('proposal_group on proposal_group.id=advisor.proposal_group_id')
            ->where('proposal_group_id>0')
            ->where($condition)->count();
        echo '{"total":'.$total.',"rows":'.$json.'}';


    }
    public function readallproposal_group_comb(){
        $condition["proposal_college_id"]=session("college_id");
        $proposal_group=M("proposal_group");
        $result=$proposal_group->where($condition)->select();
        $json = json_encode($result);
        echo($json);
    }
    public function update_advisor_proposal_group(){//保存更新的信息
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $row = I("post.row");
        $condition["advisor_id"]=$row["advisor_id"];
        $data["proposal_group_id"]=$row["group_name"];
        $advisor=M("advisor");
        $result=$advisor->where($condition)->save($data);
        if($result)
        {
            echo "成功";
        }
        else{
            echo "失败";
        }



    }
    public function readalladvisor_notassign(){//读取所有未分配导师
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        $condition["college_id"]=session("college_id");
        $condition["proposal_group_id"]=0;
        if(isset($_POST['advisor_name']) && !empty($_POST['advisor_name'])){
            $condition["advisor_name|advisor_no"]=I("post.advisor_name");//姓名或学号搜索

        }
        $advisor=M("advisor");
        $result=$advisor->join('faculty on advisor.faculty_id=faculty.id')->where($condition)->order($sort.' '.$order)->page($page,$pagesize)->select();
        $json = json_encode($result);

        $total=$advisor->where($condition)->count();
        echo '{"total":'.$total.',"rows":'.$json.'}';
    }
    public function proposal_advisor_assign_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $ids =I("post.ids");
        $condition["advisor_id"]=Array("IN","$ids");
        $data["proposal_group_id"]=I("post.id");

        $advisor=M("advisor");
        $result=$advisor->where($condition)->save($data);
        if($result)
        {
            echo"成功";
        }

    }
//学生开题分组管理
    public function proposal_student_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $this->display("proposal_student_group");

    }
    public function read_student_proposal_group_alert(){

        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        $condition["student_college_id"]=session("college_id");
        $student=M("student");
        //$condition["student"]["advisor_id"]=Array("GT",0);
        if(isset($_POST['student_proposal_name']) && !empty($_POST['student_proposal_name'])){
            $condition["student_name|student_no"]=I("post.advisor_name");//姓名或学号搜索


        }
        $result=$student->join('grade on student.student_grade_id=grade.grade_id')
            ->join('proposal_group on proposal_group.id=student.proposal_group_id')
            ->join('advisor on student.advisor_id=advisor.advisor_id')
            ->where($condition)->order($sort.' '.$order)->page($page,$pagesize)->select();// join('left join proposal_group on proposal_group.id=advisor.proposal_group_id')->
        $json = json_encode($result);

        $total=$student->join('grade on student.student_grade_id=grade.grade_id')
            ->join('proposal_group on proposal_group.id=student.proposal_group_id')
            ->join('advisor on student.advisor_id=advisor.advisor_id')
            ->where($condition)->count();
        echo '{"total":'.$total.',"rows":'.$json.'}';
    }
    public function update_student_proposal_group(){//保存更新的信息
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $row = I("post.row");
        $condition["student_id"]=$row["student_id"];
        $data["proposal_group_id"]=$row["group_name"];
        $student=M("student");
        $result=$student->where($condition)->save($data);
        if($result)
        {
            echo "成功";
        }
        else{
            echo "失败";
        }



    }
    public function readallstudent_notassign(){//读取所有未分配导师
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        $condition["student_college_id"]=session("college_id");

        if(isset($_POST['student_name']) && !empty($_POST['student_name'])){
            $condition["student_name|student_no"]=I("post.student_name");//姓名或学号搜索

        }
        $student=M("student");
        $result=$student->join('grade on student.student_grade_id=grade.grade_id')->join('advisor on student.advisor_id=advisor.advisor_id')
            ->where($condition)->where('student.proposal_group_id=0')->order($sort.' '.$order)->page($page,$pagesize)->select();
        $json = json_encode($result);

        $total=$student->where($condition)->count();
        echo '{"total":'.$total.',"rows":'.$json.'}';
    }
    public function proposal_student_assign_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $ids =I("post.ids");
        $condition["student_id"]=Array("IN","$ids");
        $data["proposal_group_id"]=I("post.id");

        $student=M("student");
        $result=$student->where($condition)->save($data);
        if($result)
        {
            echo"成功";
        }

    }
    public function proposal_student_auto_assign_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $condition["college_id"]=session("college_id");
        $condition["proposal_group_id"]=0;
        $advisor=M("advisor");
        $result=$advisor->where($condition)->count();
        if($result>0)
        {
            echo"失败";
            exit();
        }
        else{
            $proposal_group=M("proposal_group");
            $condition5["proposal_college_id"]=session("college_id");
            $result=$proposal_group->where($condition5)->select();
            $count=count($result);
            $advisor=M("advisor");
            $student=M("student");
            //echo "22";

            for($i=0;$i<$count;$i++){
                $condition["proposal_group_id"]=$result[$i]["id"];
                $result1=$advisor->where($condition)->select();
                $ids="";//组内所有的导师id
               // echo($result[$i]["id"]);
                $count2=count($result1);

                for($j=0;$j<$count2;$j++){
                    if($j==$count2-1){
                        $ids=$ids.$result1[$j]["advisor_id"];
                    }
                    else{
                        $ids=$ids.$result1[$j]["advisor_id"].",";
                    }
                }
               // echo("$ids");
                $condition1["advisor_id"]=Array("IN","$ids");
                $condition1["proposal_group_id"]=0;
                if($i==$count-1){
                    $data["proposal_group_id"]=$result[0]["id"];
                }
                else{
                    $data["proposal_group_id"]=$result[$i+1]["id"];
                }
                $result2=$student->where($condition1)->save($data);
                if($result2){
                    echo("1");
                }

            }



        }
    }
    //中期分组
    public function interim_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $this->display("interim_group");

    }
    public function readallinterim_group(){
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        $condition["interim_college_id"]=session("college_id");

        //$condition["student"]["advisor_id"]=Array("GT",0);

        $interim_group=M("interim_group");
        $result=$interim_group->where($condition)->order($sort.' '.$order)->page($page,$pagesize)->select();
        $json = json_encode($result);
        $count=$interim_group->where($condition)->count();
        echo '{"total":'.$count.',"rows":'.$json.'}';
    }
    public function addinterim_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }

        $row = I("post.row");
        $data["group_name"]=$row["group_name"];
        $data["remark"]=$row["remark"];

        $data["interim_college_id"]=session("college_id");

        $interim_group=M("interim_group");
        $result=$interim_group->add($data);
        if(!$result){
            echo "失败";
        }
        else{
            echo"成功";
        }
    }
    public function updateinterim_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }

        $row = I("post.row");
        $data["group_name"]=$row["group_name"];
        $data["remark"]=$row["remark"];
        $condition["id"]=$row["id"];
        $interim_group=M("interim_group");
        $result=$interim_group->where($condition)->save($data);
        if(!$result){
            echo "失败";
        }
        else{
            echo"成功";
        }
    }
    public function deleteinterim_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $ids =I("post.ids");
        $interim_group=M("interim_group");
        $student=M("student");
        $advisor=M("advisor");
        $data["interim_group_id"]=0;

        $condition["id"]=Array("IN","$ids");
        $condition1["interim_group_id"]=Array("IN","$ids");
        $result=$interim_group->where($condition)->delete();
        $result1=$student->where($condition1)->save($data);
        $result2=$advisor->where($condition1)->save($data);

        echo $result;
    }
    //中期导师分组
    public function interim_advisor_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $this->display("interim_advisor_group");

    }

    public function read_advisor_interim_group_alert(){

        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        $condition["college_id"]=session("college_id");
        $advisor=M("advisor");
        //$condition["student"]["advisor_id"]=Array("GT",0);
        if(isset($_POST['advisor_interim_name']) && !empty($_POST['advisor_interim_name'])){
            $condition["advisor_name|advisor_no"]=I("post.advisor_name");//姓名或学号搜索


        }
        $result=$advisor->join('faculty on advisor.faculty_id=faculty.id')
            ->join('interim_group on interim_group.id=advisor.interim_group_id')
            ->where('interim_group_id>0')
            ->where($condition)->order($sort.' '.$order)->page($page,$pagesize)->select();// join('left join interim_group on interim_group.id=advisor.interim_group_id')->
        $json = json_encode($result);

        $total=$result=$advisor->join('faculty on advisor.faculty_id=faculty.id')
            ->join('interim_group on interim_group.id=advisor.interim_group_id')
            ->where('interim_group_id>0')
            ->where($condition)->count();
        echo '{"total":'.$total.',"rows":'.$json.'}';


    }
    public function readallinterim_group_comb(){
        $condition["interim_college_id"]=session("college_id");
        $interim_group=M("interim_group");
        $result=$interim_group->where($condition)->select();
        $json = json_encode($result);
        echo($json);
    }
    public function update_advisor_interim_group(){//保存更新的信息
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $row = I("post.row");
        $condition["advisor_id"]=$row["advisor_id"];
        $data["interim_group_id"]=$row["group_name"];
        $advisor=M("advisor");
        $result=$advisor->where($condition)->save($data);
        if($result)
        {
            echo "成功";
        }
        else{
            echo "失败";
        }

    }
    public function readalladvisor_notinterimassign(){//读取所有未分配导师
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        $condition["college_id"]=session("college_id");
        $condition["interim_group_id"]=0;
        if(isset($_POST['advisor_name']) && !empty($_POST['advisor_name'])){
            $condition["advisor_name|advisor_no"]=I("post.advisor_name");//姓名或学号搜索

        }
        $advisor=M("advisor");
        $result=$advisor->join('faculty on advisor.faculty_id=faculty.id')->where($condition)->order($sort.' '.$order)->page($page,$pagesize)->select();
        $json = json_encode($result);

        $total=$advisor->where($condition)->count();
        echo '{"total":'.$total.',"rows":'.$json.'}';
    }
    public function interim_advisor_assign_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $ids =I("post.ids");
        $condition["advisor_id"]=Array("IN","$ids");
        $data["interim_group_id"]=I("post.id");

        $advisor=M("advisor");
        $result=$advisor->where($condition)->save($data);
        if($result)
        {
            echo"成功";
        }

    }
///所有学生中期分组管理
    public function interim_student_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $this->display("interim_student_group");

    }
    public function read_student_interim_group_alert(){

        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        $condition["student_college_id"]=session("college_id");
        $student=M("student");
        //$condition["student"]["advisor_id"]=Array("GT",0);
        if(isset($_POST['student_interim_name']) && !empty($_POST['student_interim_name'])){
            $condition["student_name|student_no"]=I("post.advisor_name");//姓名或学号搜索


        }
        $result=$student->join('grade on student.student_grade_id=grade.grade_id')
            ->join('interim_group on interim_group.id=student.interim_group_id')
            ->join('advisor on student.advisor_id=advisor.advisor_id')
            ->where($condition)->order($sort.' '.$order)->page($page,$pagesize)->select();// join('left join interim_group on interim_group.id=advisor.interim_group_id')->
        $json = json_encode($result);

        $total=$student->join('grade on student.student_grade_id=grade.grade_id')
            ->join('interim_group on interim_group.id=student.interim_group_id')
            ->join('advisor on student.advisor_id=advisor.advisor_id')
            ->where($condition)->count();
        echo '{"total":'.$total.',"rows":'.$json.'}';
    }
    public function update_student_interim_group(){//保存更新的信息
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $row = I("post.row");
        $condition["student_id"]=$row["student_id"];
        $data["interim_group_id"]=$row["group_name"];
        $student=M("student");
        $result=$student->where($condition)->save($data);
        if($result)
        {
            echo "成功";
        }
        else{
            echo "失败";
        }



    }
    public function readallstudent_notinterimassign(){//读取所有未分配导师
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        $condition["student_college_id"]=session("college_id");

        if(isset($_POST['student_name']) && !empty($_POST['student_name'])){
            $condition["student_name|student_no"]=I("post.student_name");//姓名或学号搜索

        }
        $student=M("student");
        $result=$student->join('grade on student.student_grade_id=grade.grade_id')->join('advisor on student.advisor_id=advisor.advisor_id')
            ->where($condition)->where('student.interim_group_id=0')->order($sort.' '.$order)->page($page,$pagesize)->select();
        $json = json_encode($result);

        $total=$student->where($condition)->count();
        echo '{"total":'.$total.',"rows":'.$json.'}';
    }
    public function interim_student_assign_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $ids =I("post.ids");
        $condition["student_id"]=Array("IN","$ids");
        $data["interim_group_id"]=I("post.id");

        $student=M("student");
        $result=$student->where($condition)->save($data);
        if($result)
        {
            echo"成功";
        }

    }
    public function interim_student_auto_assign_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $condition["college_id"]=session("college_id");
        $condition["interim_group_id"]=0;
        $advisor=M("advisor");
        $result=$advisor->where($condition)->count();
        if($result>0)
        {
            echo"失败";
            exit();
        }
        else{
            $interim_group=M("interim_group");
            $condition5["interim_college_id"]=session("college_id");
            $result=$interim_group->where($condition5)->select();
            $count=count($result);
            $advisor=M("advisor");
            $student=M("student");
            //echo "22";

            for($i=0;$i<$count;$i++){
                $condition["interim_group_id"]=$result[$i]["id"];
                $result1=$advisor->where($condition)->select();
                $ids="";//组内所有的导师id
                // echo($result[$i]["id"]);
                $count2=count($result1);

                for($j=0;$j<$count2;$j++){
                    if($j==$count2-1){
                        $ids=$ids.$result1[$j]["advisor_id"];
                    }
                    else{
                        $ids=$ids.$result1[$j]["advisor_id"].",";
                    }
                }
                // echo("$ids");
                $condition1["advisor_id"]=Array("IN","$ids");
                $condition1["interim_group_id"]=0;
                if($i==$count-1){
                    $data["interim_group_id"]=$result[0]["id"];
                }
                else{
                    $data["interim_group_id"]=$result[$i+1]["id"];
                }
                $result2=$student->where($condition1)->save($data);
                if($result2){
                    echo("1");
                }

            }



        }
    }
    //毕业答辩分组
    public function paper_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $this->display("paper_group");

    }
    public function readallpaper_group(){
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        $condition["paper_college_id"]=session("college_id");

        //$condition["student"]["advisor_id"]=Array("GT",0);

        $paper_group=M("paper_group");
        $result=$paper_group->where($condition)->order($sort.' '.$order)->page($page,$pagesize)->select();
        $json = json_encode($result);
        $count=$paper_group->where($condition)->count();
        echo '{"total":'.$count.',"rows":'.$json.'}';
    }
    public function addpaper_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }

        $row = I("post.row");
        $data["group_name"]=$row["group_name"];
        $data["remark"]=$row["remark"];

        $data["paper_college_id"]=session("college_id");

        $paper_group=M("paper_group");
        $result=$paper_group->add($data);
        if(!$result){
            echo "失败";
        }
        else{
            echo"成功";
        }
    }
    public function updatepaper_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }

        $row = I("post.row");
        $data["group_name"]=$row["group_name"];
        $data["remark"]=$row["remark"];
        $condition["id"]=$row["id"];
        $paper_group=M("paper_group");
        $result=$paper_group->where($condition)->save($data);
        if(!$result){
            echo "失败";
        }
        else{
            echo"成功";
        }
    }
    public function deletepaper_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $ids =I("post.ids");
        $grade=M("grade");
        $student=M("student");
        $data["student_grade_id"]=session("college_id");

        $condition["id"]=Array("IN","$ids");
        $condition1["paper_group_id"]=Array("IN","$ids");
        $result=$grade->where($condition)->delete();
        $result1=$student->where($condition1)->save($data);

        echo $result;
    }
    //毕业导师分组
    public function paper_advisor_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $this->display("paper_advisor_group");

    }

    public function read_advisor_paper_group_alert(){

        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        $condition["college_id"]=session("college_id");
        $advisor=M("advisor");
        //$condition["student"]["advisor_id"]=Array("GT",0);
        if(isset($_POST['advisor_paper_name']) && !empty($_POST['advisor_paper_name'])){
            $condition["advisor_name|advisor_no"]=I("post.advisor_name");//姓名或学号搜索


        }
        $result=$advisor->join('faculty on advisor.faculty_id=faculty.id')
            ->join('paper_group on paper_group.id=advisor.paper_group_id')
            ->where('paper_group_id>0')
            ->where($condition)->order($sort.' '.$order)->page($page,$pagesize)->select();// join('left join paper_group on paper_group.id=advisor.paper_group_id')->
        $json = json_encode($result);

        $total=$result=$advisor->join('faculty on advisor.faculty_id=faculty.id')
            ->join('paper_group on paper_group.id=advisor.paper_group_id')
            ->where('paper_group_id>0')
            ->where($condition)->count();
        echo '{"total":'.$total.',"rows":'.$json.'}';


    }
    public function readallpaper_group_comb(){
        $condition["paper_college_id"]=session("college_id");
        $paper_group=M("paper_group");
        $result=$paper_group->where($condition)->select();
        $json = json_encode($result);
        echo($json);
    }
    public function update_advisor_paper_group(){//保存更新的信息
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $row = I("post.row");
        $condition["advisor_id"]=$row["advisor_id"];
        $data["paper_group_id"]=$row["group_name"];
        $advisor=M("advisor");
        $result=$advisor->where($condition)->save($data);
        if($result)
        {
            echo "成功";
        }
        else{
            echo "失败";
        }

    }
    public function readalladvisor_notpaperassign(){//读取所有未分配导师
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        $condition["college_id"]=session("college_id");
        $condition["paper_group_id"]=0;
        if(isset($_POST['advisor_name']) && !empty($_POST['advisor_name'])){
            $condition["advisor_name|advisor_no"]=I("post.advisor_name");//姓名或学号搜索

        }
        $advisor=M("advisor");
        $result=$advisor->join('faculty on advisor.faculty_id=faculty.id')->where($condition)->order($sort.' '.$order)->page($page,$pagesize)->select();
        $json = json_encode($result);

        $total=$advisor->where($condition)->count();
        echo '{"total":'.$total.',"rows":'.$json.'}';
    }
    public function paper_advisor_assign_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $ids =I("post.ids");
        $condition["advisor_id"]=Array("IN","$ids");
        $data["paper_group_id"]=I("post.id");

        $advisor=M("advisor");
        $result=$advisor->where($condition)->save($data);
        if($result)
        {
            echo"成功";
        }

    }
///所有学生毕业分组管理
    public function paper_student_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $this->display("paper_student_group");

    }
    public function read_student_paper_group_alert(){

        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        $condition["student_college_id"]=session("college_id");
        $student=M("student");
        //$condition["student"]["advisor_id"]=Array("GT",0);
        if(isset($_POST['student_paper_name']) && !empty($_POST['student_paper_name'])){
            $condition["student_name|student_no"]=I("post.advisor_name");//姓名或学号搜索


        }
        $result=$student->join('grade on student.student_grade_id=grade.grade_id')
            ->join('paper_group on paper_group.id=student.paper_group_id')
            ->join('advisor on student.advisor_id=advisor.advisor_id')
            ->where($condition)->order($sort.' '.$order)->page($page,$pagesize)->select();// join('left join paper_group on paper_group.id=advisor.paper_group_id')->
        $json = json_encode($result);

        $total=$student->join('grade on student.student_grade_id=grade.grade_id')
            ->join('paper_group on paper_group.id=student.paper_group_id')
            ->join('advisor on student.advisor_id=advisor.advisor_id')
            ->where($condition)->count();
        echo '{"total":'.$total.',"rows":'.$json.'}';
    }
    public function update_student_paper_group(){//保存更新的信息
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $row = I("post.row");
        $condition["student_id"]=$row["student_id"];
        $data["paper_group_id"]=$row["group_name"];
        $student=M("student");
        $result=$student->where($condition)->save($data);
        if($result)
        {
            echo "成功";
        }
        else{
            echo "失败";
        }



    }
    public function readallstudent_notpaperassign(){//读取所有未分配导师
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
        $condition["student_college_id"]=session("college_id");

        if(isset($_POST['student_name']) && !empty($_POST['student_name'])){
            $condition["student_name|student_no"]=I("post.student_name");//姓名或学号搜索

        }
        $student=M("student");
        $result=$student->join('grade on student.student_grade_id=grade.grade_id')->join('advisor on student.advisor_id=advisor.advisor_id')
            ->where($condition)->where('student.paper_group_id=0')->order($sort.' '.$order)->page($page,$pagesize)->select();
        $json = json_encode($result);

        $total=$student->where($condition)->count();
        echo '{"total":'.$total.',"rows":'.$json.'}';
    }
    public function paper_student_assign_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $ids =I("post.ids");
        $condition["student_id"]=Array("IN","$ids");
        $data["paper_group_id"]=I("post.id");

        $student=M("student");
        $result=$student->where($condition)->save($data);
        if($result)
        {
            echo"成功";
        }

    }
    public function paper_student_auto_assign_group(){
        if(session("user_name")==null||session("role")!=2){

            session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
        }
        $condition["college_id"]=session("college_id");
        $condition["paper_group_id"]=0;
        $advisor=M("advisor");
        $result=$advisor->where($condition)->count();
        if($result>0)
        {
            echo"失败";
            exit();
        }
        else{
            $paper_group=M("paper_group");
            $condition5["paper_college_id"]=session("college_id");
            $result=$paper_group->where($condition5)->select();
            $count=count($result);
            $advisor=M("advisor");
            $student=M("student");
            //echo "22";

            for($i=0;$i<$count;$i++){
                $condition["paper_group_id"]=$result[$i]["id"];
                $result1=$advisor->where($condition)->select();
                $ids="";//组内所有的导师id
                // echo($result[$i]["id"]);
                $count2=count($result1);

                for($j=0;$j<$count2;$j++){
                    if($j==$count2-1){
                        $ids=$ids.$result1[$j]["advisor_id"];
                    }
                    else{
                        $ids=$ids.$result1[$j]["advisor_id"].",";
                    }
                }
                // echo("$ids");
                $condition1["advisor_id"]=Array("IN","$ids");
                $condition1["paper_group_id"]=0;
                if($i==$count-1){
                    $data["paper_group_id"]=$result[0]["id"];
                }
                else{
                    $data["paper_group_id"]=$result[$i+1]["id"];
                }
                $result2=$student->where($condition1)->save($data);
                if($result2){
                    echo("1");
                }

            }



        }
    }

    //读取所有班级
    public function read_all_grade(){
        $grade=M("grade");
        $condition["grade_college_id"]=session("college_id");
        $result=$grade->where($condition)->order('grade_id desc')->select();
        $json = json_encode($result);
        echo($json);
    }

    //读取所有科室
    public function read_all_faculty(){
        $faculty=M("faculty");

        $condition["faculty_college_id"]=session("college_id");
        $result=$faculty->where($condition)->order('id desc')->select();
        $json = json_encode($result);
        echo($json);
    }

    //文件上传，或删除
    public  function uploadfile(){//上传文件

        $fox_admin_id=I("post.fox_admin_id");

        if( $fox_admin_id==""){
            echo("错误");
            exit();
        }
        if (!empty($_FILES)) {


            $upload = new \Think\Upload();

            $upload->maxSize = 10485760;
            $upload->exts  = array('doc','docx','wps','xls','xlsx','rar','zip');
            $upload->rootPath  ="./Application/upload/";
            $upload->savePath = $fox_admin_id."/";
            $upload->autoSub = true;
           // $upload->subName = $fox_admin_id;//目录设置为子目录
            $upload->saveRule = uniqid;
            $upload->replace=true;
            $info   =   $upload->upload();
            if(!$info){
                echo("错误");//获取失败信息
            } else {
                foreach($info as $file){
                    echo $file['savepath'].$file['savename'];
                }//获取成功信息
            }
            //返回文件名给JS作回调用*/

        }
    }
    public function delete_file(){//所有文件删除都是用这一个函数
        $file_name=I("post.file_name");
        $file_name="./Application/upload/".$file_name;
        if(unlink($file_name)){
            echo("成功");

        }
        else{
            echo("错误");
        }



    }


}
