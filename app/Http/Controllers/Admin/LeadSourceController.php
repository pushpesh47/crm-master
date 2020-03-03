<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\AccountMoreDetail;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Validations\Admin\Validate as Validations;
use App\Models\LeadSource;
class LeadSourceController extends Controller
{
	public function __construct(Request $request){
        
        parent::__construct($request);
        
    }
    public function index(Request $request,Builder $builder)
    {
        $data['title'] = 'Lead Source List';
        $data['create_title'] = 'Lead Source';
        $data['view'] = 'crm.lead-source.list';
        //$exam  = _arefy(Account::orderBy('id','desc')->get());
        $account= _arefy(LeadSource::orderBy('id','desc')->get());
        if ($request->ajax()) {
            return DataTables::of($account)
            ->editColumn('action',function($item){
                $html    = '<div class="edit_details_box">';
                $html   .= '<a href="'.url(sprintf('crm/lead-source/%s/edit',___encrypt($item['id']))).'"  title="Edit Detail"><i class="fa fa-edit"></i></a> | ';
                if($item['status'] == 'active'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('crm/lead-source/status/?id=%s&status=inactive',___encrypt($item['id']))).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/images/inactive-user.png').'"
                        data-ask="Would you like to change '.$item['lead_source'].' status from active to inactive?" title="Update Status"><i class="fa fa-fw fa-ban"></i></a>';
                }elseif($item['status'] == 'inactive'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('crm/lead-source/status/?id=%s&status=active',___encrypt($item['id']))).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/images/active-user.png').'"
                        data-ask="Would you like to change '.$item['lead_source'].' status from inactive to active?" title="Update Status"><i class="fa fa-fw fa-check"></i></a>';
                }elseif($item['status'] == 'pending'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('crm/lead-source/status/?id=%s&status=active',___encrypt($item['id']))).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/images/active-user.png').'"
                        data-ask="Would you like to change '.$item['lead_source'].' status from pending to active?" title="Update Status"><i class="fa fa-fw fa-check"></i></a>';
                }
                /*$html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('crm/lead-source/status/?id=%s&status=trashed',___encrypt($item['id']))).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/images/active-user.png').'"
                        data-ask="Are you sure you want to delete '.$item['lead_source'].' ?" title="Delete"><i class="fa fa-fw fa-trash"></i></a>';*/
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('status',function($item){
                return ucfirst($item['status']);
            })
            ->editColumn('name',function($item){
                $url=url('crm/lead-source/'.___encrypt($item['id'].'/edit'));
                return '<a href="'.$url.'">'.$item['lead_source'].'</a>';
            })
             
            ->rawColumns(['action','name'])
            ->make(true);
        }
        $data['html'] = $builder
        ->parameters([
            "dom" => "<'row table table-striped table-bordered bulk_action' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",

        ])
        ->addColumn(['data' => 'name', 'name' => 'name','title' => 'Lead Source','orderable' => false, 'width' => 120])
       
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
       $data['title'] = 'Lead Source';
        $data['view']='crm.lead-source.add';
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
        $validator   = $validation->addLeadSource();
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
                
                $data['lead_source']=$request->lead_source;
                $data['created_at']=date('Y-m-d H:i:s');
                $data['updated_at']=date('Y-m-d H:i:s');
                $add = LeadSource::insertGetId($data);
                
                /*if($add){
                    $more[]
                }*/
                $this->status   = true;
               // $this->modal    = true;
               // $this->alert    = true;
                //$this->message  = "Admin Login successfully.";
                $this->redirect = url('crm/lead-source');
                \Session::flash('success', 'Lead Source added Successfully!'); 
           
        }
        return $this->populateresponse();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Lead Source';
        $data['create_title'] = 'Lead Source';
        $data['view'] = 'crm.lead-source.edit';
       
        $id = ___decrypt($id);
        $where='id='.$id;
        $data['acc_status']  = _arefy(LeadSource::where('id',$id)->first());
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
        $validator   = $validation->addLeadSource('edit');
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
                $id = ___decrypt($id);
                $data['lead_source']=$request->lead_source;
                $data['updated_at']=date('Y-m-d H:i:s');
                $add = LeadSource::where('id',$id)->update($data);
                
                $this->status   = true;
               // $this->modal    = true;
               // $this->alert    = true;
                //$this->message  = "Admin Login successfully.";
                $this->redirect = url('crm/lead-source');
                \Session::flash('success', 'Lead Source Updated Successfully!'); 
           
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
            $isUpdated              = LeadSource::where('id',$id)->delete();
        }else{
            $isUpdated              = LeadSource::where('id',$id)->update($data);
        }
        if($isUpdated){
            $this->status       = true;
            $this->redirect     = true;
            $this->jsondata     = [];
        }
        return $this->populateresponse();
    }
}
