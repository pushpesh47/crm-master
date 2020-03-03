<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FilterView;
use App\Models\FilterViewDetail;
use App\Models\Column;
use Validations\Admin\Validate as Validations;
class FilterController extends Controller
{
    public function create(Request $request){
    	$data['view']='crm.accounts.create-search';
    	return view('crm.index',$data);
    }

    public function store(Request $request)
    {
    	$validation = new Validations($request);
        $validator   = $validation->addFilter();
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
        	$data['view_name']=$request->view_name;
        	$data['set_as_default']=$request->set_as_default;
        	$data['set_as_public']=$request->set_as_public;
        	$data['list_in_metrics']=$request->list_in_metrics;
        	$data['column_from']=$request->column_from;
        	$data['column_days']=$request->column_days;
        	$data['start_date']=$request->start_date;
        	$data['end_date']=$request->end_date;
        	$data['module_type']='accounts';
        	$data['filter_type']='advance';
        	$data['status']='active';
        	$last_id = FilterView::insertGetId($data);
        	foreach ($request->column as $key => $value) {
        			$val = explode(',', $value);
	        		$details['meta_key']=$key;
	        		$details['meta_value']=!empty($val[0])?$val[0]:NULL;
	        		$details['meta_name']=!empty($val[1])?$val[1]:NULL;
	        		$details['filter_view_id']=$last_id;
	        		$insert = FilterViewDetail::insertGetId($details);
        	}
    	 	$this->status   = true;
            $this->redirect = url('crm/accounts');
            \Session::flash('success', 'Filter Created Succesful!'); 
        }
       return $this->populateresponse();
    }

	public function edit(Request $request,$id){
		$id=___decrypt($id);
		$data['view']='crm.accounts.edit-search';
		$data['columns']=_arefy(Column::where(['module_type'=>'accounts','status'=>'active'])->get());
		$where='id='.$id;
		$data['filter']=_arefy(FilterView::list('single',$where));
		return view('crm.index',$data);
	}

	public function update(Request $request,$id)
    {
        //pp($request->column);
        
        /*else{
            pp('failed');
        }*/

    	$validation = new Validations($request);
        $validator   = $validation->addFilter();
        
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
        	$id=___decrypt($id);
        	$data['view_name']=$request->view_name;
        	$data['set_as_default']=$request->set_as_default;
        	$data['set_as_public']=$request->set_as_public;
        	$data['list_in_metrics']=$request->list_in_metrics;

        	$data['column_from']=$request->column_from;
        	$data['column_days']=$request->column_days;
        	$data['start_date']=$request->start_date;
        	$data['end_date']=$request->end_date;
        	$data['module_type']='accounts';
        	$data['filter_type']='advance';
        	$data['status']='active';
        	$last_id = FilterView::where('id',$id)->update($data);
        	//dd($request->column);
        	foreach ($request->column as $key => $value) {
				$val = explode(',', $value);
				$details['meta_key']=$key;
				$details['meta_value']=!empty($val[0])?$val[0]:NULL;
				$details['meta_name']=!empty($val[1])?$val[1]:NULL;
        		$details['filter_view_id']=$id;
        		$insert = FilterViewDetail::where(['filter_view_id'=>$id,'meta_key'=>$key])->update($details);
        	}
    	 	$this->status   = true;
            $this->redirect = url('crm/accounts');
            \Session::flash('success', 'Filter Updated Succesful!'); 
        }
       return $this->populateresponse();
    }

    public function actionPage(Request $request){
         return response()->json([
            'status'    => true,
            'html'      => view("crm.accounts.filter_action",['filter'=>$request->filter])->render()
        ]);
    }

    public function destroy(Request $request,$id)
    {
    	$id = ___decrypt($id);
    	FilterView::where('id',$id)->delete();
    	FilterViewDetail::where('filter_view_id',$id)->delete();
    	return redirect(url('crm/accounts'));
    }
}
