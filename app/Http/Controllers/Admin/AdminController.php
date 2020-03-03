<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validations\Admin\Validate as Validations;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct(Request $request){
        
        parent::__construct($request);
        
    }

     public function login()
    {
        $data['view']='login';
        return view('crm.common.login',$data);
    }
    
     public function logout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
    public function authCheck(Request $request)
    {
        $validation = new Validations($request);
        $validator   = $validation->login();
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password/*, 'user_type' => 'admin'*/])) {
                $this->status   = true;
               // $this->modal    = true;
               // $this->alert    = true;
                //$this->message  = "Admin Login successfully.";
                $this->redirect = url('crm/dashboard');
                \Session::flash('success', 'Login Successfully!'); 
            }else{
                
                $this->message = $validator->errors()->add('password', 'Wrong email OR password.');
            }
        }
        return $this->populateresponse();
    }
    public function dashboard()
    {
        $data['view']='crm.common.dashboard';
        return view('crm.index',$data);
    }
    public function profile()
    {
        $data['view']='crm.profile';
        return view('crm.index',$data);
    }
     public function setting()
    {
        $data['view']='crm.setting';
        return view('crm.index',$data);
    }

    public function changePass()
    {
        $data['view']='crm.change-password';
        return view('crm.index',$data);
    }

    public function updateProfile(Request $request)
    {
        $validation = new Validations($request);
        $validator   = $validation->updateProfile('edit');
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
                $id = \Auth::user()->id;
                $data['first_name']=$request->first_name;
                $data['last_name']=$request->last_name;
                $data['email']=$request->email;
                $data['mobile']=$request->mobile;
                $data['updated_at']=date('Y-m-d H:i:s');
                $add = \App\User::where('id',$id)->update($data);

                $this->status   = true;
                // $this->modal    = true;
                // $this->alert    = true;
                //$this->message  = "Admin Login successfully.";
                $this->redirect = url('crm/dashboard');
                \Session::flash('success', 'Profile Updated Successfully!'); 
        }
        return $this->populateresponse();
    }
    public function changePassword(Request $request)
    {
        $validation = new Validations($request);
        $validator   = $validation->changePassword('edit');
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $request_data = $request->All();
             
            $current_password = Auth::User()->password;           
            if(\Hash::check($request_data['old_password'], $current_password)){           
                $user_id = Auth::User()->id;                       
                $obj_user = \App\User::find($user_id);
                $obj_user->password = \Hash::make($request_data['password']);;
                $obj_user->save(); 
                /*$data['updated_at']=date('Y-m-d H:i:s');
                $add = \App\User::where('id',$id)->update($data);*/
                $this->status   = true;
               
                $this->redirect = url('crm/dashboard');
                \Session::flash('success', 'Password Updated Successfully!'); 
            }else{           
                $this->message = $validator->errors()->add('old_password', 'Please enter correct password.Old Password not Matched!');
            }
                
        }
        return $this->populateresponse();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
