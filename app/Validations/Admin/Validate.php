<?php

namespace Validations\Admin;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
Use App\Models\User;
Use App\Models\UserRole;
Use App\Models\AccountStatus;
Use App\Models\LeadSource;
Use App\Models\Email;
Use App\Models\Account;
Use App\Models\SelectList;
use Hash;
/**
* 
*/
class Validate
{
	protected $data;
	public function __construct($data){
		$this->data = $data;
	}
	private function validation($key){
		$validation = [
			'id'					=> ['required'],
			'email'					=> ['nullable','email'],
			'req_email'				=> ['required','email'],
			'first_name' 			=> ['required','string'],
			'name' 					=> ['required','string'],
			'name_product' 			=> ['required','string'],
			'last_name' 			=> ['nullable','string'],
			'date_of_birth' 		=> ['nullable','string'],
			'gender' 				=> ['required','string'],
			'phone_code' 			=> ['nullable','required_with:mobile_number','string'],
			'mobile_number' 		=> ['required'],
			'req_mobile_number' 	=> ['required','required_with:phone_code','numeric','digits:10'],
			'country' 				=> ['required','string'],
			'address'           	=> ['nullable','string','max:1500'],
			'qualifications'    	=> ['required','string','max:1500'],
			'specifications'    	=> ['nullable','string','max:1500'],
			'description'       	=> ['required','string'],
			'slug_cat'				=> ['required','max:255'],
			'title'             	=> ['required','string'],
			'profile_picture'   	=> ['required','mimes:doc,docx,pdf','max:2048'],
			'import_file'   		=> ['required'/*,'mimes:csv'*/],
			
			'pin_code' 				=> ['nullable','max:6','min:4'],
			'appointment_date'  	=> ['required','string'],
			'type' 	            	=> ['required','string'],
			'phone' 	        	=> ['required','numeric'],
			'course' 	        	=> ['required','string'],
			'location' 	        	=> ['required','string'],
			'comments' 	        	=> ['required','string'],
			'password'          	=> ['required','string','max:50'],
			'c_password'          	=> ['required','same:password'],
			'price'					=> ['required','numeric'],
			'country'					=> ['nullable','numeric'],
			'start_from'			=> ['required'],
			'photo'					=> ['required','mimes:jpg,jpeg,png','max:2408'],
			'photomimes'			=> ['mimes:jpg,jpeg,png','max:2408'],
			'zipmimes'			    => ['mimes:zip'],
			'zipmimes_required'	    => ['required','mimes:zip,jpg,jpeg,png,doc,docx,pdf'],
				'doc_file_any'			=> ['nullable','mimes:jpg,jpeg,png,doc,docx,pdf','max:5120'],
			'video'  				=> ['required','mimes:mp4,mov,ogg,qt','max:51200'],
			'photo_null'			=> ['nullable'],
			'gallery'				=> ['required','mimes:jpg,jpeg,png','max:2048'],
			'gallery_null'			=> ['nullable'],
			'url' 				    => ['required','url'],
			'slug_no_space'		    => ['required','alpha_dash','max:255'],
			'password_check'	    => ['required'],
			'file'					=> ['required','mimes:pdf'],
			'document_file'		    => ['nullable','mimes:jpg,jpeg,png','max:5120'],
			'newpassword'		    => ['required','max:10'],	
			'child'		    		=> ['required','array','min:1'],	
			'child_details'		    => ['required','string','distinct','min:1'],
			'video_null'			=> ['nullable','mimes:mp4,mov,ogg,qt','max:51200'],
			'photo_null'			=> ['nullable','mimes:jpg,jpeg,png','max:2048'],
			'number_req'			=> ['required','integer','in:0,1'],
		];
		return $validation[$key];
	}


