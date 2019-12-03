<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function createFilter(Request $request){
    	$data['view']='crm.accounts.create-search';
    	return view('crm.index',$data);
    }
}
