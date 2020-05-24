<?php
namespace app\index\controller;

class Broker extends Common
{

    private $obj;

    public function _initialize()
    {
        parent::_initialize();
       $this->obj = Model('Broker');

    }

    public function index()
    {
        // $myid = input('myid');
        $myid = 1;
        //获取国家列表
        $nations=db("country")->column("id,c_name,flag");
        //获取broker表基本信息
        $basic_info = $this->obj->basic_info($myid); 
        $basic_info['r_country'] = $nations[$basic_info['r_country']]['flag'];
        //获取risk表基本信息
        $risk_info = $this->obj->risk_info($basic_info['id']); 
        //获取监管信息
        $regulation_info = $this->obj->regulation_info($basic_info['id'],$nations); 
        //获取大数据评级
        $bigdata_info = $this->obj->bigdata_info($basic_info['id']); 
        //官方评级 TOP10
        $top10 = $this->obj->top10(); 
        //网友印象
        $impresslist = $this->obj->impresslist($basic_info['id']); 
        // dump($top10);die;
 
        // $getvideores=new \app\index\model\Video();

        $this->assign(array(
            'basic_info'=>$basic_info,
            // 'brokerslogo'=>$brokerslogo,
            // 'newestcase'=>$newestcase,
            // 'repliedcase'=>$repliedcase,
            // 'donecase'=>$donecase,
            // 'newslist'=>$newslist,
            // 'getrank'=>$getrank,
            // 'blackrank'=>$blackrank,
            ));
        return view();
    }


    
}