	public function login(){
		$validations = [
        	'email' 						=> $this->validation('req_email'),
        	'password' 						=> $this->validation('password'),
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
    	if(!empty($this->data->email)){
				$userDetails = \App\User::where('email',$this->data->email)->first();
			    $validator->after(function ($validator) use($userDetails) {
			    	if(empty($userDetails)){
			    		$validator->errors()->add('email', 'No Account Found With This Email.');
			    	}/*elseif($userDetails->status!='active'){
			    		$validator->errors()->add('mobile_number', 'Your account is not active.Please contact with adminstrator for more info.');
			    	}elseif($userDetails->user_type!='admin'){
			    		$validator->errors()->add('email', 'You are not authorised user to login.');
			    	}*/
			    	    
			    });
			}
		
		return $validator;
	}
	 

	 public function addAccount($action="add")
	{

		$validations = [
			'first_name'					=> $this->validation('name'),
			'last_name'						=> $this->validation('name'),
        	'email'					        => $this->validation('req_email'),
        	'mobile'						=> $this->validation('mobile_number'),
    	];

    	$validator = \Validator::make($this->data->all(), $validations,[]);
		if($action=='edit'){

			if(!empty($this->data->mobile)){
				$userDetails = Account::where('mobile',$this->data->mobile)->where('id','!=',$this->data->id)->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('mobile', 'Mobile Number Already Exist.');
					}        
				});
			}
			if(!empty($this->data->email)){
				$userDetails = Account::where('email',$this->data->email)->where('id','!=',$this->data->id)->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('email', 'E-mail Already Exist.');
					}        
				});
			}

		}else{
			if(!empty($this->data->mobile)){
				$userDetails = Account::where('mobile',$this->data->mobile)->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('mobile', 'Mobile Number Already Exist.');
					}        
				});
			}
			if(!empty($this->data->email)){
				$userDetails = Account::where('email',$this->data->email)->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('email', 'E-mail Already Exist.');
					}        
				});
			}
		}
		return $validator;
	}

	public function group($action='add'){
		$validations = [
			'name' 						=> $this->validation('name'),
		];
		$validator = \Validator::make($this->data->all(), $validations,[]);
		if($action=='add'){
			if(!empty($this->data->name)){
				$userDetails = Group::where('name',$this->data->name)->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('name', 'Name already exist.');
					}
				});
			}
		}else{
			if(!empty($this->data->name)){
				$Details = Group::where('name',$this->data->name)->where('id','!=',$this->data->id)->first();
				$validator->after(function ($validator) use($Details) {
					if(!empty($Details)){
						$validator->errors()->add('name', 'Name Already Exist.');
					}        
				});
			}

		}

		return $validator;
	}

	public function addSubject($action='add'){
		$validations = [
			'group_id' 							=> $this->validation('id'),
			'subject_name' 						=> $this->validation('name'),
		];
		$validator = \Validator::make($this->data->all(), $validations,[]);
		if($action=='add'){
			if(!empty($this->data->subject_name)){
				$userDetails = Subject::where('subject_name',$this->data->subject_name)->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('subject_name', 'Name already exist.');
					}
				});
			}
		}else{
			if(!empty($this->data->subject_name)){
				$Details = Subject::where('subject_name',$this->data->subject_name)->where('id','!=',$this->data->id)->first();
				$validator->after(function ($validator) use($Details) {
					if(!empty($Details)){
						$validator->errors()->add('subject_name', 'Name Already Exist.');
					}        
				});
			}

		}

		return $validator;
	}

	public function addQuestion($action='add'){
		if(empty($this->data->import)){
				$validations = [
					'question_type' 					=> $this->validation('name'),
					'question' 							=> $this->validation('name'),
					'group' 							=> $this->validation('id'),
					'subject' 						=> $this->validation('id'),
					'marks' 						=> $this->validation('id'),
					'negative_marks' 				=> $this->validation('id'),
					'difficulty_level' 				=> $this->validation('name'),
				];
		}else{
			$validations = [
					'question_import' 			=> $this->validation('question_file'),
					'group' 					=> $this->validation('id'),
					'subject' 					=> $this->validation('id'),
				];
		}
		$validator = \Validator::make($this->data->all(), $validations,[]);
		if($action=='add'){
			if(!empty($this->data->subject_name)){
				$userDetails = Subject::where('subject_name',$this->data->subject_name)->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('subject_name', 'Name already exist.');
					}
				});
			}
		}else{
			if(!empty($this->data->subject_name)){
				$Details = Subject::where('subject_name',$this->data->subject_name)->where('id','!=',$this->data->id)->first();
				$validator->after(function ($validator) use($Details) {
					if(!empty($Details)){
						$validator->errors()->add('subject_name', 'Name Already Exist.');
					}        
				});
			}

		}

		return $validator;
	}
	public function addExamSchedule($action='add'){
		
		$validations = [
			'exam_name' 					=> $this->validation('name'),
			'passing_percentage' 			=> $this->validation('name'),
			'instruction' 					=> $this->validation('name'),
			'exam_duration' 				=> $this->validation('name'),
			'attempt_count' 				=> $this->validation('name'),
			'start_date' 				=> $this->validation('name'),
			'end_date' 					=> $this->validation('name'),
			'group' 				=> $this->validation('id'),
			'expiry_days' 				=> $this->validation('name'),
			'answer_sheet' 				=> $this->validation('number_req'),
			'negative_mark' 				=> $this->validation('number_req'),
			'paid_exam' 				=> $this->validation('number_req'),
			'browser_tolerance' 				=> $this->validation('number_req'),
			'result_after_finish' 				=> $this->validation('number_req'),
			'instant_result' 				=> $this->validation('number_req'),
			'random_question' 				=> $this->validation('number_req'),
			'mode' 				=> $this->validation('number_req'),
		];
		
		$validator = \Validator::make($this->data->all(), $validations,[]);
		
		return $validator;
	}
	public function addFromField($action='add'){
		$validations = [
			'module_type' 						=> $this->validation('name'),
			'field_label' 						=> $this->validation('name'),
			'field_type' 						=> $this->validation('name'),
		];
		$validator = \Validator::make($this->data->all(), $validations,[]);
		
		return $validator;
	}

	 public function updateProfile($action="add")
	{

		$validations = [
			'first_name'					=> $this->validation('name'),
			'last_name'						=> $this->validation('name'),
        	'email'					        => $this->validation('req_email'),
        	'mobile'						=> $this->validation('mobile_number'),
    	];

    	$validator = \Validator::make($this->data->all(), $validations,[]);
		if($action=='edit'){

			if(!empty($this->data->mobile)){
				$userDetails = Account::where('mobile',$this->data->mobile)->where('id','!=',\Auth::user()->id)->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('mobile', 'Mobile Number Already Exist.');
					}        
				});
			}
			
			if(!empty($this->data->email)){
				$userDetails = Account::where('email',$this->data->email)->where('id','!=',\Auth::user()->id)->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('email', 'E-mail Already Exist.');
					}        
				});
			}

		}
		return $validator;
	}

	 public function changePassword($action="add")
	{

		$validations = [
			'old_password'					=> $this->validation('name'),
			'password'						=> $this->validation('password'),
        	'confirm_password'				=> $this->validation('c_password'),
        	
    	];

    	$validator = \Validator::make($this->data->all(), $validations,[]);
		
		return $validator;
	}

	 public function addRole($action="add")
	{

		$validations = [
			'profile_name'					=> $this->validation('name'),
        	
    	];

    	$validator = \Validator::make($this->data->all(), $validations,[]);
    	if($action=='add'){
			if(!empty($this->data->profile_name)){
				$userDetails = UserRole::where('profile_name',$this->data->profile_name)->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('profile_name', 'Name already exist.');
					}
				});
			}
		}else{
			if(!empty($this->data->profile_name)){
				$Details = UserRole::where('profile_name',$this->data->profile_name)->where('id','!=',$this->data->id)->first();
				$validator->after(function ($validator) use($Details) {
					if(!empty($Details)){
						$validator->errors()->add('profile_name', 'Name Already Exist.');
					}        
				});
			}

		}
		
		return $validator;
	}


	 public function addUser($action="add")
	{
		
		$validations = [
			'first_name'					=> $this->validation('name'),
			'last_name'						=> $this->validation('name'),
        	'email'					        => $this->validation('req_email'),
        	'username'					    => $this->validation('name'),
        	'mobile'						=> $this->validation('mobile_number'),
        	'password'						=> $this->validation('c_password'),
        	'user_role'						=> $this->validation('name'),
    	];
    	if($action=="edit"){
				$validations = [
				
	        	'password'						=>'',
	    	];
		}
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		if($action=='edit'){

			if(!empty($this->data->mobile)){
				$userDetails = User::where('mobile',$this->data->mobile)->where('id','!=',$this->data->id)->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('mobile', 'Mobile Number Already Exist.');
					}        
				});
			}

			if(!empty($this->data->username)){
				$userDetails = User::where('username',$this->data->username)->where('id','!=',$this->data->id)->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('username', 'username Number Already Exist.');
					}        
				});
			}
			
			if(!empty($this->data->email)){
				$userDetails = User::where('email',$this->data->email)->where('id','!=',$this->data->id)->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('email', 'E-mail Already Exist.');
					}        
				});
			}

		}else{
			
			if(!empty($this->data->mobile)){
				$userDetails = User::where('mobile',$this->data->mobile)->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('mobile', 'Mobile Number Already Exist.');
					}        
				});
			}
			if(!empty($this->data->username)){
				$userDetails = User::where('username',$this->data->username)->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('username', 'username Number Already Exist.');
					}        
				});
			}
			if(!empty($this->data->email)){
				$userDetails = User::where('email',$this->data->email)->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('email', 'E-mail Already Exist.');
					}        
				});
			}
		}
		return $validator;
	}

	 public function addAccountStatus($action="add")
	{

		$validations = [
			'account_status'					=> $this->validation('name'),
        	
    	];

    	$validator = \Validator::make($this->data->all(), $validations,[]);
    	if($action=='add'){
			if(!empty($this->data->account_status)){
				$userDetails = AccountStatus::where('account_status',$this->data->account_status)->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('account_status', 'Name already exist.');
					}
				});
			}
		}else{
			if(!empty($this->data->account_status)){
				$Details = AccountStatus::where('account_status',$this->data->account_status)->where('id','!=',$this->data->id)->first();
				$validator->after(function ($validator) use($Details) {
					if(!empty($Details)){
						$validator->errors()->add('account_status', 'Name Already Exist.');
					}        
				});
			}

		}
		
		return $validator;
	}
	public function addSelect($action="add")
	{

		$validations = [
			'name'					=> $this->validation('name'),
        	
    	];

    	$validator = \Validator::make($this->data->all(), $validations,[]);
    	if($action=='add'){
			if(!empty($this->data->name)){
				$userDetails = SelectList::where('name',$this->data->name)->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('name', 'Name already exist.');
					}
				});
			}
		}else{
			if(!empty($this->data->name)){
				$Details = SelectList::where('name',$this->data->name)->where('id','!=',$this->data->id)->first();
				$validator->after(function ($validator) use($Details) {
					if(!empty($Details)){
						$validator->errors()->add('name', 'Name Already Exist.');
					}        
				});
			}

		}
		
		return $validator;
	}

	public function addLeadSource($action="add")
	{

		$validations = [
			'title'					=> $this->validation('name'),
        	
    	];

    	$validator = \Validator::make($this->data->all(), $validations,[]);
    	if($action=='add'){
			if(!empty($this->data->lead_source)){
				$userDetails = LeadSource::where('lead_source',$this->data->lead_source)->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('lead_source', 'Name already exist.');
					}
				});
			}
		}else{
			if(!empty($this->data->lead_source)){
				$Details = LeadSource::where('lead_source',$this->data->lead_source)->where('id','!=',$this->data->id)->first();
				$validator->after(function ($validator) use($Details) {
					if(!empty($Details)){
						$validator->errors()->add('lead_source', 'Name Already Exist.');
					}        
				});
			}

		}
		
		return $validator;
	}

	public function addEmail($action="add")
	{

		$validations = [
			'title'					=> $this->validation('name'),
			'subject'					=> $this->validation('name'),
    	];

    	$validator = \Validator::make($this->data->all(), $validations,[]);
    	if($action=='add'){
			if(!empty($this->data->title)){
				$userDetails = Email::where('title',$this->data->title)->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('title', 'Title already exist.');
					}
				});
			}
		}else{
			if(!empty($this->data->title)){
				$Details = Email::where('title',$this->data->title)->where('id','!=',$this->data->id)->first();
				$validator->after(function ($validator) use($Details) {
					if(!empty($Details)){
						$validator->errors()->add('title', 'Title Already Exist.');
					}        
				});
			}

		}
		
		return $validator;
	}

	public function sentEmail($action="add")
	{

		$validations = [
			'email_to'					=> $this->validation('id'),
			'subject'					=> $this->validation('id'),
			'message'					=> $this->validation('id'),
    	];

    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}
	public function addFilter($action="add")
	{
		$validations = [
			'view_name'					=> $this->validation('name'),
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		foreach ($this->data->column as $key => $value) {
		    if(!empty($value)){
		        $arr[]=$value;
		    }
		}
		if(!empty($arr)){
			if(has_dupes($arr)){
				$validator->after(function ($validator) use($arr) {
					   $validator->errors()->add('dups_column', 'Please select Unique Column list.'); 
				});
			}
		}
		return $validator;
	}

	public function assignAccountsClient($action="add")
	{
		$validations = [
			'assign_email'					=> $this->validation('id'),
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}

	public function importAccount($action='add'){
		$validations = [
			'file' 						=> $this->validation('import_file'),
		];
		$validator = \Validator::make($this->data->all(), $validations,[]);
		
		return $validator;
	}
	
}