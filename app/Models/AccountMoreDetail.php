<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountMoreDetail extends Model
{
    public function form_details(){
        return $this->hasOne('App\Models\DynamicForm','field_name', 'column');
    }
}
