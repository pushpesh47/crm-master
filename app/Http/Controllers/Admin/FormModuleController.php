<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Account;
Use App\Models\DynamicForm;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Validations\Admin\Validate as Validations;
class FormModuleController extends Controller
{
	public function __construct(Request $request){
        
        parent::__construct($request);
        
    }
    public function index(Request $request,Builder $builder)
    {
        $data['title'] = 'Form Module';
        $data['create_title'] = 'Form Module';
        $data['view'] = 'crm.form_module.list';
        $exam  = _arefy(DynamicForm::orderBy('id','desc')->get());
        if ($request->ajax()) {
            return DataTables::of($exam)
            ->editColumn('action',function($item){
                $html    = '<div class="edit_details_box">';
                $html   .= '<a href="'.url(sprintf('crm/form-module/%s/edit',___encrypt($item['id']))).'"  title="Edit Detail"><i class="fa fa-edit"></i></a> | ';
                if($item['status'] == 'active'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('crm/form-module/status/?id=%s&status=inactive',___encrypt($item['id']))).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/images/inactive-user.png').'"
                        data-ask="Would you like to change '.$item['field_label'].' status from active to inactive?" title="Update Status"><i class="fa fa-fw fa-ban"></i></a> |';
                }elseif($item['status'] == 'inactive'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('crm/form-module/status/?id=%s&status=active',___encrypt($item['id']))).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/images/active-user.png').'"
                        data-ask="Would you like to change '.$item['field_label'].' status from inactive to active?" title="Update Status"><i class="fa fa-fw fa-check"></i></a> |';
                }elseif($item['status'] == 'pending'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('crm/form-module/status/?id=%s&status=active',___encrypt($item['id']))).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/images/active-user.png').'"
                        data-ask="Would you like to change '.$item['field_label'].' status from pending to active?" title="Update Status"><i class="fa fa-fw fa-check"></i></a> |';
                }
                $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('crm/form-module/status/?id=%s&status=trashed',___encrypt($item['id']))).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/images/active-user.png').'"
                        data-ask="Are you sure you want to delete '.$item['field_label'].' ?" title="Delete"><i class="fa fa-fw fa-trash"></i></a>';
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('status',function($item){
                return ucfirst($item['status']);
            })
           
            ->rawColumns(['action'])
            ->make(true);
        }
        $data['html'] = $builder
        ->parameters([
            "dom" => "<'row table table-striped table-bordered bulk_action' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
        ])
        ->addColumn(['data' => 'field_label', 'name' => 'field_label','title' => 'Field Label','orderable' => false, 'width' => 120])
        ->addColumn(['data' => 'field_type', 'name' => 'field_type','title' => 'Field Type','orderable' => false, 'width' => 120])
        ->addColumn(['data' => 'module_type', 'name' => 'module_type','title' => 'Module Type','orderable' => false, 'width' => 120])
        ->addColumn(['data' => 'status','name' => 'status','title' => 'Status','orderable' => false, 'width' => 120])
        ->addAction(['title' => 'Action', 'orderable' => false, 'width' => 120]);
        return view('crm.index')->with($data);
    }

    public function create()
    {
         $data['title'] = 'Form Module';
        $data['view']='crm.form_module.add';
        return view('crm.index',$data);
    }
public function store(Request $request)
    {
        $validation = new Validations($request);
        $validator   = $validation->addFromField();
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
                $formId = DynamicForm::Orderby('id','desc')->first();
                if(!empty($formId)){
                	$data['field_name']='cf_0'.$formId->id;
                }else{
                	$data['field_name']='cf_00';
                }
                $data['field_label']=$request->field_label;
                $data['field_type']=$request->field_type;
                $data['module_type']=$request->module_type;
                $data['section_type']=$request->section_type;
                $data['created_at']=date('Y-m-d H:i:s');
                $data['updated_at']=date('Y-m-d H:i:s');
                $add = DynamicForm::insertGetId($data);

                $this->status   = true;
               // $this->modal    = true;
               // $this->alert    = true;
                //$this->message  = "Admin Login successfully.";
                $this->redirect = url('crm/form-module');
                \Session::flash('success', 'Form Field added Successfully!'); 
           
        }
        return $this->populateresponse();
    }

    public function edit($id)
    {
        $data['title'] = 'Account Edit';
        $data['create_title'] = 'Accounts';
        $data['view'] = 'crm.form_module.edit';
        $id = ___decrypt($id);
        $data['form']=_arefy(DynamicForm::where('id',$id)->first());
       
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
        $validator   = $validation->addFromField('edit');
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
                $id = ___decrypt($id);
                $data['field_label']=$request->field_label;
                $data['field_type']=$request->field_type;
                $data['module_type']=$request->module_type;
                $data['section_type']=$request->section_type;
                $data['updated_at']=date('Y-m-d H:i:s');
                $add = DynamicForm::where('id',$id)->update($data);
                
                $this->status   = true;
               // $this->modal    = true;
               // $this->alert    = true;
                //$this->message  = "Admin Login successfully.";
                $this->redirect = url('crm/form-module');
                \Session::flash('success', 'Account Updated Successfully!'); 
           
        }
        return $this->populateresponse();
    }

    public function changeStatus(Request $request){
        $id=___decrypt($request->id);
        $data                   = ['status'=>$request->status,'updated_at'=>date('Y-m-d H:i:s')];

        if($request->status=="trashed"){
            $isUpdated              = DynamicForm::where('id',$id)->delete();
        }else{
            $isUpdated              = DynamicForm::where('id',$id)->update($data);
        }
        if($isUpdated){
            $this->status       = true;
            $this->redirect     = true;
            $this->jsondata     = [];
        }
        return $this->populateresponse();
    }
}
