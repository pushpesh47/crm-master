<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
     public function dashboard()
    {
        $data['view']='clients.common.dashboard';
        return view('crm.index',$data);
    }
}
