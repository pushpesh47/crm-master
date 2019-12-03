<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;

class ApiController extends Controller
{
     public function details(Request $request) 
    { 
    	//dd($request->all());
        $user['contact'] = Account::where('mobile',$request->number)->first();
        //$user['message']= 'success';
        return response()->json($user); 
    }
}
