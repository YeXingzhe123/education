<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	if (session("user_name")==Null and !IS_POST)
    	{
            $this->display('login');
            exit();
    	}
    }
}
