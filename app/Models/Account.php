<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    
    
    public function accountMore(){
        return $this->hasMany('App\Models\AccountMoreDetail','account_id', 'id');
    }
     
 

   

	public static function list($fetch='array',$where='',$keys=['*'],$order='id-desc',$whereIn=''){
		$tabel_data = self::select($keys)
		->with([
			'accountMore' => function($q){
				$q->select('*')->with([
					'form_details' => function($q){
						$q->select('*');
					}
				]);
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

    public static function add($data){
        if(!empty($data)){
            return self::insertGetId($data);
        }else{
            return false;
        }   
    }

    public static function change($userID,$data){
        $isUpdated = false;
        $table_course = \DB::table('booking');
        if(!empty($data)){
            $table_course->where('id','=',$userID);
            $isUpdated = $table_course->update($data);
        }
                
        return (bool)$isUpdated;
    }
}
