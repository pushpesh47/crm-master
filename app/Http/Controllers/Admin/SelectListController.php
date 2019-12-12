<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Validations\Admin\Validate as Validations;
use App\Models\SelectList;
class SelectListController extends Controller
{
    public function __construct(Request $request){
        
        parent::__construct($request);
        
    }
    public function index(Request $request,Builder $builder)
    {
        $data['title'] = \Request::segment(3);
        $type = strtolower(\Request::segment(3));
        $data['create_title'] = '';
        $data['view'] = 'crm.select-list.list';
        //$exam  = _arefy(Account::orderBy('id','desc')->get());
        $account= _arefy(SelectList::where('type',$type)->orderBy('id','desc')->get());
        if ($request->ajax()) {
            return DataTables::of($account)
            ->editColumn('action',function($item){
                $html    = '<div class="edit_details_box">';
                $html   .= '<a href="'.url(sprintf('crm/select/'.$item['type'].'/%s/edit',___encrypt($item['id']))).'"  title="Edit Detail"><i class="fa fa-edit"></i></a> | ';
                if($item['status'] == 'active'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('crm/select/'.$item['type'].'/status/?id=%s&status=inactive',___encrypt($item['id']))).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/images/inactive-user.png').'"
                        data-ask="Would you like to change '.$item['name'].' status from active to inactive?" title="Update Status"><i class="fa fa-fw fa-ban"></i></a>';
                }elseif($item['status'] == 'inactive'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('crm/select/'.$item['type'].'/status/?id=%s&status=active',___encrypt($item['id']))).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/images/active-user.png').'"
                        data-ask="Would you like to change '.$item['name'].' status from inactive to active?" title="Update Status"><i class="fa fa-fw fa-check"></i></a>';
                }elseif($item['status'] == 'pending'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('crm/select/'.$item['type'].'/status/?id=%s&status=active',___encrypt($item['id']))).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/images/active-user.png').'"
                        data-ask="Would you like to change '.$item['name'].' status from pending to active?" title="Update Status"><i class="fa fa-fw fa-check"></i></a>';
                }
                /*$html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('crm/account-status/status/?id=%s&status=trashed',___encrypt($item['id']))).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/images/active-user.png').'"
                        data-ask="Are you sure you want to delete '.$item['name'].' ?" title="Delete"><i class="fa fa-fw fa-trash"></i></a>';*/
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('status',function($item){
                return ucfirst($item['status']);
            })
            ->editColumn('name',function($item){
                $url=url('crm/select/'.___encrypt($item['id'].'/edit'));
                return '<a href="'.$url.'">'.$item['name'].'</a>';
            })
             
            ->rawColumns(['action','name'])
            ->make(true);
        }
        $data['html'] = $builder
        ->parameters([
            "dom" => "<'row table table-striped table-bordered bulk_action' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",

        ])
        ->addColumn(['data' => 'name', 'name' => 'name','title' => 'Name','orderable' => false, 'width' => 120])
       
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
        $data['title'] = \Request::segment(3);
        $type = strtolower(\Request::segment(3));
        $data['view']='crm.select-list.add';
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
        $validator   = $validation->addSelect();
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $data['name']=$request->name;
            $data['type']=$request->type;
            $data['module_type']='accounts';
            $data['created_at']=date('Y-m-d H:i:s');
            $data['updated_at']=date('Y-m-d H:i:s');
            $add = SelectList::insertGetId($data);
            $this->status   = true;
            $this->redirect = url('crm/select/'.$request->type);
            \Session::flash('success', $request->type.' added Succesful!'); 
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
    public function edit($type,$id)
    {
        $data['title'] = $type;
        $data['create_title'] = '';
        $data['view'] = 'crm.select-list.edit';
       
        $id = ___decrypt($id);
        $where='id='.$id;
        $data['acc_status']  = _arefy(SelectList::where('id',$id)->first());
        return view('crm.index',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $type,$id)
    {
        $validation = new Validations($request);
        $validator   = $validation->addSelect('edit');
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{

                $id = ___decrypt($id);
                $data['name']=$request->name;
                $data['updated_at']=date('Y-m-d H:i:s');
                $add = SelectList::where('id',$id)->update($data);
                
                $this->status   = true;
                $this->redirect = url('crm/select/'.$request->type);
                \Session::flash('success', $request->type.' Updated Succesful!'); 
           
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
            $isUpdated              = SelectList::where('id',$id)->delete();
        }else{
            $isUpdated              = SelectList::where('id',$id)->update($data);
        }
        if($isUpdated){
            $this->status       = true;
            $this->redirect     = true;
            $this->jsondata     = [];
        }
        return $this->populateresponse();
    }
}
