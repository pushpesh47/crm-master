<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterView extends Model
{
    public function filterMore(){
        return $this->hasMany('App\Models\FilterViewDetail','filter_view_id', 'id');
    }
     
	public static function list($fetch='array',$where='',$keys=['*'],$order='id-desc',$whereIn=''){
		$tabel_data = self::select($keys)
		->with([
			'filterMore' => function($q){
				$q->select('id','filter_view_id','meta_key','meta_value');
			}
		]);
		if($where){
			$tabel_data->whereRaw($where);
		}
		if($whereIn){
			$tabel_data->whereIn('id',$whereIn);
		}
		//$userlist['userCount'] = !empty($table_user->count())?$table_user->count():0;
		if(!empty($order)){
			$order = explode('-', $order);
			$tabel_data->orderBy($order[0],$order[1]);
		}
		if($fetch === 'array'){
			$list = $tabel_data->get();
			return json_decode(json_encode($list ), true );
		}else if($fetch === 'obj'){
			return $tabel_data->limit($limit)->get();                
		}else if($fetch === 'single'){
			return $tabel_data->get()->first();
		}else if($fetch === 'count'){
			return $tabel_data->get()->count();
		}else{
			return $tabel_data->limit($limit)->get();
		}
	} 

}
