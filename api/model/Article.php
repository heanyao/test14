<?php
namespace app\api\model;
use think\Model;
use think\Db;
// use app\index\model\Cate;

class Article extends Model
{
    
    public function get_hot_artlist($data){
        $order = 'a.rec desc,a.id desc';
        $ret= $this->get_artlist($data,$order);
        return $ret; 
    }

    public function get_new_artlist($data){
        $order = 'a.id desc';
        $ret= $this->get_artlist($data,$order);
        return $ret; 
    } 

 
    public function get_artlist($data,$order){
        if($data['cate']){
           $map['a.cate']  = $data['cate']; 
        }

        $map['a.is_delete']  = 0;
       
            $ret=db('article')
            ->where($map)
            ->field('a.id,a.title,a.thumb,a.abstract,a.rec,a.time,b.head_img_url,b.name')
            ->alias('a')
            ->join('bk_user b','a.user_id=b.id')
            ->order($order)
            ->paginate(5);   
            return $ret; 
    } 

    public function top10($data){

        $order = 'future_index desc';

        if($data['type']==2){
           $order = 'id desc';
        }

        if($data['type']==3){
           $order = 'id asc';
        }

        $map['is_delete']  = 0;
        $ret=db('broker')
        ->where($map)
        ->field('myid,name_cn,name_en,logo_url,future_index')
        ->order($order)
        ->limit(10)
        ->select();
        return $ret;

    }



}
