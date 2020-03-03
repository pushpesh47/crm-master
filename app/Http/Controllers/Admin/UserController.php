<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\AccountMoreDetail;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Validations\Admin\Validate as Validations;
use App\Models\UserRole;
use App\Models\User;
class UserController extends Controller
{
    public function __construct(Request $request){
        
        parent::__construct($request);
        
    }
    public function index(Request $request,Builder $builder)
    {
        $data['title'] = 'User List';
        $data['create_title'] = 'User';
        $data['view'] = 'crm.user.list';
        $user  = _arefy(User::list('array'));
        //dd($user);
        if ($request->ajax()) {
            return DataTables::of($user)
            ->editColumn('action',function($item){
                $html    = '<div class="edit_details_box">';
                $html   .= '<a href="'.url(sprintf('crm/user/%s/edit',___encrypt($item['id']))).'"  title="Edit Detail"><i class="fa fa-edit"></i></a> | ';
                if($item['status'] == 'active'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('crm/user/status/?id=%s&status=inactive',___encrypt($item['id']))).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/images/inactive-user.png').'"
                        data-ask="Would you like to change '.$item['first_name'].' status from active to inactive?" title="Update Status"><i class="fa fa-fw fa-ban"></i></a>';
                }elseif($item['status'] == 'inactive'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('crm/user/status/?id=%s&status=active',___encrypt($item['id']))).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/images/active-user.png').'"
                        data-ask="Would you like to change '.$item['first_name'].' status from inactive to active?" title="Update Status"><i class="fa fa-fw fa-check"></i></a>';
                }elseif($item['status'] == 'pending'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('crm/user/status/?id=%s&status=active',___encrypt($item['id']))).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/images/active-user.png').'"
                        data-ask="Would you like to change '.$item['first_name'].' status from pending to active?" title="Update Status"><i class="fa fa-fw fa-check"></i></a>';
                }
                $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('crm/user/status/?id=%s&status=trashed',___encrypt($item['id']))).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/images/active-user.png').'"
                        data-ask="Are you sure you want to delete '.$item['first_name'].' ?" title="Delete"><i class="fa fa-fw fa-trash"></i></a>';
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('status',function($item){
                return ucfirst($item['status']);
            })
            ->editColumn('name',function($item){
                $url=url('crm/user/'.___encrypt($item['id']));
                return '<a href="'.$url.'">'.$item['first_name'].'</a>';
            })
            ->editColumn('user_role',function($item){
                
                return $item['user_role']['profile_name'];
            })
             
            ->rawColumns(['action','name'])
            ->make(true);
        }
        $data['html'] = $builder
        ->parameters([
            "dom" => "<'row table table-striped table-bordered bulk_action' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",

        ])
        ->addColumn(['data' => 'name', 'name' => 'name','title' => 'Name','orderable' => false, 'width' => 120])
        ->addColumn(['data' => 'email', 'name' => 'email','title' => 'Email','orderable' => false, 'width' => 120])
        ->addColumn(['data' => 'mobile', 'name' => 'mobile','title' => 'Phone','orderable' => false, 'width' => 120])
        ->addColumn(['data' => 'user_role', 'name' => 'user_role','title' => 'User Role','orderable' => false, 'width' => 120])
        ->addColumn(['data' => 'status','name' => 'status','title' => 'Status','orderable' => false, 'width' => 120])
        ->addAction(['title' => 'Action', 'orderable' => false, 'width' => 120]);
        return view('crm.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $data['title'] = 'User';
        $data['view']='crm.user.add';
        $data['user_role']=_arefy(UserRole::where('status','active')->Orderby('profile_name','asc')->get());
        //dd($data['user_role']);
        return view('crm.index',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = new Validations($request);
        $validator   = $validation->addUser();
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
                
                $data['first_name']=$request->first_name;
                $data['last_name']=$request->last_name;
                $data['mobile']=$request->mobile;
                $data['email']=$request->email;
                $data['user_type']='client';
                $data['password']=\Hash::make($request->password);
                $data['user_role_id']=$request->user_role;
                $data['created_at']=date('Y-m-d H:i:s');
                $data['updated_at']=date('Y-m-d H:i:s');
                $add = User::insertGetId($data);
                  ///////Email SEND FOR USER CREATE/////////////
                $emailData               = ___email_settings();
                $emailData['name']       = $request->first_name;//$user->first_name; 
                $emailData['email']      = $request->email;//!empty($email)?$email:'';
                $emailData['password']   = $request->password;
                $emailData['url']        = url('crm/login');
                $emailData['subject']    =  'Welcome on Board ! CRM credential';//
                $emailData['message']    =  'Welcome on Board !Please find your CRM credentials below ';
                $emailData['date']       = date('Y-m-d H:i:s');
                $emailData['custom_text'] = 'Your Account created successfully';
                $mailSuccess = ___mail_sender($emailData['email'],$request->name,'registration_details',$emailData);
                $this->status   = true;
                $this->redirect = url('crm/user');
                \Session::flash('success', 'User added Successfully!'); 
           
        }
        return $this->populateresponse();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['title'] = 'Account Edit';
        $data['create_title'] = 'Accounts';
        $data['view'] = 'crm.accounts.view';
        $data['user_role']=_arefy(UserRole::where('status','active')->Orderby('profile_name','asc')->get());
        $id = ___decrypt($id);
        $where='id='.$id;
        $data['account']  = _arefy(Account::list('single',$where));
        return view('crm.index',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'User';
        $data['create_title'] = 'User';
        $data['view'] = 'crm.user.edit';
        $data['user_role']=_arefy(UserRole::where('status','active')->Orderby('profile_name','asc')->get());
        $id = ___decrypt($id);
        $where='id='.$id;
        $data['user']  = _arefy(User::list('single',$where));
        return view('crm.index',$data);
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
        $validation = new Validations($request);
        $validator   = $validation->addUser('edit');
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
                $id = ___decrypt($id);
                $data['first_name']=$request->first_name;
                $data['last_name']=$request->last_name;
                $data['mobile']=$request->mobile;
                $data['email']=$request->email;
                $data['username']=$request->username;
                if(!empty($request->password)){

                    $data['password']=\Hash::make($request->password);
                }
                $data['user_role_id']=$request->user_role;
                $data['updated_at']=date('Y-m-d H:i:s');
                $add = User::where('id',$id)->update($data);
                
                $this->status   = true;
               // $this->modal    = true;
               // $this->alert    = true;
                //$this->message  = "Admin Login successfully.";
                $this->redirect = url('crm/user');
                \Session::flash('success', 'user Updated Successfully!'); 
           
        }
        return $this->populateresponse();
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

    public function changeStatus(Request $request){
        $id=___decrypt($request->id);
        $data                   = ['status'=>$request->status,'updated_at'=>date('Y-m-d H:i:s')];

        if($request->status=="trashed"){
            $isUpdated              = User::where('id',$id)->delete();
        }else{
            $isUpdated              = User::where('id',$id)->update($data);
        }
        if($isUpdated){
            $this->status       = true;
            $this->redirect     = true;
            $this->jsondata     = [];
        }
        return $this->populateresponse();
    }
}
