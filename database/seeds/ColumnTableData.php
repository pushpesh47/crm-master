<?php

use Illuminate\Database\Seeder;
class ColumnTableData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data['name']='Customer Name';
    	$data['sales_agent']='Sales Agent';
    	$data['customer_number']='Customer Number';
    	$data['first_name']='First Name';
    	$data['last_name']='Last Name';
    	$data['email']='Email';
    	$data['mobile']='Mobile';
    	$data['alternate_mobile']='Alternate Mobile';
    	$data['date_of_injury']='Date of Injury';
    	$data['account_status']='Account Status';
    	$data['lead_source']='Lead Source';
    	$data['injury_type']='Injury Type';
    	$data['potential_defendant']='Potential Defendant';
    	$data['date_of_injury_aware']='Date of Injury Aware';
    	$data['lead_quality']='Lead Quality';
    	$data['facebook_injury_date']='Facebook Injury Date';
    	$data['enquiry_type']='Enquiry Type';
    	$data['panel_refrence']='Panel Reference';
    	$data['type_of_lead']='Type Of lead';
    	$data['date_lead_recieved']='Date Lead Recieved';
    	$data['home_telephone_number']='Home Telephone Number';
    	$data['mobile_telephone_number']='Mobile Telephone Number';
    	$data['social_media_handle']='Social Media Handle';
    	$data['date_of_birth']='Date Of birth';
    	$data['address']='Address';
    	$data['call_transfer_time']='Call Transfer Time';
    	$data['call_back_time']='Call Back Time';
    	$data['call_back_date']='Call Back Date';
    	foreach ($data as $key => $value) {
	        \DB::table('columns')->insert([
	            'meta_key' => $key,
	            'meta_value' =>$value,
	            'module_type' => 'accounts',
	            'status' => 'active',
	        ]);
    	}
    }
}
