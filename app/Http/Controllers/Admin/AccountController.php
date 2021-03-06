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
use App\Models\FilterView;
use App\Models\FilterViewDetail;
use App\Models\SelectList;
use App\Models\AssignToClient;
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
        //pp($request->all());
        if(!empty($_REQUEST['filters']) && !empty($_REQUEST['module'])){
                $view_id = ___decrypt($_REQUEST['filters']);
                $data['viewColumn']=_arefy(FilterViewDetail::where(['filter_view_id'=>$view_id])->where('meta_value','!=',NULL)->get());
                $data['data_from']  = _arefy(FilterView::where('id',$view_id)->orderBy('id','desc')->where('status','active')->first());
        }
        $where=1;
        if(!empty($data['data_from']['start_date']) && !empty($data['data_from']['end_date'])){
            $where .=" AND (".$data['data_from']['column_from']." BETWEEN '".$data['data_from']['start_date']."'".' AND '."'".$data['data_from']['end_date']."')";
        }
        $data['filter']  = _arefy(FilterView::orderBy('id','desc')->where('status','active')->get());

        if(empty($request->search_column)){
            $data['search_column']='';
            $data['search']='';
        }else{
            $data['search_column']=$request->search_column;
            $data['search']=$request->search;
             if(!empty($request->filter['advance_search'])){
                $count=count($request->filter['advance_search']);
                if($count>1){
                    $where .=" AND ".$data['search_column']." LIKE '%".$data['search']."%' AND ";
                }

            }else{
                $where .=" AND ".$data['search_column']." LIKE '%".$data['search']."%'";

            }
        }
        if(!empty($request->filter['advance_search'])){
            $count=count($request->filter['advance_search']);
            for ($i=0;$i<=$count-1;$i++) {
                $text= $request->filter['search_text'][$i];
                $adv_search= $request->filter['advance_search'][$i];
                $advance_operator= $request->filter['advance_operator'][$i];
                    $cond = $request->filter['condition'][$i];
                if($i==$count-1){
                    $cond='';
                }
                if(!empty($advance_operator)){
                    if($advance_operator=='start_with'){
                        $advance_operator=' LIKE ';
                        $where.=' '.$adv_search.' '.''.$advance_operator."'".$text."%' ".$cond;
                    }elseif($advance_operator=='end_with'){
                        $advance_operator=' LIKE ';
                        $where.=' '.$adv_search.' '.''.$advance_operator."'%".$text."' ".$cond;

                    }elseif($advance_operator=='contains'){
                        $advance_operator=' LIKE ';
                        $where.=' '.$adv_search.' '.''.$advance_operator."'%".$text."%' ".$cond;

                    }elseif($advance_operator=='does_not_contains'){
                        $advance_operator='NOT LIKE ';
                        $where.=' '.$adv_search.' '.''.$advance_operator."'%".$text."%' ".$cond;
                    }else{
                        $where.=' '.$adv_search.' '.''.$advance_operator."'".$text."' ".$cond;
                    }
                }
                
            }
        }

        $data['title'] = 'Account List';
        $data['create_title'] = 'Accounts';
        $data['view'] = 'crm.accounts.list';
        $check ='<input type="checkbox" name="accountAll" id="checkedAll" >';
        if(Auth::user()->user_type!='admin'){
            $where .=' AND sales_agent='.Auth::user()->id;
        }

        $account= _arefy(Account::list('array',$where));
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
            ->editColumn('sales_agent',function($item){
                $user = User::where('id',$item['sales_agent'])->first();
                $url=url('crm/user/'.___encrypt($item['id'].'/edit'));
                return '<a href="'.$url.'">'.$user['first_name'].'</a>';
            })
             ->editColumn('email',function($item){
                $url=url('crm/accounts/'.___encrypt($item['id']));
                return '<a href="'.$url.'">'.$item['email'].'</a>';
            })
            ->editColumn('checkbox',function($item){
               
                return '<input type="checkbox" class="checkSingle" name="account[]" value="'.$item['id'].'">';
            })
            ->rawColumns(['action','name','email','checkbox','sales_agent'])
            ->make(true);
        }
        $data['html'] = $builder
        ->parameters([
            "dom" => "<'row table table-striped table-bordered bulk_action' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",

        ])
        ->addColumn(['data' => 'checkbox', 'name' => 'checkbox','title' => $check,'orderable' => false, 'width' => 120]);
        if(!empty($_REQUEST['filters']) && $_REQUEST['filters']!='all'){
            foreach ($data['viewColumn'] as $key => $value) {
                $builder->addColumn(['data' => $value['meta_value'], 'name' => $value['meta_value'],'title' => $value['meta_name'],'orderable' => true, 'width' => 120]);
            }
        }else{
            $builder->addColumn(['data' => 'name', 'name' => 'name','title' => 'Customer name','orderable' => true, 'width' => 120])
            ->addColumn(['data' => 'email', 'name' => 'email','title' => 'Email','orderable' => true, 'width' => 120])
            ->addColumn(['data' => 'mobile', 'name' => 'mobile','title' => 'Mobile Number','orderable' => true, 'width' => 120])
            ->addColumn(['data' => 'customer_number', 'name' => 'customer_number','title' => 'Customer No','orderable' => true, 'width' => 120])
            ->addColumn(['data' => 'status','name' => 'status','title' => 'Status','orderable' => true, 'width' => 120]);
        }
        $builder->addAction(['title' => 'Action', 'orderable' => true, 'width' => 120]);
        return view('crm.index')->with($data);

    }


