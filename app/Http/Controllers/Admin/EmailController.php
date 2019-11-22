<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Validations\Admin\Validate as Validations;
use App\Models\Email;
class EmailController extends Controller
{
    public function __construct(Request $request){
        
        parent::__construct($request);
        
    }
    public function index(Request $request,Builder $builder)
    {
        $data['title'] = 'Email List';
        $data['create_title'] = 'Email';
        $data['view'] = 'crm.emails.list';
        //$exam  = _arefy(Account::orderBy('id','desc')->get());
        $account= _arefy(Email::orderBy('id','desc')->get());
        if ($request->ajax()) {
            return DataTables::of($account)
            ->editColumn('action',function($item){
                $html    = '<div class="edit_details_box">';
                $html   .= '<a href="'.url(sprintf('crm/emails/%s/edit',___encrypt($item['id']))).'"  title="Edit Detail"><i class="fa fa-edit"></i></a> | ';
                if($item['status'] == 'active'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('crm/emails/status/?id=%s&status=inactive',___encrypt($item['id']))).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/images/inactive-user.png').'"
                        data-ask="Would you like to change '.$item['title'].' status from active to inactive?" title="Update Status"><i class="fa fa-fw fa-ban"></i></a>';
                }elseif($item['status'] == 'inactive'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('crm/emails/status/?id=%s&status=active',___encrypt($item['id']))).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/images/active-user.png').'"
                        data-ask="Would you like to change '.$item['title'].' status from inactive to active?" title="Update Status"><i class="fa fa-fw fa-check"></i></a>';
                }elseif($item['status'] == 'pending'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('crm/emails/status/?id=%s&status=active',___encrypt($item['id']))).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/images/active-user.png').'"
                        data-ask="Would you like to change '.$item['title'].' status from pending to active?" title="Update Status"><i class="fa fa-fw fa-check"></i></a>';
                }
                /*$html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('crm/emails/status/?id=%s&status=trashed',___encrypt($item['id']))).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/images/active-user.png').'"
                        data-ask="Are you sure you want to delete '.$item['title'].' ?" title="Delete"><i class="fa fa-fw fa-trash"></i></a>';*/
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('status',function($item){
                return ucfirst($item['status']);
            })
            ->editColumn('name',function($item){
                $url=url('crm/emails/'.___encrypt($item['id'].'/edit'));
                return '<a href="'.$url.'">'.$item['title'].'</a>';
            })
             
            ->rawColumns(['action','name'])
            ->make(true);
        }
        $data['html'] = $builder
        ->parameters([
            "dom" => "<'row table table-striped table-bordered bulk_action' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",

        ])
        ->addColumn(['data' => 'name', 'name' => 'name','title' => 'Email','orderable' => false, 'width' => 120])
       
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
       $data['title'] = 'Email';
        $data['view']='crm.emails.add';
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
        $validator   = $validation->addEmail();
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
                
                $data['title']=$request->title;
                $data['subject']=$request->subject;
                $data['alias']=$request->alias;
                $data['content']=$request->content;
                $data['variables']='{name}';
                $data['updated_at']=date('Y-m-d H:i:s');
                $data['created_at']=date('Y-m-d H:i:s');
                $add = Email::insertGetId($data);
                
                /*if($add){
                    $more[]
                }*/
                $this->status   = true;
               // $this->modal    = true;
               // $this->alert    = true;
                //$this->message  = "Admin Login successfully.";
                $this->redirect = url('crm/emails');
                \Session::flash('success', 'Email added Succesful!'); 
           
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
        $data['title'] = 'Email';
        $data['create_title'] = 'Email';
        $data['view'] = 'crm.emails.edit';
       
        $id = ___decrypt($id);
        $where='id='.$id;
        $data['email']  = _arefy(Email::where('id',$id)->first());
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
        $validator   = $validation->addEmail('edit');
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
                $id = ___decrypt($id);
                $data['title']=$request->title;
                $data['subject']=$request->subject;
                $data['alias']=$request->alias;
                $data['content']=$request->content;
                $data['updated_at']=date('Y-m-d H:i:s');
                $add = Email::where('id',$id)->update($data);
                
                $this->status   = true;
               // $this->modal    = true;
               // $this->alert    = true;
                //$this->message  = "Admin Login successfully.";
                $this->redirect = url('crm/emails');
                \Session::flash('success', 'Email Updated Succesful!'); 
           
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
            $isUpdated              = Email::where('id',$id)->delete();
        }else{
            $isUpdated              = Email::where('id',$id)->update($data);
        }
        if($isUpdated){
            $this->status       = true;
            $this->redirect     = true;
            $this->jsondata     = [];
        }
        return $this->populateresponse();
    }

    public function SentEmail(Request $request){
        pp($request->all());
    	$validation = new Validations($request);
        $validator   = $validation->sentEmail('edit');
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
        	foreach ($request->email_to as $key => $email) {
        		$user = \App\Models\Account::where('email',$email)->first();
        		$template = \App\Models\Email::where('id',$request->template)->first();
				$emailData               = ___email_settings();
				$emailData['name']       = $user->first_name; 
				$emailData['email']      = !empty($email)?$email:'';
				$emailData['password']      = '1234567';
				$emailData['subject']    =  $request->subject;
				if(!empty($request->attachment)){
					$emailData['attachment']    =  $request->attachment;
				}
				$emailData['date']       = date('Y-m-d H:i:s');
				$emailData['custom_text'] = 'Your Enquiry has been submitted successfully';
				$mailSuccess = ___mail_sender($emailData['email'],$user->first_name,$template->title,$emailData);
        	}
			$this->status   = true;

			$this->redirect = true;
			\Session::flash('success', 'Email Sent Succesful!'); 
           
        }
        return $this->populateresponse();
    }
}
