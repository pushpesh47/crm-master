<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
Use App\Models\Account;
Use App\Models\AccountStatus;
Use App\Models\UserRole;
Use App\Models\User;
Use App\Models\LeadSource;
Use App\Models\DynamicForm;
Use App\Models\AccountMoreDetail;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Validations\Admin\Validate as Validations;
use PDF;
use Excel;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $request){
        
        parent::__construct($request);
        
    }


    public function index(Request $request,Builder $builder)
    {
        $data['title'] = 'Account List';
        $data['create_title'] = 'Accounts';
        $data['view'] = 'crm.accounts.list';
        //$exam  = _arefy(Account::orderBy('id','desc')->get());
        $check ='<input type="checkbox" name="accountAll" id="checkedAll" >';
        $account= _arefy(Account::list('array'));
        if ($request->ajax()) {
            return DataTables::of($account)
            ->editColumn('action',function($item){
                $html    = '<div class="edit_details_box">';
                $html   .= '<a href="'.url(sprintf('crm/accounts/%s/edit',___encrypt($item['id']))).'"  title="Edit Detail"><i class="fa fa-edit"></i></a> | ';
                if($item['status'] == 'active'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('crm/accounts/status/?id=%s&status=inactive',___encrypt($item['id']))).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/images/inactive-user.png').'"
                        data-ask="Would you like to change '.$item['first_name'].' status from active to inactive?" title="Update Status"><i class="fa fa-fw fa-ban"></i></a> |';
                }elseif($item['status'] == 'inactive'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('crm/accounts/status/?id=%s&status=active',___encrypt($item['id']))).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/images/active-user.png').'"
                        data-ask="Would you like to change '.$item['first_name'].' status from inactive to active?" title="Update Status"><i class="fa fa-fw fa-check"></i></a> |';
                }elseif($item['status'] == 'pending'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('crm/accounts/status/?id=%s&status=active',___encrypt($item['id']))).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/images/active-user.png').'"
                        data-ask="Would you like to change '.$item['first_name'].' status from pending to active?" title="Update Status"><i class="fa fa-fw fa-check"></i></a> |';
                }
                $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('crm/accounts/status/?id=%s&status=trashed',___encrypt($item['id']))).'" 
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
                $url=url('crm/accounts/'.___encrypt($item['id']));
                return '<a href="'.$url.'">'.$item['name'].'</a>';
            })
             ->editColumn('email',function($item){
                $url=url('crm/accounts/'.___encrypt($item['id']));
                return '<a href="'.$url.'">'.$item['email'].'</a>';
            })
            ->editColumn('checkbox',function($item){
               
                return '<input type="checkbox" class="checkSingle" name="account[]" value="'.$item['id'].'">';
            })
            ->rawColumns(['action','name','email','checkbox'])
            ->make(true);
        }
        $data['html'] = $builder
        ->parameters([
            "dom" => "<'row table table-striped table-bordered bulk_action' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",

        ])
        ->addColumn(['data' => 'checkbox', 'name' => 'checkbox','title' => $check,'orderable' => false, 'width' => 120])
        ->addColumn(['data' => 'name', 'name' => 'name','title' => 'Cutomer Name','orderable' => true, 'width' => 120])
        ->addColumn(['data' => 'email', 'name' => 'email','title' => 'Email','orderable' => true, 'width' => 120])
        ->addColumn(['data' => 'mobile', 'name' => 'mobile','title' => 'Mobile Number','orderable' => true, 'width' => 120])
        ->addColumn(['data' => 'customer_number', 'name' => 'customer_number','title' => 'Customer No','orderable' => true, 'width' => 120])
        ->addColumn(['data' => 'status','name' => 'status','title' => 'Status','orderable' => true, 'width' => 120])
        ->addAction(['title' => 'Action', 'orderable' => true, 'width' => 120]);
        return view('crm.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['account_info']=_arefy(DynamicForm::where(['module_type'=>'account','section_type'=>'account_information'])->Orderby('id','desc')->get());
        $data['lead_info']=_arefy(DynamicForm::where(['module_type'=>'account','section_type'=>'lead_information'])->Orderby('id','desc')->get());
        $data['callback_info']=_arefy(DynamicForm::where(['module_type'=>'account','section_type'=>'callback_information'])->Orderby('id','desc')->get());
        $data['customer_info']=_arefy(DynamicForm::where(['module_type'=>'account','section_type'=>'customer_information'])->Orderby('id','desc')->get());
        $data['user_role']=_arefy(User::where('status','active')->Orderby('id','desc')->get());
        $data['account_status']=_arefy(AccountStatus::where('status','active')->Orderby('id','desc')->get());
        $data['lead_source']=_arefy(LeadSource::where('status','active')->Orderby('id','desc')->get());
        $data['view']='crm.accounts.add';
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
        $validator   = $validation->addAccount();
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
                $get=Account::orderBy('id','desc')->first();
                if(!empty($get)){
                    $id=$get->id;
                }else{
                    $id=0;
                }
                $data['name']=$request->name;
                $data['first_name']=$request->first_name;
                $data['last_name']=$request->last_name;
                $data['customer_number']='ACCOUNT'.$id;
                $data['lead_source']=$request->lead_source;
                $data['mobile']=$request->mobile;
                $data['date_of_injury']=$request->date_of_injury;
                $data['email']=$request->email;
                $data['account_status']=$request->account_status;
                $data['lead_source']=$request->lead_source;
                $data['sales_agent']=$request->sales_agent;
                $data['injury_type']=$request->injury_type;
                $data['potential_defendant']=$request->potential_defendant;
                $data['date_of_injury_aware']=$request->date_of_injury_aware;
                $data['lead_quality']=$request->lead_quality;
                $data['facebook_injury_date']=$request->facebook_injury_date;
                $data['enquiry_type']=$request->enquiry_type;
                $data['panel_refrence']=$request->panel_refrence;
                $data['type_of_lead']=$request->type_of_lead;
                $data['date_lead_recieved']=$request->date_lead_recieved;
                $data['home_telephone_number']=$request->home_telephone_number;
                $data['mobile_telephone_number']=$request->mobile_telephone_number;
                $data['social_media_handle']=$request->social_media_handle;
                $data['date_of_birth']=$request->date_of_birth;
                $data['address']=$request->address;
                $data['call_transfer_time']=$request->call_transfer_time;
                $data['call_back_time']=$request->call_back_time;
                $data['call_back_date']=$request->call_back_date;
                $data['created_at']=date('Y-m-d H:i:s');
                $data['updated_at']=date('Y-m-d H:i:s');
                $add = Account::insertGetId($data);
                if(!empty($request->cf)){
                    foreach ($request->cf as $key => $value) {
                        $more['account_id']=$add;
                        $more['column']=$key;
                        $more['value']=$value;
                        $more['created_at']=date('Y-m-d H:i:s');
                        $more['updated_at']=date('Y-m-d H:i:s');
                        $success = AccountMoreDetail::insertGetId($more);
                    }

                }
               
                $this->status   = true;
               // $this->modal    = true;
               // $this->alert    = true;
                //$this->message  = "Admin Login successfully.";
                $this->redirect = url('crm/accounts');
                \Session::flash('success', 'Account added Succesful!'); 
           
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
        $data['form']=_arefy(DynamicForm::where('module_type','account')->Orderby('id','desc')->get());
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
        $data['title'] = 'Account Edit';
        $data['create_title'] = 'Accounts';
        $data['view'] = 'crm.accounts.edit';
        /*$data['form']=_arefy(DynamicForm::where('module_type','account')->Orderby('id','desc')->get());*/
        $data['account_info']=_arefy(DynamicForm::where(['module_type'=>'account','section_type'=>'account_information'])->Orderby('id','desc')->get());
        $data['lead_info']=_arefy(DynamicForm::where(['module_type'=>'account','section_type'=>'lead_information'])->Orderby('id','desc')->get());
        $data['callback_info']=_arefy(DynamicForm::where(['module_type'=>'account','section_type'=>'callback_information'])->Orderby('id','desc')->get());
        $data['customer_info']=_arefy(DynamicForm::where(['module_type'=>'account','section_type'=>'customer_information'])->Orderby('id','desc')->get());

        $id = ___decrypt($id);
         $data['user_role']=_arefy(User::where('status','active')->Orderby('id','desc')->get());
        $data['account_status']=_arefy(AccountStatus::where('status','active')->Orderby('id','desc')->get());
        $data['lead_source']=_arefy(LeadSource::where('status','active')->Orderby('id','desc')->get());
        $where='id='.$id;
        $data['account']  = _arefy(Account::list('single',$where));
        return view('crm.index',$data);
    }

    public function duplicate($id)
    {
        $data['title'] = 'Account Duplicate';
        $data['create_title'] = 'Accounts';
        $data['view'] = 'crm.accounts.duplicate';
         $data['account_info']=_arefy(DynamicForm::where(['module_type'=>'account','section_type'=>'account_information'])->Orderby('id','desc')->get());
        $data['lead_info']=_arefy(DynamicForm::where(['module_type'=>'account','section_type'=>'lead_information'])->Orderby('id','desc')->get());
        $data['callback_info']=_arefy(DynamicForm::where(['module_type'=>'account','section_type'=>'callback_information'])->Orderby('id','desc')->get());
        $data['customer_info']=_arefy(DynamicForm::where(['module_type'=>'account','section_type'=>'customer_information'])->Orderby('id','desc')->get());

        $id = ___decrypt($id);
         $data['user_role']=_arefy(User::where('status','active')->Orderby('id','desc')->get());
        $data['account_status']=_arefy(AccountStatus::where('status','active')->Orderby('id','desc')->get());
        $data['lead_source']=_arefy(LeadSource::where('status','active')->Orderby('id','desc')->get());
        $where='id='.$id;
        $data['account']  = _arefy(Account::list('single',$where));
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
        $validator   = $validation->addAccount('edit');
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
                $id = ___decrypt($id);
                $data['name']=$request->name;
                $data['first_name']=$request->first_name;
                $data['last_name']=$request->last_name;
                //$data['customer_number']='ACCOUNT'.$id;
                $data['lead_source']=$request->lead_source;
                $data['mobile']=$request->mobile;
                $data['date_of_injury']=$request->date_of_injury;
                $data['email']=$request->email;
                $data['account_status']=$request->account_status;
                $data['lead_source']=$request->lead_source;
                $data['sales_agent']=$request->sales_agent;
                $data['injury_type']=$request->injury_type;
                $data['potential_defendant']=$request->potential_defendant;
                $data['date_of_injury_aware']=$request->date_of_injury_aware;
                $data['lead_quality']=$request->lead_quality;
                $data['facebook_injury_date']=$request->facebook_injury_date;
                $data['enquiry_type']=$request->enquiry_type;
                $data['panel_refrence']=$request->panel_refrence;
                $data['type_of_lead']=$request->type_of_lead;
                $data['date_lead_recieved']=$request->date_lead_recieved;
                $data['home_telephone_number']=$request->home_telephone_number;
                $data['mobile_telephone_number']=$request->mobile_telephone_number;
                $data['social_media_handle']=$request->social_media_handle;
                $data['date_of_birth']=$request->date_of_birth;
                $data['address']=$request->address;
                $data['call_transfer_time']=$request->call_transfer_time;
                $data['call_back_time']=$request->call_back_time;
                $data['call_back_date']=$request->call_back_date;
                $data['created_at']=date('Y-m-d H:i:s');
                $data['updated_at']=date('Y-m-d H:i:s');
                $add = Account::where('id',$id)->update($data);
                if(!empty($request->cf)){
                    foreach ($request->cf as $key => $value) {
                        $more['column']=$key;
                        $more['value']=$value;
                        $more['updated_at']=date('Y-m-d H:i:s');
                        $check= AccountMoreDetail::where('column',$key)->where('account_id',$id)->first();
                        if(empty($check)){
                            $more['account_id']=$id;
                            $success = AccountMoreDetail::insertGetId($more);
                        }else{
                            $success = AccountMoreDetail::where('column',$key)->where('account_id',$id)->update($more);
                        }
                    }

                }
                $this->status   = true;
               // $this->modal    = true;
               // $this->alert    = true;
                //$this->message  = "Admin Login successfully.";
                $this->redirect = url('crm/accounts');
                \Session::flash('success', 'Account Updated Succesful!'); 
           
        }
        return $this->populateresponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    public function changeStatus(Request $request){
        $id=___decrypt($request->id);
        $data                   = ['status'=>$request->status,'updated_at'=>date('Y-m-d H:i:s')];

        if($request->status=="trashed"){
            $isUpdated              = Account::where('id',$id)->delete();
        }else{
            $isUpdated              = Account::where('id',$id)->update($data);
        }
        if($isUpdated){
            $this->status       = true;
            $this->redirect     = url('crm/accounts');
            $this->jsondata     = [];
        }
        return $this->populateresponse();
    }

    public function AccountExportPDF(Request $request){
        $whereIn=$request->accounts;
        $data['account_info']=_arefy(DynamicForm::where(['module_type'=>'account','section_type'=>'account_information'])->Orderby('id','desc')->get());
        $data['lead_info']=_arefy(DynamicForm::where(['module_type'=>'account','section_type'=>'lead_information'])->Orderby('id','desc')->get());
        $data['callback_info']=_arefy(DynamicForm::where(['module_type'=>'account','section_type'=>'callback_information'])->Orderby('id','desc')->get());
        $data['customer_info']=_arefy(DynamicForm::where(['module_type'=>'account','section_type'=>'customer_information'])->Orderby('id','desc')->get());

         $data['user_role']=_arefy(User::where('status','active')->Orderby('id','desc')->get());
        $data['account_status']=_arefy(AccountStatus::where('status','active')->Orderby('id','desc')->get());
        $data['lead_source']=_arefy(LeadSource::where('status','active')->Orderby('id','desc')->get());
        $data['accounts']  =  _arefy(Account::list('array','',['*'],'id-desc',$whereIn));
       // return view('crm.accounts.export',$data);
        $pdf = PDF::loadView('crm.accounts.export',$data);
        $file=date('ymdhis');
        $pdf->save(public_path('uploads/account_export/').$file.'.pdf');
        if(!empty($request->email)){
            $emailData               = ___email_settings();
            $emailData['name']       = $request->name;//$user->first_name; 
            $emailData['email']      = $request->email;//!empty($email)?$email:'';
            $emailData['password']      = '1234567';
            $emailData['subject']    =  'Export PDF Account Data';//$request->subject;
            $emailData['attachment']    =  public_path('uploads/account_export/').$file.'.pdf';
            $emailData['date']       = date('Y-m-d H:i:s');
            $emailData['custom_text'] = 'Your Enquiry has been submitted successfully';
            $mailSuccess = ___mail_sender($emailData['email'],$request->name,'forgot_password',$emailData);
        
            \Session::flash('success', 'Account Export mail sent Succesful!'); 
            return redirect()->back();
        }else{

            return $pdf->download('customers.pdf');
        }
      
  }

    public function mail(){
        $data['title'] = 'Account Mail';
        $data['create_title'] = 'Accounts';
        $data['view'] = 'crm.common.mail';
        return view('crm.index',$data);
    }

    public function mailSent(Request $request){
        $account  = _arefy(Account::where('status', 'active')->get());
        $template  = _arefy(\App\Models\Email::where('status', 'active')->orderBy('id','desc')->get());
         return response()->json([
            'status'    => true,
            'html'      => view("crm.common.mail",['account'=>$account,'template'=>$template,'user_id'=>$request->user])->render()
        ]);
    }

    public function export(Request $request){
        $account_info=_arefy(DynamicForm::where(['module_type'=>'account','section_type'=>'account_information'])->Orderby('id','desc')->get());
        $lead_info=_arefy(DynamicForm::where(['module_type'=>'account','section_type'=>'lead_information'])->Orderby('id','desc')->get());
        $callback_info=_arefy(DynamicForm::where(['module_type'=>'account','section_type'=>'callback_information'])->Orderby('id','desc')->get());
        $customer_info=_arefy(DynamicForm::where(['module_type'=>'account','section_type'=>'customer_information'])->Orderby('id','desc')->get());
        
         $user_role=_arefy(User::where('status','active')->Orderby('id','desc')->get());
        $account_status=_arefy(AccountStatus::where('status','active')->Orderby('id','desc')->get());
        $lead_source=_arefy(LeadSource::where('status','active')->Orderby('id','desc')->get());
        $whereIn=$request->user;
        $accounts  = _arefy(Account::list('array','',['*'],'id-desc',$whereIn));
        //pp($data['account']);
         return response()->json([
            'status'    => true,
            'html'      => view("crm.common.export",['accounts'=>$accounts,'account_info,'=>$account_info,'lead_info,'=>$lead_info,'callback_info,'=>$callback_info,'customer_info,'=>$customer_info,'user_role,'=>$user_role,'account_status,'=>$account_status,'lead_source,'=>$lead_source,])->render()
        ]);
    }

    public function mailExport(Request $request){
        $account  = _arefy(Account::whereIn('id', $request->user)->get());
        $template  = _arefy(\App\Models\Email::where('status', 'active')->orderBy('id','desc')->get());
         return response()->json([
            'status'    => true,
            'html'      => view("crm.common.mailer-export",['account'=>$account,'template'=>$template])->render()
        ]);
    }

    public function getMailTemplate(Request $request){
        $email  = _arefy(\App\Models\Email::where('id', $request->id)->first());
         return response()->json([
            'status'    => true,
            'subject'      => $email['subject'],
            'message'      => $email['content']
        ]);
    }

    public function csvExport(Request $request){
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=file.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $account  = _arefy(Account::whereIn('id', $request->user)->get());
        $columns = array('Customer ID', 'Name', 'Email', 'Phone', 'Lead Source', 'Date Of Inury', 'Account Status');

        $callback = function() use ($account, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach($account as $acc) {
                fputcsv($file, array($acc->customer_id, $acc->first_name, $acc->email, $acc->mobile, $acc->lead_source, $acc->date_of_injury, $acc->account_status));
            }
            fclose($file);
        };
        return Response::stream($callback, 200, $headers);
    }

    public function bulkDelete(Request $request){
        $id=$request->user;
        $data                   = ['status'=>'inactive','updated_at'=>date('Y-m-d H:i:s')];

       //pp($id);
        //dd($request->user);
        $isUpdated          = Account::whereIn('ids',$request->user)->update($data);
       
        if($isUpdated){
            $this->status       = true;
            $this->redirect     = url('crm/accounts');
            $this->jsondata     = [];
        }
        return $this->populateresponse();
    }
  
}
