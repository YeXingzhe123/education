<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 16-8-6
 * phpTime: 下午11:23
 */
namespace Home\Controller;
use Think\Controller;

class AdminController extends Controller{

    public function item()
    {
        if (!session['user_name']) {
             session('[destroy]');
            echo("<script type='text/javascript'  > alert('违法操作'); window.location.reload();</script>");
            exit();
           
        }
        $this->display();
    }

    public function readallitem(){
        if(session("user_name")==null){

            session('[destroy]');
            echo('<script type="text/javascript">alert("发生错误，请重新登录");window.location.href="'.SRC_PATH.'";</script>"');
            exit();
        }
        $page=I("post.page");
        $pagesize=I("post.rows");
        $sort=I("post.sort");
        $order=I('post.order');
         if(isset($_POST['items_name']) && !empty($_POST['items_name'])){
            $condition["items_name"]=array("like","%".I("post.items_name")."%");//姓名搜索
        }
        $condition['extend']=0;
        
        $items=M("Items");
        $result=$items->join('teacher on items.items_teacher_id=teacher.teacher_id')->where($condition)->order($sort.' '.$order)->page($page,$pagesize)->select();
        $json = json_encode($result);

        $total=$items->where($condition)->count();
        echo '{"total":'.$total.',"rows":'.$json.'}';
    }

    public function additem_info(){

        if(session("user_name")==null){

            session('[destroy]');
            echo('<script type="text/javascript">alert("违法操作，请重新登录");window.location.href="'.SRC_PATH.'";</script>"');
            exit();
        }

        $row = I("post.row");
        $data["items_name"]=$row["items_name"];
        $data["items_times"]=$row["items_times"];
        $data["items_price"]=$row["items_price"];
        $data["items_teacher_id"]=$row["teacher_name"];
        $items=M("items");
        $result=$items->add($data);
        if(!$result){
            echo "失败";
        }
        else{
            echo"成功";
        }

    }

    public function updateitem_info(){
        if(session("user_name")==null){
            session('[destroy]');
            echo('<script type="text/javascript">alert("违法操作，请重新登录");window.location.href="'.SRC_PATH.'";</script>"');
            exit();
        }

        $row = I("post.row");
        $data["items_name"]=$row["items_name"];
        $data["items_times"]=$row["items_times"];
        $data["items_price"]=$row["items_price"];
        $data["items_teacher_id"]=$row["teacher_name"];
        $data["items_id"]=$row["items_id"];        
        $items=M("Items");
        $result=$items->save($data);
        if(!$result){
            echo "失败";
        }
        else{
            echo"成功";
        }

    }

    public function deleteitem_info(){
        if(session("user_name")==null){

            session('[destroy]');
            echo('<script type="text/javascript">alert("违法操作，请重新登录");window.location.href="'.SRC_PATH.'";</script>"');
            exit();
        }
        $ids =I("post.ids");
        $items=M("Items");
        $condition["items_id"]=Array("IN","$ids");
        $result=$items->where($condition)->delete();
        echo $result;

    }

    public function read_all_teacher()
    {
        if(session("user_name")==null){

            session('[destroy]');
            echo('<script type="text/javascript">alert("违法操作，请重新登录");window.location.href="'.SRC_PATH.'";</script>"');
            exit();
        }
        
        $teacher=M("Teacher");
        $result=$teacher->field('teacher_id,teacher_name,selected')->select();
        $json = json_encode($result);
        echo($json);

    }

}
















    