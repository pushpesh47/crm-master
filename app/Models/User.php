<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function userRole(){
        return $this->hasOne('App\Models\UserRole','id', 'user_role_id');
    }
     
	public static function list($fetch='array',$where='',$keys=['*'],$order='id-desc'){
		$tabel_data = self::select($keys)
		->with([
			'userRole' => function($q){
				$q->select('*');
			}
			
		]);
		if($where){
			$tabel_data->whereRaw($where);
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
