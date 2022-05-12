<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed

include_once (dirname(__FILE__) . "/Main.php");

class Auth extends Main{

	public function __construct(){
		parent::__construct();
		$this->load->helper('url','html', 'new');
		$this->load->model("system");
		$this->load->helper('file');
		$this->load->library('session');
	}

	function Aindex()
	{
		$uname = $this->security->xss_clean($this->input->post('j_username'));;
		$pass = $this->security->xss_clean($this->input->post('j_password'));;
		$link = 'https://hmis.mohz.go.tz/api/me';

		if(isset($uname) && isset($pass)){

			if($uname!="" &&  $pass!=""){
			$log = Main::check_logged_user($uname, $pass, $link);
			$key=1;
		}

		else{
			$log = $this->input->post('result');
			$key=2;


		}

		}
		else{
			$log = $this->input->post('result');
			$key=2;


		}

		if($log){
		    if ( array_key_exists('userCredentials', $log) ) {
			    // $this->save_data_to_session( $this->is_admin($log['userCredentials']['userRoles']), $log['displayName'], $log['id']);
			    $referred_from = $this->session->userdata('referred_from');

			    Main::save_session(hash('sha256', $log['id'].$this->is_admin($log['userCredentials']['userRoles']).$log['id']), $this->buildAcronym($log['displayName'], 2), $log['id']);


    			// if ($referred_from) {
    			// 	redirect($referred_from, 'refresh');
    			// }



    			if($key==1){
    				redirect(Main::index());
    			}

    			else{

    				Main::index();
    			}

	            	

		    }

		    else {


			$_SESSION["wrong_password"] = 'Wrong username or password';
		    $this->load->view('login_action');
		}

		}
		else {
			// $_SESSION["wrong_password"] = 'Wrong username or password';
		    $this->load->view('login_action');
		}
	}


	function is_admin($roles)
	{	
		$roles_array=[];
		foreach ($roles as $role) {
			$roles_array[]=$role['id'];
		}
		if(in_array('iHUyOS1nJCz',$roles_array) || in_array('yrB6vc5Ip3r',$roles_array))
			{
				return 1;
			}
		else 
			{
				return 0;
			}

	}


	function save_data_to_session($admin, $displayName, $uid)
	{
		$_SESSION["userId"] = $uid;
		$_SESSION["admin"] = $admin;
		$_SESSION['userName'] =strval($displayName);
		$_SESSION['displayName'] = $this->buildAcronym($displayName, 2);
		$_SESSION['last_login_timestamp'] = time();
	}


	function logout_Dhis2_user()
	{
		session_destroy();
		$this->load->view('login_action');
	}

	function buildAcronym($string, $length = 1) 
	{    
	    $words = explode(" ", $string);
	    $acronym = "";
	    $length = ($length <= 0 ? 1 : $length);

	    foreach ($words as $i => $w) 
	    {
	        $i += 1;
	        if($i <= $length) {
	            $acronym .= $w[0];
	        }
	    }

	    return $acronym;
	}


}

 ?>
