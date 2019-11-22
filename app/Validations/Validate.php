<?php

namespace Validations;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
Use App\Models\User;
Use App\Models\UserDetails;
Use App\Models\Driver;
use Hash;

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
			'mobile_number' 		=> ['required','numeric','digits:10'],
			'req_mobile_number' 	=> ['required','required_with:phone_code','numeric','digits:10'],
			'country' 				=> ['required','string'],
			'address'           	=> ['nullable','string','max:1500'],
			'qualifications'    	=> ['required','string','max:1500'],
			'specifications'    	=> ['nullable','string','max:1500'],
			'description'       	=> ['required','string'],
			'slug_cat'				=> ['required','max:255'],
			'title'             	=> ['required','string'],
			'profile_picture'   	=> ['required','mimes:doc,docx,pdf','max:2048'],
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
				'doc_file_any'			=> ['nullable','mimes:jpg,jpeg,png,doc,docx,pdf','max:5120'],
			'video'  				=> ['mimes:mp4,mov,ogg,qt','max:51200'],
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


		];
		return $validation[$key];
	}
	public function login(){
			if($this->data->user_type=='driver'){
				$validations = [
				    'mobile_number' 		       => $this->validation('mobile_number'),
					'password'       	   		   => $this->validation('password'),
				];
				$validator = \Validator::make($this->data->all(), $validations,[
					'mobile_number.required' 							=>  'Mobile number is required.',
					'mobile_number.numeric' 						    =>  'The Mobile Number must be a numeric.'
				]);
			}else{
				$validations = [
				    'mobile_number' 		       => $this->validation('mobile_number'),
					'otp'       	   			   => $this->validation('name'),
				];
				$validator = \Validator::make($this->data->all(), $validations,[
					'mobile_number.required' 							=>  'Mobile number is required.',
					'mobile_number.numeric' 						    =>  'The Mobile Number must be a numeric.'
				]);
			}
			if(!empty($this->data->mobile_number)){
				if($this->data->user_type=='user'){

					$userDetails = User::where('mobile_number',$this->data->mobile_number)->where('user_type','user')->first();
				}else{
					$userDetails = User::where('mobile_number',$this->data->mobile_number)->where('user_type','driver')->first();
				}
			    $validator->after(function ($validator) use($userDetails) {
			    	if(empty($userDetails)){
			    		$validator->errors()->add('mobile_number', 'No Account Found With This Mobile Number.');
			    	}elseif($userDetails->status!='active'){
			    		$validator->errors()->add('mobile_number', 'Your account is not active.Please contact with adminstrator for more info.');
			    	}elseif($userDetails->user_type=='admin'){
			    		$validator->errors()->add('mobile_number', 'You are not authorised user to login.');
			    	}
			    	elseif(!empty($this->data->otp)){
			    		if($userDetails->otp!=$this->data->otp){
			    			$validator->errors()->add('mobile_number', 'OTP is Incorrect.');
			    		}
			    	}        
			    });
			}
		return $validator;		
	}

	public function login_otp(){
		$validations = [
        	'mobile_number' 						=> $this->validation('name')
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[
			'mobile_number.required' 						=>  'Mobie is required.',
			
		]);
    		$userDetails = User::where('mobile_number',$this->data->mobile_number)->where('user_type','user')->first();
		    $validator->after(function ($validator) use($userDetails) {
		    	if(empty($userDetails)){
		    		$validator->errors()->add('mobile_number', 'No Account Found With This Mobile Number.');
		    	}        
		    });
		return $validator;
	}
	public function forgotpass(){
		if(is_numeric($this->data->username)){
			$validations = [
	        	'username' 						=> $this->validation('mobile_number')
	    	];
	    	$validator = \Validator::make($this->data->all(), $validations,[
				'username.required' 						=>  'E-mail/Mobile Number is required.',
				'username.numeric' 						    =>  'The Mobile Number must be a valid number.'
			]);

			if(!empty($this->data->username)){
	    		$userDetails = User::where('mobile_number',$this->data->username)->where('user_type','driver')->first();
			    $validator->after(function ($validator) use($userDetails) {
			    	if(empty($userDetails)){
			    		$validator->errors()->add('username', 'No Account Found With This Email.');
			    	}        
			    });
	    	}
	    }else{
	    	$validations = [
	        	'username' 						=> $this->validation('req_email')
	    	];
	    	$validator = \Validator::make($this->data->all(), $validations,[
				'username.required' 						=>  'E-mail/Mobile Number is required.',
				'username.email' 						    =>  'The email must be a valid email address.'
			]);

			if(!empty($this->data->username)){
	    		$userDetails = User::where('email',$this->data->username)->where('user_type','driver')->first();
			    $validator->after(function ($validator) use($userDetails) {
			    	if(empty($userDetails)){
			    		$validator->errors()->add('username', 'No Account Found With This E-mail/Mobile.');
			    	}        
			    });
	    	}
	    }
		return $validator;
    }
    public function resend(){
		if(is_numeric($this->data->username)){
			$validations = [
	        	'username' 						=> $this->validation('mobile_number')
	    	];
	    	$validator = \Validator::make($this->data->all(), $validations,[
				'username.required' 						=>  'E-mail/Mobile Number is required.',
				'username.numeric' 						    =>  'The Mobile Number must be a valid number.'
			]);

			if(!empty($this->data->username)){
	    		$userDetails = User::where('mobile_number',$this->data->username)->where('user_type',$this->data->user_type)->first();
			    $validator->after(function ($validator) use($userDetails) {
			    	if(empty($userDetails)){
			    		$validator->errors()->add('username', 'No Account Found With This E-mail/Mobile Number.');
			    	}        
			    });
	    	}
	    }else{
	    	$validations = [
	        	'username' 						=> $this->validation('req_email')
	    	];
	    	$validator = \Validator::make($this->data->all(), $validations,[
				'username.required' 						=>  'E-mail/Mobile Number is required.',
				'username.email' 						    =>  'The email must be a valid email address.'
			]);

			if(!empty($this->data->username)){
	    		$userDetails = User::where('email',$this->data->username)->where('user_type',$this->data->user_type)->first();
			    $validator->after(function ($validator) use($userDetails) {
			    	if(empty($userDetails)){
			    		$validator->errors()->add('username', 'No Account Found With This E-mail/Mobile.');
			    	}        
			    });
	    	}
	    }
		return $validator;
    }
    public function signup()
	{

		if($this->data->user_type=="user"){
			$validations = [
				'first_name'					=> $this->validation('name'),
	        	//'last_name' 					=> $this->validation('name'),
	        	'phone_code' 					=> $this->validation('phone_code'),
	        	'mobile_number'					=> $this->validation('req_mobile_number'),
	        	
	    	];
			$validator = \Validator::make($this->data->all(), $validations,[]);
				if(!empty($this->data->mobile_number)){
				$userDetails = User::where('mobile_number',$this->data->mobile_number)->where('user_type','user')->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('mobile_number', 'Mobile Number Already Exist.');
					}        
				});
			}
			if(!empty($this->data->email)){
				$userDetails = User::where('email',$this->data->email)->where('user_type','user')->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('email', 'E-mail Already Exist.');
					}        
				});
			}
		}else{
			$validations = [
				'first_name'					=> $this->validation('name'),
	        	/*'last_name' 					=> $this->validation('name'),*/
	        	'phone_code' 					=> $this->validation('phone_code'),
	        	'mobile_number'					=> $this->validation('req_mobile_number'),
	        	'password'						=> $this->validation('password'),
	        	'confirm_password'				=> $this->validation('c_password'),
	    	];
	    	$validator = \Validator::make($this->data->all(), $validations,[
	    		'first_name.required' => 'Name is required'


	    	]);
				if(!empty($this->data->mobile_number)){
				$userDetails = User::where('mobile_number',$this->data->mobile_number)->where('user_type','driver')->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('mobile_number', 'Mobile Number Already Exist.');
					}        
				});
			}
			if(!empty($this->data->email)){
				$userDetails = User::where('email',$this->data->email)->where('user_type','driver')->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('email', 'E-mail Already Exist.');
					}        
				});
			}
		}

		return $validator;
	}
   	public function createPassword()
	{
		$validations = [
        	'otp' 							=> $this->validation('name'),
        	'username'						=> $this->validation('name'),
        	'password'						=> $this->validation('password'),
        	'confirm_password'				=> $this->validation('c_password'),
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		if(!empty($this->data->username)){
			if(is_numeric($this->data->username)){
				$userDetails = User::where('mobile_number',$this->data->username)->where('user_type','driver')->first();
			}else{
				$userDetails = User::where('email',$this->data->username)->where('user_type','driver')->first();
			}
		   if(!empty($userDetails)){
			    $validator->after(function ($validator) use($userDetails) {
			    		if($userDetails->otp!=$this->data->otp){
			    			$validator->errors()->add('otp', 'OTP is Incorrect.');
			    		}
			    });
		   }        
		}
		return $validator;
	}

	public function driver_details()
	{
		$validations = [
        	'driver_license' 				=> $this->validation('document_file'),
        	'license_number'				=> $this->validation('name'),
        	'valid_vehicle_type'			=> $this->validation('name'),
        	'issued_on'						=> $this->validation('name'),
        	'expiry_date'					=> $this->validation('name'),
        	'user_id'						=> $this->validation('name'),
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
			if(!empty($this->data->license_number)){
				$userDetails = Driver::where('license_number',$this->data->license_number)->where('user_id','!=',$this->data->user_id)->first();
			   if(!empty($userDetails)){
				    $validator->after(function ($validator) use($userDetails) {
				    			$validator->errors()->add('license_number', 'License Number Already exist with another driver.');
				    });
			   }        
			}
		return $validator;
	}
	public function vehical_insurance()
	{
		$validations = [
        	'vehical_insurance'				=> $this->validation('photo'),
        	'user_id'						=> $this->validation('name'),
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
			
		return $validator;
	}public function vehical_permit()
	{
		$validations = [
        	
        	'vehical_permit'				=> $this->validation('photo'),
        	'user_id'						=> $this->validation('name'),
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
			
		return $validator;
	}public function verhical_registration()
	{
		$validations = [
        	
        	'verhical_registration'			=> $this->validation('photo'),
        	'user_id'						=> $this->validation('name'),
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
			
		return $validator;
	}public function driver_license()
	{
		$validations = [
        	'driver_license' 				=> $this->validation('photo'),
        	
        	'user_id'						=> $this->validation('name'),
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
			
		return $validator;
	}


	  public function ProfileUpdate()
	{
		if($this->data->user_type=="user"){
			$validations = [
				'first_name'					=> $this->validation('name'),
	        	//'last_name' 					=> $this->validation('name'),
	        	'phone_code' 					=> $this->validation('phone_code'),
	        	'mobile_number'					=> $this->validation('req_mobile_number'),
	        	'email'							=> $this->validation('email'),
	        	'date_of_birth'					=> $this->validation('name'),
	        	'user_id'						=> $this->validation('name'),
	    	];
			$validator = \Validator::make($this->data->all(), $validations,[]);
				if(!empty($this->data->mobile_number)){
				$userDetails = User::where('mobile_number',$this->data->mobile_number)->where('id','!=',$this->data->user_id)->where('user_type','user')->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('mobile_number', 'Mobile Number Already Exist.');
					}      
				});
			}

			if(!empty($this->data->otp)){
				$userDetails = User::where('id',$this->data->user_id)->where('user_type','user')->first();
					$validator->after(function ($validator) use($userDetails) {
						if($userDetails->otp!=$this->data->otp){
							$validator->errors()->add('otp', 'OTP is incorrect.');
						}
					});
			}   
			if(!empty($this->data->email)){
				$userDetails = User::where('email',$this->data->email)->where('id','!=',$this->data->user_id)->where('user_type','user')->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('email', 'E-mail Already Exist.');
					}        
				});
			}
		}else{
			$validations = [
				'first_name'					=> $this->validation('name'),
	        	'phone_code' 					=> $this->validation('phone_code'),
	        	'mobile_number'					=> $this->validation('req_mobile_number'),
	        	'email'							=> $this->validation('email'),
	        	'user_id'						=> $this->validation('name'),

	    	];
	    	$validator = \Validator::make($this->data->all(), $validations,[]);
			if(!empty($this->data->mobile_number)){
				$userDetails = User::where('mobile_number',$this->data->mobile_number)->where('id','!=',$this->data->user_id)->where('user_type','driver')->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('mobile_number', 'Mobile Number Already Exist.');
					}        
				});
			}
			if(!empty($this->data->email)){
				$userDetails = User::where('email',$this->data->email)->where('id','!=',$this->data->user_id)->where('user_type','driver')->first();
				$validator->after(function ($validator) use($userDetails) {
					if(!empty($userDetails)){
						$validator->errors()->add('email', 'E-mail Already Exist.');
					}        
				});
			}
			if(!empty($this->data->otp)){
				$userDetails = User::where('id',$this->data->user_id)->where('user_type','driver')->first();
					$validator->after(function ($validator) use($userDetails) {
						if($userDetails->otp!=$this->data->otp){
							$validator->errors()->add('otp', 'OTP is incorrect.');
						}
					});
			}
		}
		if(!empty($this->data->user_id)){
			$userDetails = User::where('id','=',$this->data->user_id)->where('user_type',$this->data->user_type)->first();
			$validator->after(function ($validator) use($userDetails) {
				if(empty($userDetails)){
					$validator->errors()->add('user_id', 'No Account found with this user id.');
				}else{
					
				}        
			});
		}

		return $validator;
	}
	
	public function DeviceUpdate()
	{
		$validations = [
        	'user_id'							=> $this->validation('name'),
        	'device_token'						=> $this->validation('name'),
        	'device_type'						=> $this->validation('name'),
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}

	public function RequestRide()
	{
		$validations = [
        	'user_id'							=> $this->validation('name'),
        	'pickup_location'					=> $this->validation('name'),
        	'drop_location'						=> $this->validation('name'),
        	//'distance'							=> $this->validation('name'),
        	'service_type'						=> $this->validation('name'),
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}

	public function UserConfirmRide()
	{
		$validations = [
			'booking_id'						=> $this->validation('id'),
        	'user_id'							=> $this->validation('name'),
        	'pickup_location'					=> $this->validation('name'),
        	'drop_location'						=> $this->validation('name'),
        	//'distance'							=> $this->validation('name'),
        	'service_type'						=> $this->validation('name'),
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}

	public function ProfilePictureUpdate()
	{
		$validations = [
        	'user_id'							=> $this->validation('name'),
        	'profile_picture'					=> $this->validation('photo'),
        	
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}

	public function updateLocation()
	{
		$validations = [
        	'user_id'							=> $this->validation('id'),
        	'latitude'							=> $this->validation('id'),
        	'longitude'							=> $this->validation('id')

        	
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}

	public function getNearByCars()
	{
		$validations = [
        	'user_id'							=> $this->validation('id'),
        	'latitude'							=> $this->validation('id'),
        	'longitude'							=> $this->validation('id'),
        	'service_type'						=> $this->validation('id')

        	
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}

	public function acceptBooking()
	{
		$validations = [
        	'booking_id'							=> $this->validation('id'),
        	'user_id'							=> $this->validation('id'),
        	

        	
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}

	public function statusOnOff()
	{
		$validations = [
        	'user_id'							=> $this->validation('id'),
        	'online_status'							=> $this->validation('id'),
        	

        	
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}
	public function startRide()
	{
		$validations = [
        	'ride_id'							=> $this->validation('id'),
        	
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}

	public function bookingHistory()
	{
		$validations = [
        	'user_id'							=> $this->validation('id')
        	
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}

	public function userBookingHistory()
	{
		$validations = [
        	'user_id'							=> $this->validation('id')

        	
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}

	public function userBookingHistoryDetail()
	{
		$validations = [
        	'user_id'							=> $this->validation('id'),
        	'booking_id'							=> $this->validation('id')
        	
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}

	public function rateDriver()
	{
		$validations = [
			'ride_id'							=> $this->validation('id'),
        	'user_id'							=> $this->validation('id'),
        	'driver_id'							=> $this->validation('id'),
        	'rating'							=> $this->validation('id')
        	
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}

	public function driverRating()
	{
		$validations = [
        	'user_id'							=> $this->validation('id'),
        	
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}

	public function cancelRide()
	{
		$validations = [
        	'user_id'							=> $this->validation('id'),
        	'booking_id'							=> $this->validation('id')
        	
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}

	public function applyCoupon()
	{
		$validations = [
        	'user_id'							=> $this->validation('id'),
        	'booking_id'							=> $this->validation('id'),
        	'promo_id'							=> $this->validation('id')
        	
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}

	public function bookedDriverDetails()
	{
		$validations = [
        	'user_id'							=> $this->validation('id'),
        	
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}



	
}