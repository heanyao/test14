<?php
namespace app\index\model;
use think\Model;
class Article extends Model
{
    public function get_news_list(){

        $map['is_delete']  = 0;
            $ret=db('article')
            ->where($map)
            ->field('myid,title,thumb')
            ->order('rec desc,id desc')
            ->limit(3)
            ->select();   
            return $ret;
    }

}
