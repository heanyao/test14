<?php

namespace app\api\controller;
use think\Request;

header('content-type:application/json;charset=utf-8');

class Article extends Common
{

    private $obj;

    public function _initialize()
    {
       $this->obj = Model('Article');

    }
 
    //文章栏目热门文章列表
    public function getrecarticle()
    {

            $data['cate']=(int)input('type');  
 
            $res=$this->obj->get_hot_artlist($data);

        if ($res == null) {
            $this->returnMsg(400, '暂无数据！');
        } 
            //响应数据给客户端
            $this->returnMsg(200, '操作成功！', $res);
    }

    //文章栏目最新文章列表
    public function getnewarticle()
    {

            $data['cate']=(int)input('type');  
 
            $res=$this->obj->get_new_artlist($data);

        if ($res == null) {
            $this->returnMsg(400, '暂无数据！');
        } 
            //响应数据给客户端
            $this->returnMsg(200, '操作成功！', $res);
    }

    //文章栏目最新文章列表
    public function gettop10()
    {

            $data['type']=(int)input('type');  
 
            $res=$this->obj->top10($data);

        if ($res == null) {
            $this->returnMsg(400, '暂无数据！');
        } 
            //响应数据给客户端
            $this->returnMsg(200, '操作成功！', $res);
    }

}