public function advanceSearchFilter(Request $request,Builder $builder)
    {
        if(!empty($_REQUEST['filters']) && !empty($_REQUEST['module'])){
                $view_id = ___decrypt($_REQUEST['filters']);
                $data['viewColumn']=_arefy(FilterViewDetail::where(['filter_view_id'=>$view_id])->where('meta_value','!=',NULL)->get());
        }
        //$where=1;
        $data['filter']  = _arefy(FilterView::orderBy('id','desc')->where('status','active')->get());
        if(empty($_REQUEST['search_column'])){
            $data['search_column']='';
            $data['search']='';
        }else{
           // $data['search_column']=$_REQUEST['search_column'];
           // $data['search']=$_REQUEST['search'];
           // $where .=" AND ".$_REQUEST['search_column']." LIKE '%".$_REQUEST['search']."%'";
        }
        //if(!empty($request->condition0)){
        //'created_at', [$from.' 00:00:00',$to.' 23:59:59']
           // $where = $_REQUEST['search_column']." = '%".$_REQUEST['search']."%'";
            //$where.= ' AND id= 1';
            //pp($where);
       // }

        if($request->filter){

            $count=count($request->filter['advance_search']);
            for ($i=0;$i<=$count-1;$i++) {
                $text= $request->filter['search_text'][$i];
               // dd($text);
                $where=' customer_number '.''.$request->filter['advance_operator'][$i]."'".$text."' ";
                //dd($where);
            }
        }
        $data['title'] = 'Account List';
        $data['create_title'] = 'Accounts';
        $data['view'] = 'crm.accounts.list';
        $check ='<input type="checkbox" name="accountAll" id="checkedAll" >';
       /* if(Auth::user()->user_type!='admin'){
            $where .=' AND sales_agent='.Auth::user()->id;
        }*/

        $account= _arefy(Account::list('array',$where));
        if ($request->ajax()) {
        //dd($account);
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
            ->editColumn('sales_agent',function($item){
                $user = User::where('id',$item['sales_agent'])->first();
                $url=url('crm/user/'.___encrypt($item['id'].'/edit'));
                return '<a href="'.$url.'">'.$user['first_name'].'</a>';
            })
             ->editColumn('email',function($item){
                $url=url('crm/accounts/'.___encrypt($item['id']));
                return '<a href="'.$url.'">'.$item['email'].'</a>';
            })
            ->editColumn('checkbox',function($item){
               
                return '<input type="checkbox" class="checkSingle" name="account[]" value="'.$item['id'].'">';
            })
            ->rawColumns(['action','name','email','checkbox','sales_agent'])
            ->make(true);
        }
        $data['html'] = $builder
        ->parameters([
            "dom" => "<'row table table-striped table-bordered bulk_action' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",

        ])
        ->addColumn(['data' => 'checkbox', 'name' => 'checkbox','title' => $check,'orderable' => false, 'width' => 120]);
        if(!empty($_REQUEST['filter_a']) && $_REQUEST['filter_a']!='all'){
            foreach ($data['viewColumn'] as $key => $value) {
                $builder->addColumn(['data' => $value['meta_value'], 'name' => $value['meta_value'],'title' => $value['meta_name'],'orderable' => true, 'width' => 120]);
            }
        }else{
            $builder->addColumn(['data' => 'name', 'name' => 'name','title' => 'Customer name','orderable' => true, 'width' => 120])
            ->addColumn(['data' => 'email', 'name' => 'email','title' => 'Email','orderable' => true, 'width' => 120])
            ->addColumn(['data' => 'mobile', 'name' => 'mobile','title' => 'Mobile Number','orderable' => true, 'width' => 120])
            ->addColumn(['data' => 'customer_number', 'name' => 'customer_number','title' => 'Customer No','orderable' => true, 'width' => 120])
            ->addColumn(['data' => 'status','name' => 'status','title' => 'Status','orderable' => true, 'width' => 120]);
        }
        $builder->addAction(['title' => 'Action', 'orderable' => true, 'width' => 120]);
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
        $data['select']=_arefy(SelectList::where('status','active')->Orderby('id','desc')->get());
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
                \Session::flash('success', 'Account added Successfully!'); 
           
        }
        return $this->populateresponse();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data['title'] = 'Account Edit';
        $data['create_title'] = 'Accounts';
        $data['view'] = 'crm.accounts.view';
        $data['form']=_arefy(DynamicForm::where('module_type','account')->Orderby('id','desc')->get());
        $id = ___decrypt($id);
        $where=1;
        if(!empty($id)){
            if($request->view=='next'){
                $where.=' AND id < '.$id;
                $order = 'id-desc';
            }elseif($request->view=='previous'){
                $where.=' AND id > '.$id;
                $order = 'id-asc';
            }else{
                $where.=' AND id='.$id; 
                $order = 'id-desc';  
            }
        }
        $data['user_role']=_arefy(User::where('status','active')->Orderby('id','desc')->get());
        $data['account']  = _arefy(Account::list('single',$where,['*'],$order));
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
        $data['select']=_arefy(SelectList::where('status','active')->Orderby('id','desc')->get());
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
                \Session::flash('success', 'Account Updated Successfully!'); 
           
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
        $account_id_string =implode(',',$request->accounts);
        $accountIDS = explode(',', $account_id_string);
        $whereIn=$accountIDS;
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
        
            \Session::flash('success', 'Account Export mail sent Successfully!'); 
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
        $account_id_string =implode(',',$request->user);
        $accountIDS = explode(',', $account_id_string);
         return response()->json([
            'status'    => true,
            'html'      => view("crm.common.mail",['account'=>$account,'template'=>$template,'user_id'=>$accountIDS])->render()
        ]);
    }

    public function assignAccounts(Request $request){
        $account_id_string =implode(',',$request->user);
        $accountIDS = explode(',', $account_id_string);
        $account  = _arefy(Account::whereIn('id',$accountIDS)->orderBy('id','desc')->get());
        $user  = _arefy(User::where('user_type','client')->where('status', 'active')->get());
         return response()->json([
            'status'    => true,
            'html'      => view("crm.common.assign",['account'=>$account,'user'=>$user,'user_id'=>$request->user])->render()
        ]);
    }

     public function assignAccountsClient(Request $request){
        $validation = new Validations($request);
        $validator   = $validation->assignAccountsClient();
        if($validator->fails()){
        $this->message = $validator->errors();
        }else{
            foreach ($request->assign_email as  $client_id) {
                # code...
                foreach ($request->assign_id as  $assign_id) {
                    # code...
                    $data['client_id']=$client_id;
                    $data['assign_id']=$assign_id;
                    $data['module_type']=$request->module_type;
                    $data['created_at']=date('Y-m-d H:i:s');
                    $data['updated_at']=date('Y-m-d H:i:s');
                    $add = AssignToClient::insertGetId($data);
                }
            }
            $this->status   = true;
            $this->redirect = url('crm/accounts');
            \Session::flash('success', 'Account Assign to client Successfully!'); 
        }
        return $this->populateresponse();
    }

    public function export(Request $request){
        $account_info=_arefy(DynamicForm::where(['module_type'=>'account','section_type'=>'account_information'])->Orderby('id','desc')->get());
        $lead_info=_arefy(DynamicForm::where(['module_type'=>'account','section_type'=>'lead_information'])->Orderby('id','desc')->get());
        $callback_info=_arefy(DynamicForm::where(['module_type'=>'account','section_type'=>'callback_information'])->Orderby('id','desc')->get());
        $customer_info=_arefy(DynamicForm::where(['module_type'=>'account','section_type'=>'customer_information'])->Orderby('id','desc')->get());
        
         $user_role=_arefy(User::where('status','active')->Orderby('id','desc')->get());
        $account_status=_arefy(AccountStatus::where('status','active')->Orderby('id','desc')->get());
        $lead_source=_arefy(LeadSource::where('status','active')->Orderby('id','desc')->get());
        $account_id_string =implode(',',$request->user);
        $accountIDS = explode(',', $account_id_string);
        $accounts  = _arefy(Account::list('array','',['*'],'id-desc',$accountIDS));
         return response()->json([
            'status'    => true,
            'html'      => view("crm.common.export",['accounts'=>$accounts,'account_info,'=>$account_info,'lead_info,'=>$lead_info,'callback_info,'=>$callback_info,'customer_info,'=>$customer_info,'user_role,'=>$user_role,'account_status,'=>$account_status,'lead_source,'=>$lead_source,])->render()
        ]);
    }

    public function mailExport(Request $request){
        $account_id_string =implode(',',$request->user);
        $accountIDS = explode(',', $account_id_string);
        $account  = _arefy(Account::whereIn('id', $accountIDS)->get());
        $template  = _arefy(\App\Models\Email::where('status', 'active')->orderBy('id','desc')->get());
         return response()->json([
            'status'    => true,
            'html'      => view("crm.common.mailer-export",['account'=>$account,'template'=>$template])->render()
        ]);
    }

    public function advanceSearch(Request $request){

         return response()->json([
            'status'    => true,
            'html'      => view("crm.common.advance_ajax_search",['count'=>$request->count])->render()
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
        $account_id_string =implode(',',$request->user);
        $accountIDS = explode(',', $account_id_string);
        $account  = _arefy(Account::whereIn('id', $accountIDS)->get());
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
        $account_id_string =implode(',',$request->user);
        $accountIDS = explode(',', $account_id_string);
        $isUpdated          = Account::whereIn('id',$accountIDS)->delete($data);
       
        if($isUpdated){
            $this->status       = true;
            $this->redirect     = url('crm/accounts');
            $this->jsondata     = [];
        }
        return $this->populateresponse();
    }

    public function accountImport(Request $request){
        $data['view']='crm.accounts.import';
        return view('crm.index',$data);
    }

    public function uploadFile(Request $request){
        $validation = new Validations($request);
        $validator   = $validation->importAccount();
        if($validator->fails()){
            $this->message = $validator->errors();
            return $this->populateresponse();
        }
          $file = $request->file('file');
          // File Details 
          $filename = $file->getClientOriginalName();
          $extension = $file->getClientOriginalExtension();
          $tempPath = $file->getRealPath();
          $fileSize = $file->getSize();
          $mimeType = $file->getMimeType();

          // Valid File Extensions
          $valid_extension = array("csv");

          // 2MB in Bytes
          $maxFileSize = 2097152; 

          // Check file extension
          if(in_array(strtolower($extension),$valid_extension)){
            // Check file size
            if($fileSize <= $maxFileSize){

              // File upload location
              $location = 'uploads';
              $location1 = public_path('uploads');

              // Upload file
              $file->move($location1,$filename);

              // Import CSV to Database
              $filepath = public_path($location."/".$filename);

              // Reading file
              $file = fopen($filepath,"r");

              $importData_arr = array();
              $i = 0;

              while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                 $num = count($filedata );
                 
                
                 for ($c=0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata [$c];
                 }
                 $i++;
              }
              fclose($file);

              // Insert to MySQL database
              $i=0;
              foreach($importData_arr as $data){
                if($i!=0){
                    $get=Account::orderBy('id','desc')->first();
                    if(!empty($get)){
                        $id=$get->id;
                    }else{
                        $id=0;
                    }
                    $csv_data['customer_number'] = 'ACCOUNT'.$id;
                    $csv_data['name'] = $data[0];
                    $csv_data['date_of_injury'] = $data[1];
                    $csv_data['account_status'] = $data[2];
                    $csv_data['first_name'] = $data[3];
                    $csv_data['last_name'] = $data[4];
                    $csv_data['email'] = $data[5];
                    $csv_data['mobile'] = $data[6];
                    $csv_data['alternate_mobile'] = $data[7];
                    $csv_data['lead_source'] = $data[8];
                    $csv_data['injury_type'] = $data[9];
                    $csv_data['potential_defendant'] = $data[10];
                    $csv_data['date_of_injury_aware'] = $data[11];
                    $csv_data['lead_quality'] = $data[12];
                    $csv_data['facebook_injury_date'] = $data[13];
                    $csv_data['enquiry_type'] = $data[14];
                    $csv_data['panel_refrence'] = $data[15];
                    $csv_data['type_of_lead'] = $data[16];
                    $csv_data['date_lead_recieved'] = $data[17];
                    $csv_data['home_telephone_number'] = $data[18];
                    $csv_data['mobile_telephone_number'] = $data[19];
                    $csv_data['social_media_handle'] = $data[20];
                    $csv_data['date_of_birth'] = $data[21];
                    $csv_data['address'] = $data[22];
                    $csv_data['call_transfer_time'] = $data[23];
                    $csv_data['call_back_time'] = $data[24];
                    $csv_data['call_back_date'] = $data[25];
                    Account::insertGetId($csv_data);
                }
                $i++;
              }

              \Session::flash('success','Import Successful.');
            }else{
              \Session::flash('success','File too large. File must be less than 2MB.');
            }

          }else{
             \Session::flash('success','Invalid File Extension.');
          }

        $this->status   = true;
        $this->redirect = url('crm/accounts');
        return $this->populateresponse();
    }

    public function clientAssignData(Request $request,Builder $builder)
    {
        $where=1;
        /*if(!empty($_REQUEST['filter']) && !empty($_REQUEST['module'])){
                $view_id = ___decrypt($_REQUEST['filter']);
                $data['viewColumn']=_arefy(FilterViewDetail::where(['filter_view_id'=>$view_id])->where('meta_value','!=',NULL)->get());
        }
        $data['filter']  = _arefy(FilterView::orderBy('id','desc')->where('status','active')->get());
        if(empty($_REQUEST['search_column'])){
            $data['search_column']='';
            $data['search']='';
        }else{
            $data['search_column']=$_REQUEST['search_column'];
            $data['search']=$_REQUEST['search'];
            $where .=" AND ".$_REQUEST['search_column']." LIKE '%".$_REQUEST['search']."%'";
        }*/
        /*if(!empty($data['filter'])){
        //'created_at', [$from.' 00:00:00',$to.' 23:59:59']
        $where = $_REQUEST['search_column']." = '%".$_REQUEST['search']."%'";
        }*/
        $data['title'] = 'Account List';
        $data['create_title'] = 'Accounts';
        $data['view'] = 'crm.accounts.list';
        $check ='<input type="checkbox" name="accountAll" id="checkedAll" >';
        /*if(Auth::user()->user_type!='admin'){
            $where .=' AND sales_agent='.Auth::user()->id;
        }*/
        $get =_arefy(AssignToClient::where('client_id',\Auth::user()->id)->where('module_type','accounts')->get());
        $arr=[];
        foreach ($get as  $value) {
           $arr[] = $value['assign_id'];
        }
       if(empty($arr)){
            $arr=array(0);
       }
        $account= _arefy(Account::list('array',$where,['*'],'id-desc',$arr));
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
            ->editColumn('sales_agent',function($item){
                $user = User::where('id',$item['sales_agent'])->first();
                $url=url('crm/user/'.___encrypt($item['id'].'/edit'));
                return '<a href="'.$url.'">'.$user['first_name'].'</a>';
            })
             ->editColumn('email',function($item){
                $url=url('crm/accounts/'.___encrypt($item['id']));
                return '<a href="'.$url.'">'.$item['email'].'</a>';
            })
            ->editColumn('checkbox',function($item){
               
                return '<input type="checkbox" class="checkSingle" name="account[]" value="'.$item['id'].'">';
            })
            ->rawColumns(['action','name','email','checkbox','sales_agent'])
            ->make(true);
        }
        $data['html'] = $builder
        ->parameters([
            "dom" => "<'row table table-striped table-bordered bulk_action' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",

        ])
        ->addColumn(['data' => 'checkbox', 'name' => 'checkbox','title' => $check,'orderable' => false, 'width' => 120]);
        if(!empty($_REQUEST['filter']) && $_REQUEST['filter']!='all'){
            foreach ($data['viewColumn'] as $key => $value) {
                $builder->addColumn(['data' => $value['meta_value'], 'name' => $value['meta_value'],'title' => $value['meta_name'],'orderable' => true, 'width' => 120]);
            }
        }else{
            $builder->addColumn(['data' => 'name', 'name' => 'name','title' => 'Customer name','orderable' => true, 'width' => 120])
            ->addColumn(['data' => 'email', 'name' => 'email','title' => 'Email','orderable' => true, 'width' => 120])
            ->addColumn(['data' => 'mobile', 'name' => 'mobile','title' => 'Mobile Number','orderable' => true, 'width' => 120])
            ->addColumn(['data' => 'customer_number', 'name' => 'customer_number','title' => 'Customer No','orderable' => true, 'width' => 120])
            ->addColumn(['data' => 'status','name' => 'status','title' => 'Status','orderable' => true, 'width' => 120]);
        }
        $builder->addAction(['title' => 'Action', 'orderable' => true, 'width' => 120]);
        return view('crm.index')->with($data);
    }
}
