<?php  
namespace App\Http\Helpers;
use Illuminate\Support\Facades\Auth;
use App\UserLog;
use Jenssegers\Agent\Agent;

class LogsHelper{
	public  function store($action,$details){
		$agent = new Agent();
		$data['regexp'] = $agent->match('regexp');
    	$data['languages'] = $agent->languages();

    	$data['browser'] = $agent->browser();
		$data['browser_version'] = $agent->version($data['browser']);

		$data['platform'] = $agent->platform();
		$data['platform_version'] = $agent->version($data['platform']);

		$data['device'] = $agent->device();

		// Check if the user is using a desktop device.
		if ($agent->isDesktop()) 
		{
			$data['device_type'] = "Desktop";
		}

		// Check if the user is using a phone device.
		if ($agent->isPhone()) 
		{
			if($agent->isMobile()){$data['device_type'] = "Mobile";}
			if($agent->isTablet()){$data['device_type'] = "Tablet";}

			if($agent->isAndroidOS()){$data['device_os']= "Android";}
			if($agent->isNexus()){$data['device_os']= "Nexus";}
			if($agent->isSafari()){$data['device_os']= "Safari";}
			if($agent->is('iPhone')){$data['device_os']= "iPhone";}
		}

		// get my real
    	$data['my_ip'] = $_SERVER['REMOTE_ADDR']; 

    	$other = json_encode($data,true);
	   
	
		$log = UserLog::create([
			'userid' => Auth::user()->id,
			'user_name' => Auth::user()->name,
			'action'=>$action,
			'details'=>$details,
			'others'=>$other;
		]);
	}

	

	
}