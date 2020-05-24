<?php
namespace app\index\model;
use think\Model;
class Broker  extends Model
{

    public function basic_info($myid){
        
        $ret=db('broker')
        ->where('myid',$myid)
        ->field('id,logo_url,intro,tel,web_cn,web_en,name_cn,name_en,address,found_year,email,wechat,avg_cost,avg_exc,avg_fund,avg_slip,avg_stable,avg_service,avg_rate,tag_year,tag_regulation,tag_license,tag_mt4,status,future_index,r_country')
        ->find();
        $ret['web_en']= explode(",",$ret['web_en']);
        $ret['web_cn']= explode(",",$ret['web_cn']);
        return $ret;

    }

    public function risk_info($id){

        $map['is_delete']  = 0;
        $map['broker_id'] = $id;  
        $ret=db('risk')
        ->where($map)
        ->field('id,content,level')
        ->order('id desc')
        ->select();
        return $ret;

    }

    public function regulation_info($id,$nations){

        $map['broker_id'] = $id;  
            $ret=db('regulation')
            ->where($map)
            ->field('a.id,a.r_name,a.r_email,a.r_add,a.r_web,a.active_time,a.expire_time,a.r_tel,a.license_type,a.license_number,a.status,a.scope,a.file_link,a.r_level,a.file_link,b.c_name_en,b.c_name_cn,b.dsc,b.country_id')
            ->alias('a')
            ->join('bk_commission b','a.commission_id=b.id')
            ->order('a.r_level asc')
            ->paginate(5)
            ->each(function($item, $key)use($nations){
                $item['country_id'] = $nations[$item['country_id']];
                return $item;
            });

        return $ret;

    }


    public function bigdata_info($id){

        $map['is_delete']  = 0;
        $map['broker_id'] = $id;  
        $ret=db('bigdata_rate')
        ->where($map)
        ->find();
        return $ret;

    }


    public function top10(){

        $map['is_delete']  = 0;
        $ret=db('broker')
        ->where($map)
        ->field('myid,name_cn,name_en,logo_url,future_index')
        ->order('future_index desc')
        ->limit(10)
        ->select();
        return $ret;

    }

    public function impresslist($id){

        $map['is_delete']  = 0;
        $map['broker_id'] = $id;
        $ret=db('impress')
            ->field('content,count(content) as count')
            ->group('content')
            ->where($map)
            ->order('count desc')
            ->limit(45)
            ->select();
        // dump($ret);die;
        // $ret=db('broker')
        // ->where($map)
        // ->field('myid,name_cn,name_en,logo_url,future_index')
        // ->order('future_index desc')
        // ->limit(10)
        // ->select();
        return $ret;

    }
    // public function get_rec_brokers(){

    //     $map['is_delete']  = 0;
    //     $map['id'] = array('in','1,5,8,3,4'); //首页broker logo改其id即可

    //     $ret=db('broker')
    //     ->where($map)
    //     ->field('id,name_cn,name_en,logo_url')
    //     ->order('id desc')
    //     ->limit(5)
    //     ->select();
    //     return $ret;
    // }

    // public function get_rank_list(){

    //     $map['is_delete']  = 0;

    //     $ret=db('broker')
    //     ->where($map)
    //     ->field('myid,name_cn,name_en,logo_url,avg_rate,tag_year,tag_regulation,tag_license,tag_mt4,status')
    //     ->order('avg_rate desc,id desc')
    //     ->limit(10)
    //     ->select();
    //     return $ret;
    // }

    // public function get_news_list(){

    //     $map['a.is_delete']  = 0;
    //         $ret=db('article')
    //         ->where($map)
    //         ->field('a.id,a.title,a.thumb,a.abstract,a.rec,a.time,b.head_img_url,b.name')
    //         ->alias('a')
    //         ->join('bk_user b','a.user_id=b.id')
    //         ->order('a.id desc')
    //         ->paginate(5);   
    //         return $ret;
    // }

}
