<?php
namespace app\index\controller;

class Article extends Common
{

    private $obj;

    public function _initialize()
    {  
        parent::_initialize();
       $this->obj = Model('Article');

    }

    public function index()
    {
        //文章列表最上面三个大图
        $newslist=$this->obj->get_news_list();
        // dump($newslist);die;


        $this->assign(array(
            'newslist'=>$newslist,

            ));
        return view();
    }


    
}
