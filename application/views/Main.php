<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed

include_once (dirname(__FILE__) . "/Auth.php");
class Main extends CI_Controller {
	public function __construct()  {
		parent::__construct();

		
		$this->load->helper('url','html', 'new');
		$this->load->model("system");
		$this->load->helper('file');
		$this->load->library('session');

	}

	public function get_time_period($arrayy)
	{

		$periods='';

		foreach ($arrayy['periods'] as $key =>  $value)
		{
		$periods=$periods.$value['id'].';';
		}


		foreach ($arrayy['relativePeriods'] as $key =>  $value)
		{

		if($arrayy['relativePeriods'][$key]){
		$relative_period=$key;

		$period_arr = str_split($key);
		$j=0;

		for($i=0;$i<count($period_arr) ; $i++)	{

		if((ctype_upper($period_arr[$i]))&&(($period_arr[$i-1]!='i'))){

		$relative_period = substr_replace($relative_period, '_', $i+$j, 0);
		$j=$j+1;

		}

		if(((is_numeric($period_arr[$i]))&& (!is_numeric($period_arr[$i-1])) ) ){

		$relative_period = substr_replace($relative_period, '_', $i, 0);
		$j=$j+1;
		}

		}

		$periods=$periods.strtoupper($relative_period).';';	

		}

		}
		return  $periods;

	}

	public function get_ou($arrayy)
	{
		$orgUnit='';

		foreach ($arrayy['organisationUnits'] as $key => $value)
		{

		$orgUnit = $orgUnit.$value['id'].';';
		}

		if(array_key_exists('itemOrganisationUnitGroups',$arrayy)){
		foreach($arrayy['itemOrganisationUnitGroups'] as $value){

		$orgUnit = $orgUnit.'OU_GROUP-'.$value['id'].';';
		}
	}

		if(count($arrayy['organisationUnitLevels'])>0){

		$orgUnit = $orgUnit.'LEVEL-'.$arrayy['organisationUnitLevels'][0].';';
		}

		if(empty($orgUnit)){

			$orgUnit='UNSNiNqkzEM;';
		}

		return $orgUnit;


	}

	function destroy_session()
	{
		if (isset($_SESSION["userPass"])) {
			  // only if user is logged in perform this check
			  if ((time() - $_SESSION['last_login_timestamp']) > 900) {

			    return $this->load->view('login_action');
			  } 
			  else { 
			  	
			  	$_SESSION['last_login_timestamp'] = time();
			  	return true;
			  }
		}
	}

	public function show_tab_data()
	{
		$tab_id = $this->security->xss_clean($this->input->post('tab_id'));
		$visualization_id = $this->security->xss_clean($this->input->post('visualization_id'));
		$data = $this->system->get_all_with_asy('comments','tab_id',$tab_id,'visualization_id',$visualization_id);
		echo json_encode($data);
	
	}

	public function index()
	{

		
		if(isset($_SESSION['displayName'] )){
			$this->session->set_userdata('referred_from', current_url());
			$_SESSION["last_tab"] = "";
			$this->data['head'] = 'Home';
			$this->data['session'] = [ $_SESSION["admin"], $_SESSION['displayName'], $_SESSION["userId"]];
			$this->data['dashboard'] = $this->system->get_all('dashboards');
			$this->data['content'] = 'all_dashboards';
	    	$this->load->view('template', $this->data);	
		}

		else{

			$this->load->view('login_action');
			
		}
		
		
	
	}
	
    function save_session($admin, $displayName, $uid)
	{
		$_SESSION["userId"] = $uid;
        $_SESSION["admin"] = $admin;
		$_SESSION['displayName'] = $displayName;
		$_SESSION['userName'] =strval($displayName);
		$_SESSION['last_login_timestamp'] = time();
	}

	

	public function add_dashboard()
	{	
		
		$this->session->set_userdata('referred_from', current_url());
		$this->data['head'] = 'Add Dashboard';
		$this->data['content'] = 'new_dashboard';

    	$this->load->view('template', $this->data);
	
	}


	public function create_dash(){

		$this->session->set_userdata('referred_from', current_url());
		$name = $this->security->xss_clean($this->input->post('name'));
		$desc = $this->security->xss_clean($this->input->post('description'));
		$data =[
			'name'=>$name,
			'description'=>$desc
		];
		$save = $this->system->create_data('dashboards',$data);

		if ($save) {
			
			$this->session->set_flashdata('success', 'Dashboard added successfully');

		}else {
			
			$this->session->set_flashdata('error','Failed to add dashboard please try again');
		}
		$this->index();
		//$data = $this->security->xss_clean($data);
	}

	public function edit_dash($id){
		$this->session->set_userdata('referred_from', current_url());
		$ids = base64_decode($id);
		$name = $this->security->xss_clean($this->input->post('name'));
		$desc = $this->security->xss_clean($this->input->post('description'));
		$data =[
			'name'=>$name,
			'description'=>$desc
		];
		$this->data['head'] = $this->system->get_any_row('dashboards','id',$ids)->name;
		$save = $this->system->update_data('dashboards',$data,'id',$ids);

		if ($save) {
			$this->session->set_flashdata('success', 'Datashboard updated successfully');
		} else {

			$this->session->set_flashdata('error', 'Failed to updated dashboard please try again');
		}

		$this->view_dash($id);
	}

	public function delete_dash($id){
		$this->session->set_userdata('referred_from', current_url());
		$ids = base64_decode($id);
		$dashboard = $this->system->get_any_row('dashboards','id',$ids);
		if($this->security->xss_clean($this->input->post('name'))== $dashboard->name){
			$this->system->delete_data('dashboards','id',$ids);
			$this->system->delete_data('dashboard_tabs','dash_id',$ids);
		}else{
		}
		redirect('home');
	}

	public function dash_home($id){
		$this->session->set_userdata('referred_from', current_url());
		$ids = base64_decode($id);
		$last_tab=$this->system->get_any_row_asc('dashboard_tabs','dash_id',$ids);
		$_SESSION["last_tab"]=$last_tab->id;
		
		$this->data['dashboard'] = $this->system->get_any_row('dashboards','id',$ids);
		$this->data['head'] = $this->system->get_any_row('dashboards','id',$ids)->name;
		$this->data['dash_id'] = $ids;
		$this->data['tabs'] = $this->system->get_all_with('dashboard_tabs','dash_id',$this->system->get_any_row('dashboards','id',$ids)->id);
		$this->data['content'] = 'dashboard';
    	$this->load->view('template', $this->data);
	}

	public function open_dash(){
	    

		$this->session->set_userdata('referred_from', current_url());
		$ids = base64_decode($this->uri->segment(3));
		$this->save_session($this->uri->segment(4),$this->uri->segment(5),$this->uri->segment(6));
		$this->data['dashboards'] = $this->system->get_all('dashboards');
		$this->data['dashboard'] = $this->system->get_any_row('dashboards','id',$ids);
		$this->data['head'] = $this->system->get_any_row('dashboards','id',$ids)->name;
		$this->data['dash_id'] = $ids;
		$last_tab=$this->system->get_any_row_asc('dashboard_tabs','dash_id',$ids);
		if($_SESSION["dash_id"]!=$ids){
		$_SESSION["last_tab"]=$last_tab->id;
		}
		$_SESSION["dash_id"]=$ids;
		$this->data['tabs'] = $this->system->get_all_with('dashboard_tabs','dash_id',$this->system->get_any_row('dashboards','id',$ids)->id);
		$this->data['content'] = 'dashboard';
    	$this->load->view('template', $this->data);
    	
	}


		public function view_dash(){
	    
		// var_dump($_SESSION["userId"]);
		// return false;

		$this->session->set_userdata('referred_from', current_url());
		$ids = base64_decode($this->uri->segment(3));

		// var_dump("segnment 1 ",$this->uri->segment(4));
		// var_dump("segnment 2 ",$this->uri->segment(5));
		// var_dump("segnment 3 ",$this->uri->segment(6));
		// $this->save_session($this->uri->segment(4),$this->uri->segment(5),$this->uri->segment(6));
		$this->data['dashboards'] = $this->system->get_all('dashboards');
		$this->data['dashboard'] = $this->system->get_any_row('dashboards','id',$ids);
		$this->data['head'] = $this->system->get_any_row('dashboards','id',$ids)->name;
		$this->data['dash_id'] = $ids;
		$last_tab=$this->system->get_any_row_asc('dashboard_tabs','dash_id',$ids);
		if($_SESSION["dash_id"]!=$ids){
		$_SESSION["last_tab"]=$last_tab->id;
		}
		$_SESSION["dash_id"]=$ids;
		$this->data['tabs'] = $this->system->get_all_with('dashboard_tabs','dash_id',$this->system->get_any_row('dashboards','id',$ids)->id);
		$this->data['content'] = 'dashboard';
    	$this->load->view('template', $this->data);
    	
	}





	public function new_report(){
		$this->session->set_userdata('referred_from', current_url());
		$this->data['dashboards'] = $this->system->get_all('dashboards');
		$this->data['content'] = 'report';
    	$this->load->view('report', $this->data);
	}

	function view_edit_dash($id){
		$this->session->set_userdata('referred_from', current_url());
		$ids = base64_decode($id);	
		$this->data['dashboard'] = $this->system->get_any_row('dashboards','id',$ids);
		$this->data['head'] = $this->system->get_any_row('dashboards','id',$ids)->name;
		$this->data['dash_id'] = $ids;
		$this->data['tabs'] = $this->system->get_all_with('dashboard_tabs', 'dash_id', $ids);
		$this->data['content'] = 'edit_dashboard';
    	$this->load->view('template', $this->data);	
	}



	public function create_tab($id){
		$this->session->set_userdata('referred_from', current_url());
		$ids = base64_decode($id);

		$this->data['dash_id'] = $ids;
		$this->data['head'] = 'Add Tab';
		$this->data['content'] = 'create_tab';
    	$this->load->view('template', $this->data);
	}


	public function edit_tab($id){
		if($this->check_admin()){
		$this->session->set_userdata('referred_from', current_url());
		$ids = base64_decode($id);
		$this->data['dashboards'] = $this->system->get_all('dashboards');
		$this->data['dashboard'] = $this->system->get_any_row('dashboards','id',$ids);
		$this->data['head'] = $this->system->get_any_row('dashboards','id',$ids)->name;
		$this->data['dash_id'] = $ids;
		$this->data['tabs'] = $this->system->get_all_with('dashboard_tabs','dash_id',$this->system->get_any_row('dashboards','id',$ids)->id);
		$this->data['content'] = 'edit_tab';
    	$this->load->view('template', $this->data);
	
	}
}

	public function delete_tab($id)
	{
		if($this->check_admin()){
		$dash_id= $this->system->get_any_row('dashboard_tabs','id',$id)->dash_id;;
		$delete_tab = $this->system->delete_data('dashboard_tabs','id',$id);

		if ($delete_tab) {
			echo json_encode($id);	
		}
		}
	}


	public function delete_tabs($id)
	{
		$this->session->set_userdata('referred_from', current_url());
		$id = base64_decode($id);
		
		$dash_id= $this->system->get_any_row('dashboard_tabs','id',$id)->dash_id;;
		$delete_tab = $this->system->delete_data('dashboard_tabs','id',$id);

		if ($delete_tab) {

			$this->view_dash(base64_encode($dash_id));
		}	
		
	}

	public function add_tab(){
		$name = $this->security->xss_clean($this->input->post('name'));
		$dash_id = $this->security->xss_clean($this->input->post('dash_id'));
		$data =[
			'name'=>$name,
			'dash_id'=>$dash_id
		];
		$save = $this->system->create_data('dashboard_tabs',$data);
		if ($save) {

			$this->session->set_flashdata('success', 'Datashboard Tab added successfully');
		} else {

			$this->session->set_flashdata('error', 'Failed to add dashboard tab please try again');
		}

		$this->view_dash(base64_encode($dash_id));
	}


	public function create_new_tab(){
		$name = $this->security->xss_clean($this->input->post('name'));
		$dash_id = $this->security->xss_clean($this->input->post('id'));
		$data =[
			'name'=>$name,
			'dash_id'=>$dash_id
		];
		$save = $this->system->create_data_returns_id('dashboard_tabs',$data);
		$_SESSION["last_tab"] = $save ;
		
			$this->view_dash(base64_encode($dash_id));
	}

	public function visualizer($id){
		if($this->check_admin()){
		$ids = base64_decode($id);
		$tab = $this->system->get_any_row('dashboard_tabs','id',$ids);
		$this->data['tab']=$tab;
		$this->data['apps'] = $this->system->get_all_with('applications','tab_id',$ids);
		$app = $this->system->get_all_with('applications', 'id', $ids);
		$this->data['app']=$app;
		$this->data['head'] = 'Add new visualizer in '.$tab->name;
		$this->data['content'] = 'new_visualizer';
    	$this->load->view('template', $this->data);
    }
	}


	public function import_visualizer($id){

		// var_dump("THE USER ID",$_SESSION['userId']);
		if($this->check_admin()){
		$ids = base64_decode($id);
		$tab = $this->system->get_any_row('dashboard_tabs','id',$ids);
		$this->data['tab']=$tab;
		$this->data['apps'] = $this->system->get_all_with('applications','tab_id',$ids);
		$app = $this->system->get_all_with('applications', 'id', $ids);
		$this->data['app']=$app;
		$this->data['head'] = 'Import visualizer in '.$tab->name;
		$this->data['content'] = 'import_visualizer';
    	$this->load->view('template', $this->data);
    }
	}

	public function add_vis(){
		$name = $this->security->xss_clean($this->input->post('title'));
		$desc = $this->security->xss_clean($this->input->post('subtitle'));
		$dashid = $this->security->xss_clean($this->input->post('dash_id'));
		$tabid = $this->security->xss_clean($this->input->post('tab_id'));
		$elementid = $this->security->xss_clean($this->input->post('elementid'));
		$type = $this->security->xss_clean($this->input->post('type'));

		$res = "";
		$periods = "";
		$orgUnit = "";
		

		if($type=="Maps"){

		$response = $this->get_visualizations_response_map($elementid);

		$arrayy = (json_decode($response, true))['mapViews'][0];

		$arrayy['type'] ="MAP";

		$tmp[]=$arrayy['rows'][0]['id'];
		$arrayy['rowDimensions'] =$tmp;

		}

		else{

			$response = $this->get_visualizations_response($elementid);

			$arrayy = (json_decode($response, true));
		}




		foreach ($arrayy['dataDimensionItems'] as $key =>  $value)
		{

		if(array_key_exists('indicator',$value)){
		$res=$res.$value['indicator']['id'].';';
		}

		if(array_key_exists('programIndicator',$value)){
			$res=$res.$value['programIndicator']['id'].';';
		}

		if(array_key_exists('dataElementOperand',$value)){
			$res=$res.$value['dataElementOperand']['id'].';';
			
		}

		if(array_key_exists('dataElement',$value)){
			$res=$res.$value['dataElement']['id'].';';
			
		}

		if(array_key_exists('reportingRate',$value)){
			$res=$res.$value['reportingRate']['id'].'.'.$value['reportingRate']['metric'].';';
			
		}

		}

		$orgUnit = $this->get_ou($arrayy);

		$periods= $this->get_time_period($arrayy);
		
		$visIndi1 = [];

	if(array_key_exists('legendSet',$arrayy)){
			
		
		if(count($arrayy['legendSet'])>0){
			$visIndi1['legendSet']=true;
			$legendSets=json_decode($this->getLegendSet($arrayy['legendSet']['id']),true);
			$arrayy['legendData']=$legendSets;

         	
			$i=0;
			foreach($visIndi1['rows'] as $row){

				foreach($legendSets['legends'] as $legend){

					if($legend['endValue']>= intval(($row[3])) && $legend['startValue'] <= intval($row[3])){

						$visIndi1['rows'][$i][]=$legend['color'];

					}
				}
				$i=$i+1;
			}

		}
		}

		$filter_data['periods']=$periods;
		$filter_data['org_unit']=$orgUnit;
		$filter_data['indicators']=$res;

		$chart_type_created=3;
							
		if($arrayy['type'] == 'SINGLE_VALUE'){ 

			$chart_type_created=4;
		}


		$data =[
			'title'=>$name,
			'subtitle'=>$arrayy['displayName'],
			'dash_id'=>$dashid,
			'element_id'=>$res,
			'response'=>json_encode($arrayy),
			'chart_type'=>$chart_type_created,
			'tab_id'=>$tabid,
			'dimensions'=>json_encode($filter_data)
		];

		$save = $this->system->create_data_returns_id('visualizers',$data);

		$responseData = [
			'response' =>json_encode($visIndi1),
			'element_name' => $arrayy['displayName'],
			'element_id' => $res,
			'vis_id' => $save
		];

		$save_responseData = $this->system->create_data('response', $responseData);

	}

	public function edit_vis($id){
		$this->session->set_userdata('referred_from', current_url());
		if($this->check_admin()){
		$res_conf = $this->system->get_all_with('response','vis_id',$id);
		$vis = $this->system->get_any_row('visualizers','id',$id);
		$this->data['response']=$res_conf;
		$this->data['vis']=$vis;
		$this->data['head'] ="Add Indicators to visualizer ".$vis->title;
		$visual_response=json_decode($vis->response,true);
		$this->data['chart_type']=$visual_response['type'];
		$this->data['content'] = 'visualizer';

		$dimensions = json_decode($vis->dimensions);
		$indicatorsarray=NULL;
		$org_unitsarray = NULL;
		$org_unit_level=[];
		$org_unit_array=[];
		$org_unit_group=[];

		if (isset($dimensions->indicators)) {
			$dx = $dimensions->indicators;

		}
		if (isset( $dimensions->org_unit)) {
			$ou = explode(';',$dimensions->org_unit);
			
			foreach($ou as $ous){			
				if(strlen($ous)>0 ){
				if(strpos($ous,'LEVEL')===false && strpos($ous,'GROUP')===false){
				$org_unit_array[]=$ous;
			}	
	
			else if(strpos($ous,'GROUP')===false){	
				$org_unit_level[] = str_replace('LEVEL-', '', $ous);
			}

			else{
				$org_unit_group[] = str_replace('OU_GROUP-', '', $ous);
			}

			}
			}
		}

			$ouu=implode(';',$org_unit_array) ;

			$link = 'https://hmis.mohz.go.tz/api/analytics.json?dimension=dx:'.$dx.'&dimension=ou:'.$ouu.'&dimension=pe:LAST_YEAR';
			$response = $this->get_anything_From_api($link);

		if(is_array($response)&& array_key_exists('metaData',$response)){
			$response=$response['metaData'];
			$indicatorsarray = $response['dimensions']['dx'];
			
			$org_unitsarray	= $response['dimensions']['ou'];
		}
		
		$indicatorNames=[];
		$selected_org_unit = [];

		if (isset($indicatorsarray)) {
			foreach($indicatorsarray as $arrayy){
				$indicatorNames[$arrayy]=$response['items'][$arrayy]['name'];
			}
		}
		if (isset($org_unitsarray)){
			foreach($org_unitsarray as $arrayy){
				$selected_org_unit[$arrayy]=$response['items'][$arrayy]['name'];
			}
		}

		if($vis->chart_type<2){
			$this->data['indicatorNames'] = $indicatorNames;
			$this->data['layoutColumn'] = $dimensions->column;
			$this->data['layoutFilter'] = $dimensions->filter;
			$this->data['layoutRows'] = $dimensions->rows;
			$this->data['selected_org_unit'] = $selected_org_unit;
			$this->data['selected_org_level'] = $org_unit_level;
			$this->data['selected_org_group'] = $org_unit_group;
			$this->data['dx'] = $indicatorsarray;
			// $this->data['periods'] = explode(";",$dimensions->periods);
			$this->data['periods'] = json_encode(explode(";",$dimensions->periods));
		}
			
    	$this->load->view('template', $this->data);

	}
}

	public function update_mcn_vis($id){

		$ids = base64_decode($id);
		$name = $this->security->xss_clean($this->input->post('title'));
		$chart_default = $this->security->xss_clean($this->input->post('chart_default'));

		if($chart_default=='SINGLE_VALUE'){
			$chart_type=4;

		}
		else{

			$chart_type=3;
		}

		$vis = $this->system->get_any_row('visualizers','id',$ids);
		$visual_response=json_decode($vis->response,true);
		$visual_response['type']=$chart_default;

		$data =[
			'title'=>$name,
			'response'=>json_encode($visual_response),
			'chart_type'=>$chart_type,
		];
		$save = $this->system->update_data('visualizers',$data,'id',$ids);

		$this->view_dash(base64_encode($vis->dash_id));

		// var_dump(json_encode($visual_response));
	}
	



	public function update_msdqi_vis($id){

		$ids = base64_decode($id);
		$name = $this->security->xss_clean($this->input->post('title'));
		$chart_type = $this->security->xss_clean($this->input->post('chart_type'));
		$chart_default = $this->security->xss_clean($this->input->post('chart_default'));

		$vis = $this->system->get_any_row('visualizers','id',$ids);
		$visual_response=json_decode($vis->response,true);
		$visual_response['type']=$chart_default;
	   
	    $selected_clinics = $this->security->xss_clean($this->input->post('selected_clinics'));
		$selected_regions = $this->security->xss_clean($this->input->post('selected_regions'));
		$selected_districs = $this->security->xss_clean($this->input->post('selected_districs'));
		$orggroups = $this->security->xss_clean($this->input->post('orggroups'));
		$orglevels = $this->security->xss_clean($this->input->post('orglevels'));
		$selected_period = $this->security->xss_clean($this->input->post('selected_period'));
		$groupid = $this->security->xss_clean($this->input->post('groupid'));
		$elementid = $this->security->xss_clean($this->input->post('elementid'));
		$relative_period = $this->security->xss_clean($this->input->post('relative_period'));
		$fixed_period = $this->security->xss_clean($this->input->post('fixed_period'));
		$filter_data=[];

		$orggroups = $this->security->xss_clean($this->input->post('orggroups'));
		$orglevels = $this->security->xss_clean($this->input->post('orglevels'));

		$column = $this->security->xss_clean($this->input->post('column'));
		$filter = $this->security->xss_clean($this->input->post('filter'));
		$data = $this->security->xss_clean($this->input->post('data'));

		// var_dump("Column here ",$column);

		$orgUnit = $this->get_filtered_organization_unit($selected_clinics, $selected_districs, $selected_regions, $orggroups, $orglevels);

		$period = $this->get_trimmed_period($relative_period, $fixed_period);
		$res = $this->concatinate_string($elementid);
		
		$dimensions = json_decode($vis->dimensions);


		// var_dump('ous',$orgUnit);
		// var_dump('pe"s',$period);
		// var_dump('Indicators',$res);
		// var_dump('Dimensions',$dimensions);
		// // var_dump();
		// // var_dump();
		// // var_dump();
		// // var_dump();
		// // var_dump();

		// return false;

		if (isset($period)) {
			$filter_data['periods']= $period;
		}
		if ($period =='LAST_WEEK') {
			$filter_data['periods']= $dimensions->periods;
		}
		if (isset($orgUnit)) {
			$filter_data['org_unit']= $orgUnit;
		}
		if ($orgUnit =='UNSNiNqkzEM') {
			$filter_data['org_unit']= $dimensions->org_unit;
		}
		if (isset($res)) {
			$filter_data['indicators']=$res;
		}
		
		$filter_data['column'] = json_encode($column) ;
		$filter_data['filter'] = json_encode($filter);
		$filter_data['rows'] = json_encode($data);

		// var_dump("Saved response",json_encode($filter_data));

		$data =[
			'title'=>$name,
			'chart_type'=>$chart_type,
			'response'=>json_encode($visual_response),
			 'dimensions'=>json_encode($filter_data),
		];
		$save = $this->system->update_data('visualizers',$data,'id',$ids);

		$this->view_dash(base64_encode($vis->dash_id));
	}
	

	public function delete_comment($id){
		$delete_comment= $this->system->delete_data('comments','id',$id);	
	}

	
	public function delete_vis($id){
		if($this->check_admin()){
		$ids = base64_decode($id);
		$vis = $this->system->get_any_row('visualizers','id',$ids);
		$dash = $this->system->get_any_row('dashboards','id',$vis->dash_id);
		$dvis= $this->system->delete_data('visualizers','id',$ids);
		$dconf = $this->system->delete_data('response','vis_id',$ids);

		return $vis->dash_id;
	}
	}

	public function add_indicator(){
	
		$element_name = $this->security->xss_clean($this->input->post('element_name'));
		$element_id = $this->security->xss_clean($this->input->post('element_id'));
		$vis_id = $this->security->xss_clean($this->input->post('vis_id'));
		$ids = $vis_id;
		$regions = $this->security->xss_clean($this->input->post('regions'));
		$districts = $this->security->xss_clean($this->input->post('districts'));
		$clinics = $this->security->xss_clean($this->input->post('clinics'));
		$endday = $this->security->xss_clean($this->input->post('endday'));
		$startday = $this->security->xss_clean($this->input->post('startday'));
		$newStartDay = date("Y-m-d", strtotime($startday));
		$newEndDay = date("Y-m-d", strtotime($endday));
		$get_dimensions=[];

		$api_data = [
			'response' => $this->get_filtered_api($newStartDay, $newEndDay, $regions, $districts, $clinics, $element_id), 
			'element_name' => $element_name,
			'element_id' => $element_id,
			'vis_id' => $vis_id
		];


		$get_dimensions_data = $this->system->get_any_column('dimensions', 'visualizers', 'id', $vis_id);


		if(strlen($get_dimensions_data->dimensions) > 0){

					$get_dimensions[]=json_decode($get_dimensions_data->dimensions,true);
		}


		$dimension[$element_id]['periods']= str_replace('&startDate='.$newStartDay.'&endDate='.$newEndDay.';', ';;', ';');

		$dimension[$element_id]['org_unit']=str_replace($regions.';'.$districts.';'.$clinics.';' , ';;', ';');

		// $dimension[$element_id]['indicator']=$element_id;

		// $get_dimensions[]=$dimension;


		array_push($get_dimensions, $dimension);

		$data =[
			'dimensions'=>json_encode($get_dimensions),
		];

		// var_dump($get_dimensions);


		$save_api_data = $this->system->create_data_returns_id('response',$api_data);



		echo json_encode($save_api_data);
	}


	public function delete_indicator($id){
		$res_del = $this->system->delete_data('response','id',$id);
		return $res_del;
		
	}


	public function create_y_data_by_dimension($api_data,$x_data_id,$visual_response){

		$indicator_id_array=[];
		$indicatorId='';
		$indicatorName='';
		$y_data = [];
		$y_data_x = [];
		$tmp_indicator='';
		$column='';
		$row_dimensions[]=0;
		$dimension_index='';
		$column_index='';
		$indicator_array=[];
		$row_dimensions[]='dx';
		$row_set=true;
		$maximum=0;
		$range_axis;
		$y_data_x=[];
		$y_total=[];

		$dimension=['dx','ou','pe'];

		$data_sorting_enabled=array();

		if(array_key_exists('rangeAxisLabel',$visual_response))
			{

		if($visual_response['sortOrder'] ){

			$data_sorting_enabled['enabled']=true;
			$range_axis=$visual_response['rangeAxisLabel'];
		}
	}

		else{

			$range_axis='';
		}

		if($visual_response['sortOrder'] && $range_axis != 'Proportion' ){

			$data_sorting_enabled['enabled']=true;
		}

		else{

			$data_sorting_enabled['enabled']=false;
		}

		

		$colors=['#a9be3b','#558cc0','#d34957','#ff9f3a','#968f8f','#b7409f','#a9be3b','#558cc0','#d34957','#ff9f3a','#968f8f','#b7409f','#a9be3b','#558cc0','#d34957','#ff9f3a','#968f8f','#b7409f','#a9be3b','#558cc0','#d34957','#ff9f3a','#968f8f','#b7409f','#d34957','#ff9f3a','#968f8f','#b7409f','#a9be3b','#558cc0','#d34957','#ff9f3a','#968f8f','#b7409f','#d34957','#ff9f3a','#968f8f','#b7409f','#a9be3b','#558cc0','#d34957','#ff9f3a','#968f8f','#b7409f'];

		if(array_key_exists('rowDimensions',$visual_response)){

			$row_dimensions=[];
			$row_dimensions=$visual_response['rowDimensions'];
			if(count($row_dimensions)<1){

			$row_dimensions[]='dx';
			$row_set=false;


			}


		}

		if(array_key_exists('columnDimensions',$visual_response)){

			$column=$visual_response['columnDimensions'];

		}



			if(array_key_exists('filterDimensions',$visual_response))
			{
			
				if(count($visual_response['filterDimensions'])>0 && !$row_set){

			$row_dimensions=[];
			$row_dimensions=$visual_response['filterDimensions'];


			}	
		}

			


		if($row_dimensions[0] == 'ou'){

			$dimension_index=1;
		}

		else if($row_dimensions[0] == 'pe'){

			$dimension_index=2;
		}

		else {

			$dimension_index=0;

		}




		if($column[0] == 'ou'){

				$column_index=1;
			}

		else if($column[0] == 'dx'){

				$column_index=0;
			}

		else {

				$column_index=2;

			}



		if((count($column) > 0 ) && (count($column) > 1)){
					
		if($column[1] == 'ou'){

			$column_index=1;
		}

		else if($column[1] == 'dx'){

				$column_index=0;
			}

		else {

				$column_index=2;

			}

		}



		if (array_key_exists('rows', $api_data)) {
		$rows=$api_data['rows'];

		$serialized = array_map('serialize',$rows);
		$unique = array_unique($serialized);
		$rows=array_intersect_key($rows, $unique);



		if($indicator_id_array=$api_data['metaData']['dimensions'][$dimension[$column_index]] ?? null){

			$i=0;
		}

		else{

		$i=0;
		foreach($rows as $data){

		$indicator_id_array[]=$rows[$i][$column_index];

		$i=$i+1;

		      }

		  }

		 $i=0;

		 foreach($x_data_id as $x_data){

			$y_total[]=null;
		}

			
		foreach(array_unique($indicator_id_array) as $indicator_id){

		$indicatorName=$api_data['metaData']['items'][$indicator_id]['name'];

		 $y_total_index=0;
		foreach($rows as $row){

		if($row[$column_index] == $indicator_id){  //if column match current iterating column

		// $y_data_x[$row[$dimension_index]]=round($row[3],0, PHP_ROUND_HALF_EVEN);    //label with x axis categories

		$y_data_x[$row[$dimension_index]]=(float)$row[3];    //label with x axis categories


		}

		if((int)$row[3] > $maximum){

			$maximum=(int)$row[3] ;
		}

		}

		
      
		foreach($x_data_id as $x_data){

		if (array_key_exists($x_data, $y_data_x)) {

		$data = array();
		$data['name']=$api_data['metaData']['items'][$x_data]['name'];
		$data['y']=$y_data_x[$x_data]; 	

		$y_total[$y_total_index]=$y_total[$y_total_index]+$y_data_x[$x_data];
 
		$y_data[]=$y_data_x[$x_data];    //Read ech value for each category

		}
		else{

		$data = array();
		$data['name']=$api_data['metaData']['items'][$x_data]['name'];
		$data['y']=null; 

 
		$y_data[]=0;    //Read ech value for each category

		}
		$y_total_index=$y_total_index+1;

		}
		
		$data_indi = array();	



		$data_indi['color']=$colors[$i];
		$data_indi['data'] = $y_data;
		$data_indi['y'] = array_sum($y_data);
		$data_indi['name'] = $indicatorName;


		$y_data = [];

		$indicator_array[]=$data_indi;    //save the value

		$i=$i+1;
		}		

		}

		$response['indicator_array']=$indicator_array;
		$response['maximum']=$maximum;
		$response['stack_total']=$y_total;
		$response['sort']=$data_sorting_enabled['enabled'];

		$maximum=($maximum-1)/5;

		$maximum_array[]=1;
		$maximum_array[]=round($maximum+1,1);
		$maximum_array[]=round($maximum*2,1)+1;		
		$maximum_array[]=round($maximum*3,1)+1;	
		$maximum_array[]=round($maximum*4,1)+1;	
		$maximum_array[]=round($maximum*5,1)+1;	
		$response['maximum_array']=$maximum_array;

	return $response;

}


	public function load_vis_data(){
	
		$response=array();
		$vis_id = $this->security->xss_clean($this->input->post('vis_id'));
		$tmp_indicator='';
		$all_data =[];
		$y_data_array=[];
		$x_data=[];
		$row_dimensions=0;
		$ou=[];
		$pe=[];
		$x_data_id=[];
		$period_array;
		$visualizers = $this->system->get_all_with('visualizers','id',$vis_id);
		$response['visualizers'] = $visualizers;

		foreach($visualizers as $visual){

			$visual_response=json_decode($visual->response,true);

			$res_conf = $this->system->get_all_with('response', 'vis_id', $visual->id);
			$response['items'][$visual->id]['title'] =$visual->title;

			$response['items'][$visual->id]['level']='';

			if(array_key_exists('organisationUnitLevels',$visual_response)){

				if(count($visual_response['organisationUnitLevels'])>0){

					$response['items'][$visual->id]['level']  = $visual_response['organisationUnitLevels'][0];
				}
			}


			$dimensions = json_decode($visual->dimensions,true);
			
			$orgUnit = $dimensions['org_unit'];
			$ress = $dimensions['indicators'];
			$periods = $dimensions['periods'];

			$og_units=[];

			if(isset($dimensions['selected_regionsNames']) ){
				$og_units=array_merge($og_units,$selected_regionsNames );

			}

			if(isset($dimensions['selected_districsNames']) ){
				$og_units=array_merge($selected_districsNames, $og_units);
			}

			if(isset($dimensions['selected_clinicsNames']) ){
				$og_units=array_merge( $selected_clinics, $og_units);
			}

			if(empty($og_units) ){
				$og_units[]='Zanzibar';
			}

			$period_array=explode(";",$periods);


			foreach ($res_conf as $res) {

				$res=$res;
			}
				
			$indicator_id_array=[];

			if(strlen($visual->style)<1){

			$widget['col']='';
	    	$widget['row']='';
	    	$widget['size_y']=6;
	    	$widget['size_x']=4;
    		$visual_style['style']=$widget;
			$visual->style=json_encode($visual_style['style']);
			}
			if($visual_response['type']=='YEAR_OVER_YEAR_LINE' || $visual_response['type']=='YEAR_OVER_YEAR_COLUMN'){
				$response=$this->get_yearly_series_data($response,$visual,$orgUnit,$ress);
			}

			elseif($visual->chart_type>2){
				$api_data = $this->get_visualization_data($periods, $ress, $orgUnit);

				$api_data  = json_decode($api_data, true );

				$response=$this->get_mcn_data($response,$visual_response,$api_data,$visual,$res);

				if(array_key_exists('rows',$api_data)){

					$response['rows_count']=count($api_data ['rows']);			
				}
				else{
					$response['rows_count']='';		
				}	
				}


		else {
			$api_data = $this->get_visualization_data_hierarchy($periods, $ress, $orgUnit);
			
			$api_data  = json_decode($api_data, true );

			$response=$this->get_msdqi_data($api_data,$response,$visual,$period_array,$og_units,$orgUnit);

		if(array_key_exists('rows',$api_data)){
			$response['rows_count']=count($api_data ['rows']);			
		}
		else{
			$response['rows_count']='';		
		}	

		}

	}
	 	
		echo json_encode($response);
	}


	function get_mcn_data($response,$visual_response,$api_data,$visual,$res){

	$x_data=[];
	$x_data_id=[];
			if(array_key_exists('legendSet',$visual_response)){
			
		
		if(count($visual_response['legendSet'])>0){
			$api_data['legendSet']=true;
			$legendSets=$visual_response['legendData'];
         	

			$i=0;
			foreach($api_data['rows'] as $row){

				foreach($legendSets['legends'] as $legend){

					if($legend['endValue']>= floatval(($row[3])) && $legend['startValue'] <= floatval($row[3])){

						$api_data['rows'][$i][]=$legend['color'];

					}
				}
				$i=$i+1;
			}

		}

		}

		if(array_key_exists('rows',$api_data) && count($api_data['metaData']['dimensions']['dx'])<2){

		$response['indicator_data'][$visual->id] = $api_data['rows'];

		}
		else{

			$response['indicator_data'][$visual->id]=[];
		}

			if(array_key_exists('rowDimensions',$visual_response)){


			$row_dimensions=$visual_response['rowDimensions'];
		
			if((count($row_dimensions) > 0 ) && (count($row_dimensions) < 2)){

				if (array_key_exists('metaData', $api_data)) {

			$x_data_id=$api_data['metaData']['dimensions'][$row_dimensions[0]];

			
			foreach($api_data['metaData']['dimensions'][$row_dimensions[0]] as $data){

			$x_data[]=$api_data['metaData']['items'][$data]['name'];

			}
			}
			}

			else if(count($row_dimensions)>0 && count($row_dimensions)>1){

			
			foreach($api_data['metaData']['dimensions'][$row_dimensions[0]] as $data){

			$array1[]=$api_data['metaData']['items'][$data]['name'];
			
			}

			if (array_key_exists('metaData', $api_data)) {

			$x_data_id=$api_data['metaData']['dimensions'][$row_dimensions[1]];

			foreach($api_data['metaData']['dimensions'][$row_dimensions[1]] as $data){

			$data_indi = array();
			$data_indi['name'] = $api_data['metaData']['items'][$data]['name'];
			$data_indi['categories'] = $array1;

			$x_data[]=$data_indi ;

			}

			}
			
		}

			else if(array_key_exists('filterDimensions',$visual_response))
			{	if (array_key_exists('metaData', $api_data)) {
			
				if(count($visual_response['filterDimensions'])>0){

			$x_data_id=$api_data['metaData']['dimensions']['ou'];

			foreach($api_data['metaData']['dimensions']['ou'] as $data){

			$x_data[]=$api_data['metaData']['items'][$data]['name'];

			}

			}	
			}


			}


				else if(array_key_exists('yearlySeries',$visual_response))
			{



			$x_data_id=$api_data['metaData']['dimensions']['pe'];

			foreach($api_data['metaData']['dimensions']['pe'] as $data){

			$x_data[]=$api_data['metaData']['items'][$data]['name'];


			}	


			}


		 $response['items'][$visual->id]['legendSet']= false;
		}
		if(array_key_exists('legendSet',$api_data)){
            			 $response['items'][$visual->id]['legendSet']= $api_data['legendSet'];
            		}

          if(array_key_exists('showData',$visual_response))
			{

				$response['items'][$visual->id]['data_labels']= $visual_response['showData'];
			}	
		else{

			$response['items'][$visual->id]['data_labels']= false;
		}


		$response['items'][$visual->id]['filter']= $this->get_filters($api_data,$visual_response);
		$response['items'][$visual->id]['x_data'] =$x_data;
		$response['items'][$visual->id]['headers'] =$this->get_table_headers($api_data,$visual_response);	
		$response['items'][$visual->id]['table_data'] =$this->get_table_data($api_data,$visual_response);

		$data_by_dimension=	$this->create_y_data_by_dimension($api_data,$x_data_id,$visual_response);


		$response['items'][$visual->id]['y_data'] = $data_by_dimension['indicator_array'];
		$response['items'][$visual->id]['sort'] = $data_by_dimension['sort'];
		$response['items'][$visual->id]['y_stack_total'] = $data_by_dimension['stack_total'];
		$response['items'][$visual->id]['maximum_value']= $data_by_dimension['maximum'];
		$response['items'][$visual->id]['map_legend']= $data_by_dimension['maximum_array'];


		$chart_details=$this->chart_display_options($visual_response['type']);

		$response['items'][$visual->id]['chart_type']= $chart_details['type'];
		$response['items'][$visual->id]['chart_options']= $chart_details['option'];
		$response['items'][$visual->id]['axis_label']= '';
		$response['items'][$visual->id]['maximum']= '';

		  if(array_key_exists('rangeAxisMaxValue',$visual_response)){
            			$response['items'][$visual->id]['maximum']= $visual_response['rangeAxisMaxValue'];
            		}

		  if(array_key_exists('rangeAxisLabel',$visual_response)){
            			$response['items'][$visual->id]['axis_label']= $visual_response['rangeAxisLabel'];
            		}

		return $response;

	}


	function get_yearly_series_data($response,$visual,$orgUnit,$indicators){

		$visual_response=json_decode($visual->response,true);

		$filter='';

		$relative_periods= $this->get_time_period($visual_response);


		$yearly_series=$this->concatinate_string($visual_response['yearlySeries']);

		$link='https://hmis.mohz.go.tz/api/32/analytics.json?dimension=pe:'.$yearly_series.'&dimension=dx:'.$indicators.'&skipData=true&skipMeta=false&includeMetadataDetails=false';


		$vis_details=$this->get_anything_From_api($link);

		$years=$vis_details['metaData']['dimensions']['pe'];

		$indicator_id=$vis_details['metaData']['dimensions']['dx'];

		$ou_id=$vis_details['metaData']['dimensions']['ou'];


		foreach($indicator_id as $indicator){

			if(strlen($filter)>0){

				$filter=$filter.' - ';
			}

			$filter=$filter.$vis_details['metaData']['items'][$indicator]['name'];

		}

		foreach($ou_id as $ou){

			if(strlen($filter)>0){

				$filter=$filter.' - ';
			}

			$filter=$filter.$vis_details['metaData']['items'][$ou]['name'];
		}


		$colors=['#a9be3b','#558cc0','#d34957','#ff9f3a','#968f8f','#b7409f','#a9be3b','#558cc0','#d34957','#ff9f3a','#968f8f','#b7409f','#a9be3b','#558cc0','#d34957','#ff9f3a','#968f8f','#b7409f','#a9be3b','#558cc0','#d34957','#ff9f3a','#968f8f','#b7409f'];

		$x_data=[];
		$header=[];
		$y_data=[];
		$table_row=[];
		$table_data=[];
		$j=count($years)-1;
		$i=1;
		$data_indi = array();
		$data_indi['title'] ='Year';
		$data_indi['field'] ='year';
		$header[]=$data_indi ;

		foreach($years as $year){

			$link='https://hmis.mohz.go.tz/api/32/analytics.json?dimension=dx:GJmpi5j6aVb&dimension=pe:'.$relative_periods.'&filter=ou:'.$orgUnit.'&relativePeriodDate='.$year.'&skipData=false&skipMeta=true';


		$api_response=$this->get_anything_From_api($link)['rows'];

		$table_row['year']=$year;


		foreach($api_response as $rows){

			$y_data[]=intval($rows[2]);

			$date=$this->format_date($rows[1]);
			 // $date=$rows[1];

			if($i==$j){
				
				$x_data[]=$date;
				$data_indi = array();
				$data_indi['title'] =$date;
				$data_indi['field'] =$date;
				$header[]=$data_indi ;
			}


			$table_row[$date]=$rows[2];  
		}
		$table_data[]=$table_row;
		$table_row=[]; 
		$data_indi = array();		
		$data_indi['color']=$colors[$i-1];
		$data_indi['data'] = $y_data;
		$data_indi['y'] = array_sum($y_data);
		$data_indi['name'] = $year;

		$y_data = [];

		$i=$i+1;

		$indicator_array[]=$data_indi;
		}



		$response['items'][$visual->id]['filter']= $filter;
		$response['items'][$visual->id]['x_data'] =$x_data;
		$response['items'][$visual->id]['headers'] =$header;	
		$response['items'][$visual->id]['table_data'] =$table_data;			

		$response['items'][$visual->id]['y_data'] = $indicator_array;

		$chart_details=$this->chart_display_options($visual_response['type']);

		$response['items'][$visual->id]['chart_type']= $chart_details['type'];
		$response['items'][$visual->id]['chart_options']= $chart_details['option'];
		$response['items'][$visual->id]['axis_label']= '';


		  if(array_key_exists('rangeAxisLabel',$visual_response)){
            			$response['items'][$visual->id]['axis_label']= $visual_response['rangeAxisLabel'];
            		}



		return $response;

	}

		function format_date($date){

		$length=strlen($date);


		
		if(strpos($date, 'W')){

			$date=substr_replace($date,'',0,4);
			
		}

		elseif($length>6 ){
			$date=substr_replace($date,'',0,4);

			$date=substr_replace($date,'-',2,0);
		}

		elseif($length==6){

			$date=substr_replace($date,'',0,4);
			 $date=date('F', strtotime("2012-$date-01"));
			
		}


		return $date;
			
	}



	function faster_view_vis(){

		// $this->create_organization_unit_path();

		//display visuualization 
		$id = $this->security->xss_clean($this->input->post('id'));
		$visual_id=$this->security->xss_clean($this->input->post('vis_id'));
		$response=array();
		$visualizers = $this->system->get_all_with_dsc('visualizers','tab_id',$id);
		$applications = $this->system->get_all_with('applications', 'tab_id', $id);
		$response['visualizers'] = $visualizers;
		$response['applications'] = $applications;

		foreach($visualizers as $visual){
		$visual_response=json_decode($visual->response,true);

		$dimensions = json_decode($visual->dimensions);

		$org_unit_level=[];
		$org_unit_array=[];
		$org_unit_group=[];

		if (isset( $dimensions->org_unit)) {
			$ou = explode(';',$dimensions->org_unit);
			
			foreach($ou as $ous){			
				if(strlen($ous)>0 ){
				if(strpos($ous,'LEVEL')===false && strpos($ous,'GROUP')===false){
				$org_unit_array[]=$ous;
			}	
	
			else if(strpos($ous,'GROUP')===false){	
				$org_unit_level[] = str_replace('LEVEL-', '', $ous);
			}

			else{
				$org_unit_group[] = str_replace('OU_GROUP-', '', $ous);
			}

			}
			}
		}


		if(strlen($visual->style)<1){

			$widget['col']='';
	    	$widget['row']='';
	    	$widget['size_y']=14;
	    	$widget['size_x']=12;

    		$visual_style['style']=$widget;

			$visual->style=json_encode($visual_style);

			}

			elseif (!(is_array(json_decode($visual->style,true)['style']))) {

			$widget['col']='';
	    	$widget['row']='';
	    	$widget['size_y']=14;
	    	$widget['size_x']=6;

    		$visual_style['style']=$widget;

			$visual->style=json_encode($visual_style);
				// code...
			}

		$chart_details=$this->chart_display_options($visual_response['type']);

		$response['items'][$visual->id]['selected_org_unit'] = $org_unit_array;
		$response['items'][$visual->id]['selected_org_level'] = $org_unit_level;
		$response['items'][$visual->id]['selected_org_group'] = $org_unit_group;
		$response['items'][$visual->id]['chart_type']= $chart_details['type'];
		$response['items'][$visual->id]['chart_options']= $chart_details['option'];
		$response['items'][$visual->id]['periods'] = json_encode(explode(";",$dimensions->periods));
		}
	

		echo json_encode($response);

	}

	public function get_msdqi_data($api_data,$response,$visual,$period_arr,$og_units,$orgUnit){

		$row_data=0;
		$red_p=[];
		$green_p=[];
		$yellow_p=[];

		$y_data=[];
		$y_data_p=[];
		$y_data_table=[];
		$data_index;
		$filter='';

		$y_data_table_p=[];
		$column_dimension;

		$elements=[];

		$dimension_index;

		if(is_array(json_decode($visual->dimensions, true)) && array_key_exists('column',json_decode($visual->dimensions, true))){

		$column=json_decode($visual->dimensions, true)['column'];

		$column=json_decode($column);

		}

		else{

			$column='';
		}

		

		if(is_array($api_data) && array_key_exists('metaData',$api_data)){

			if(is_array($column)){

		if (count($column)==1) {

			$column_dimension=$column[0];
			
		}

		else if (count($column)==2) {

			$column_dimension=$column[1];
			
		}
	}

		else{
			$column_dimension='dx';
			$dimension_index=0;

		}

			if($column_dimension=='Period'){

				$column_dimension='pe';
				$dimension_index=2;
			}

			else if($column_dimension=='OU'){

				$column_dimension='ou';
				$dimension_index=1;		
			}

			else if($column_dimension=='Data'){

				$column_dimension='dx';
				$dimension_index=0;		
			}

		$indicator_array=$api_data['metaData']['dimensions'][$column_dimension];

		if($column_dimension=='ou'){

		$indicator_array=explode(';',$orgUnit);

	}

		$ou_id=$api_data['metaData']['dimensions']['ou'];

		$filter=$this->get_msdqi_filter($column_dimension,$api_data,$orgUnit,$period_arr);

		foreach($indicator_array as $indicator){

		$i = array_search($indicator, $indicator_array);

		if(array_key_exists($indicator,$api_data['metaData']['items'])){
			

			$elements[]=$api_data['metaData']['items'][$indicator]['name'];
			$countred[$i]='';
            $countyellow[$i]='';
            $countgreen[$i]='';

			}
		}

		$ou_array= $api_data['metaData']['ouHierarchy'];

		if($column_dimension=='ou'){

		foreach($api_data['rows'] as $row){


			$hierarchy_array=explode("/",$ou_array[$row[$dimension_index]]);

			foreach($indicator_array as $key =>  $value){

				// var_dump("hierarchy_array",$api_data['metaData']['items']);

				if(array_search($value,$hierarchy_array)){ 

				$i = $key;

			  $data_index=count($row);


			  $row_data=$row[$data_index-1];

              if ($row_data < 50) {
                $countred[$i]= intval($countred[$i])+1;
                
              }
              if ($row_data > 49.9 && $row_data < 75) {
                $countyellow[$i] = intval($countyellow[$i])+1;
              }
              if ($row_data > 74.9 && $row_data < 101) {
                $countgreen[$i]=intval($countgreen[$i])+1;
              }

		}

			}

		}

	}


	else{

		foreach($api_data['rows'] as $row){


			$i = array_search($row[$dimension_index], $indicator_array);

				$data_index=count($row);


				$row_data=$row[$data_index-1];

              if ($row_data < 50) {
                $countred[$i]= intval($countred[$i])+1;
                
              }
              if ($row_data > 49.9 && $row_data < 75) {
                $countyellow[$i] = intval($countyellow[$i])+1;
              }
              if ($row_data > 74.9 && $row_data < 101) {
                $countgreen[$i]=intval($countgreen[$i])+1;
              }

		}

	}

		foreach($indicator_array as $indicator){

			if(array_key_exists($indicator,$api_data['metaData']['items'])){

			$i = array_search($indicator, $indicator_array);

			$countred[$i]=intval($countred[$i]);
			$countyellow[$i]=intval($countyellow[$i]);
			$countgreen[$i]=intval($countgreen[$i]);

			$denominator=intval($countred[$i])+intval($countyellow[$i])+intval($countgreen[$i]);

			if(intval($countred[$i]>0) && intval($denominator>0)){

			$red_p[$i]=round((($countred[$i]/$denominator) * 100));
			}

			else if(intval($countred[$i]==0)){
				$red_p[$i]=0;
			}

			else{

				$red_p[$i]='';
			}


			$denominator=intval($countred[$i])+intval($countyellow[$i])+intval($countgreen[$i]);

			if(intval($countyellow[$i])>0 && intval($denominator)>0){
				$yellow_p[$i]=round((($countyellow[$i]/$denominator) * 100));
			}

			else if(intval($countyellow[$i])==0){
				$yellow_p[$i]=0;
			}

			else{
				$yellow_p[$i]='';
			}

			$denominator=intval($countred[$i])+intval($countyellow[$i])+intval($countgreen[$i]);

			if($countgreen[$i]>0){
				$green_p[$i]=round((($countgreen[$i]/($countred[$i]+$countyellow[$i]+$countgreen[$i])) * 100));
			}

			else if(intval($countgreen[$i])==0){
				$green_p[$i]=0;
			}

			else{
				$green_p[$i]='';
			}

			$data_indi = array();		

			$data_indi['element']=$api_data['metaData']['items'][$indicator]['name'];
			$data_indi['<=50%'] = strval($countred[$i]);
			$data_indi['50% - 75%'] =strval($countyellow[$i]);
			$data_indi['>=75%'] =strval($countgreen[$i]);

			$y_data_table[]=$data_indi;

			$data_indi = array();		

			$data_indi['element']=$api_data['metaData']['items'][$indicator]['name'];
			$data_indi['<=50%'] = strval($red_p[$i]);
			$data_indi['50% - 75%'] =strval($yellow_p[$i]);
			$data_indi['>=75%'] =strval($green_p[$i]);

			$y_data_table_p[]=$data_indi;
			
			}
		}

			foreach($countred as $key=>$value){

				$countred_indexed[]=$value;
			}
			foreach($countyellow as $key=>$value){

				$countyellow_indexed[]=$value;
			}

			foreach($countgreen as $key=>$value){

				$countgreen_indexed[]=$value;
			}

			foreach($red_p as $key=>$value){

				$red_p_indexed[]=$value;
			}
			foreach($yellow_p as $key=>$value){

				$yellow_p_indexed[]=$value;
			}

			foreach($green_p as $key=>$value){

				$green_p_indexed[]=$value;
			}
	
			$data_indi = array();		

			$data_indi['color']='red';
			$data_indi['data'] = $countred_indexed;
			$data_indi['y'] = array_sum($countred);
			$data_indi['name'] ="<=50%";

			$y_data[]=$data_indi;

			$data_indi = array();		

			$data_indi['color']='yellow';
			$data_indi['data'] = $countyellow_indexed;
			$data_indi['y'] = array_sum($countyellow);
			$data_indi['name'] ="50% - 75%";

			$y_data[]=$data_indi;


			$data_indi = array();		

			$data_indi['color']='green';
			$data_indi['data'] = $countgreen_indexed;
			$data_indi['y'] = array_sum($countgreen);
			$data_indi['name'] =">=75%";

			$y_data[]=$data_indi;

	
			$data_indi = array();		

			$data_indi['color']='red';
			$data_indi['data'] = $red_p_indexed;
			$data_indi['y'] = array_sum($red_p);
			$data_indi['name'] ="<=50%";

			$y_data_p[]=$data_indi;

			$data_indi = array();		
			$data_indi['color']='yellow';
			$data_indi['data'] = $yellow_p_indexed;
			$data_indi['y'] = array_sum($yellow_p);
			$data_indi['name'] ="50% - 75%";

			$y_data_p[]=$data_indi;
			$data_indi = array();		

			$data_indi['color']='green';
			$data_indi['data'] = $green_p_indexed;
			$data_indi['y'] = array_sum($green_p);
			$data_indi['name'] =">=75%";

			$y_data_p[]=$data_indi;


			$response['items'][$visual->id]['y_data'] =$y_data;

			$response['items'][$visual->id]['filter']= $filter;

			$response['items'][$visual->id]['y_proportional']=$y_data_p;

			$response['items'][$visual->id]['x_data']=$elements;

			$response['items'][$visual->id]['table_data'] =$y_data_table;

			$response['items'][$visual->id]['table_data_p'] =$y_data_table_p;

			}
			else{


			$response['items'][$visual->id]['y_data'] =$y_data;

			$response['items'][$visual->id]['filter']= $filter;

			$response['items'][$visual->id]['y_proportional']=$y_data_p;

			$response['items'][$visual->id]['x_data']=$elements;

			$response['items'][$visual->id]['table_data'] =$y_data_table;

			$response['items'][$visual->id]['table_data_p'] =$y_data_table_p;
		}

		return $response;

	

	}

	public function get_msdqi_filter($column_dimension,$api_data,$orgUnit,$period_arr){


			$filter="";

			if($column_dimension !=='dx'){


			$indicator_array=$api_data['metaData']['dimensions']['dx'];	

			foreach($indicator_array as $indicator){

			if(array_key_exists($indicator,$api_data['metaData']['items'])){


			if(strlen($filter)>0){

					$filter=$api_data['metaData']['items'][$indicator]['name'].'-'.$filter;
				}

				else{

					$filter=$api_data['metaData']['items'][$indicator]['name'];
				}

					
				}


			}


			}

			if($column_dimension !=='pe'){

			$period_array=$api_data['metaData']['dimensions']['pe']	;
			foreach($period_arr as $period){

					if(strlen($period)>1){
						if(strlen($filter)>0){

							$filter=$filter.' - ';
						}


						if(array_key_exists($period,$api_data['metaData']['items'])){

							$period=$api_data['metaData']['items'][$period]['name'];
						}

							$filter=$filter. str_replace('_', ' ', $period);
						}

						
			}
		}



			if($column_dimension !=='ou'){

			$ou_array=explode(';',$orgUnit);

			// var_dump("the Ou array",	$ou_array);

			foreach($ou_array as $ou){

			if(array_key_exists($ou,$api_data['metaData']['items'])){
			

			$filter=$api_data['metaData']['items'][$ou]['name'].'-'.$filter;
			}


		}

				
			}


		return $filter;
	}


	public function get_table_headers($api_data,$visual_response){

	$row_index=0;
	$x_data=[];
	$row_dimensions_array=['dx','ou','pe'];
	$row_dimensions[]='dx';
	$dimension_name=[];

	if(array_key_exists('rowDimensions',$visual_response)){

		$row_dimensions=[];
		$row_dimensions=$visual_response['rowDimensions'];
		if(count($row_dimensions) > 1 ){

				$row_index=1;
			
			}

			else if(count($row_dimensions) == 1 ){

				$row_index=0;

			
			}

			else{

				$row_dimensions[]='dx';
				$row_index=0;
			}
			}


		if(array_key_exists('columnDimensions',$visual_response)){

			$dimension_name['ou']='Organization Unit';
			$dimension_name['pe']='Period';
			$dimension_name['dx']='Data';


				$column_dimension=$visual_response['columnDimensions'];

				
				if(count($column_dimension) ==1){

					if (array_key_exists('metaData', $api_data)) {


					if(count($row_dimensions) > 1 ){

				$data_indi = array();
				$data_indi['title'] = $dimension_name[$row_dimensions[0]];
				$data_indi['field'] = $row_dimensions[0];
				$x_data[]=$data_indi ;


				}
				$data_indi = array();
				$data_indi['title'] = $dimension_name[$row_dimensions[$row_index]].'/'.$dimension_name[$column_dimension[0]];
				$data_indi['field'] = $row_dimensions[$row_index];
				$x_data[]=$data_indi ;
				
				foreach($api_data['metaData']['dimensions'][$column_dimension[0]] as $data){


				$data_indi = array();
				$data_indi['title'] = $api_data['metaData']['items'][$data]['name'];
				$data_indi['field'] = $api_data['metaData']['items'][$data]['name'];
				// $data_indi['bottomCalc'] ='sum';
				
				$x_data[]=$data_indi ;
		
			// var_dump ("Y_data  :".$data[$i][2]);

				}
				}
				}

				else if(count($column_dimension)>1){

				if(count($row_dimensions) > 1 ){

				$data_indi = array();
				$data_indi['title'] = $dimension_name[$row_dimensions[0]];
				$data_indi['field'] = $row_dimensions[0];
				$x_data[]=$data_indi ;


				}

				$data_indi = array();
				$data_indi['title'] = $dimension_name[$row_dimensions[$row_index]].'/'.$dimension_name[$column_dimension[1]];
				$data_indi['field'] = $row_dimensions[$row_index];


				$array1[]=$data_indi ;

				// $x_data_id=$api_data['metaData']['dimensions'][$column_dimension[0]];

				
				foreach($api_data['metaData']['dimensions'][$column_dimension[1]] as $data){

				$data_indi = array();
				$data_indi['title'] = $api_data['metaData']['items'][$data]['name'];
				$data_indi['field'] = $api_data['metaData']['items'][$data]['name'];


				$array1[]=$data_indi ;
				
			}

				if (array_key_exists('metaData', $api_data)) {


				foreach($api_data['metaData']['dimensions'][$column_dimension[0]] as $data){

				$data_indi = array();
				$data_indi['title'] = $api_data['metaData']['items'][$data]['name'];
				$data_indi['columns'] = $array1;

				$x_data[]=$data_indi ;			
		
				}

				}
				
			}

				else if(array_key_exists('yearlySeries',$visual_response))
				{


				foreach($api_data['metaData']['dimensions']['pe'] as $data){

				$x_data[]=$api_data['metaData']['items'][$data]['name'];


				}	


				}
			
			}

			return $x_data;

	}


	public function get_table_data($api_data,$visual_response){

			$indicator_id_array=[];
			$indicatorId='';
			$indicatorName='';
			$y_data = [];
			$tmp_indicator='';
			$column[]='dx';
			$row_dimensions[]=0;
			$dimension_index='';
			$column_index='';
			$column_array=[];
			$col_index=0;
			$row_index=0;
			$dimension_array=['dx','ou','pe'];

			$data_sorting_enabled=array();

			$data_sorting_enabled['enabled']=true;
			$row_dimensions[]='dx';
			$indicator_array=[];
			$tmp='';
			$tmp_title='';

			$ou_path=$this->get_ou_path();
			

		if(array_key_exists('rowDimensions',$visual_response)){

				$row_dimensions=[];
				$row_dimensions=$visual_response['rowDimensions'];
			if(count($row_dimensions) > 1 ){

				$row_index=1;
			
			}

			else if(count($row_dimensions) == 1 ){

				$row_index=0;

			
			}

			else{

				$row_dimensions[]='dx';
				$row_index=0;
			}
		}

			if(array_key_exists('columnDimensions',$visual_response)){

				$column=$visual_response['columnDimensions'];

			}

		
			if($row_dimensions[$row_index] == 'ou'){

				$dimension_index=1;
			}

			else if($row_dimensions[$row_index] == 'pe'){

				$dimension_index=2;
			}

			else {

				$dimension_index=0;

			}





		if($column[0] == 'ou'){

				$column_index=1;
			}

		else if($column[0] == 'dx'){

				$column_index=0;
			}

		else {

				$column_index=2;

			}



			if((count($column) > 0 ) && (count($column) > 1)){
						
			if($column[1] == 'ou'){

				$column_index=1;
			}

			else if($column[1] == 'dx'){

					$column_index=0;
				}

			else {

					$column_index=2;

				}

			}



			if (array_key_exists('rows', $api_data)) {
			$rows=$api_data['rows'];

			$serialized = array_map('serialize',$rows);
			$unique = array_unique($serialized);
			$rows=array_intersect_key($rows, $unique);


			
			$indicator_id_array=$api_data['metaData']['dimensions'][$dimension_array[$column_index]];


			$dimension_id_array=$api_data['metaData']['dimensions'][$dimension_array[$dimension_index]];


		foreach($dimension_id_array as $dimension_id){

				$y_data_x=array();
			foreach($indicator_id_array as $indicator_id){


			$indicatorName=$api_data['metaData']['items'][$indicator_id]['name'];

			$y_data_x[$row_dimensions[$row_index]]=$api_data['metaData']['items'][$dimension_id]['name'];




			if(array_key_exists($dimension_id,$ou_path['districts'])){

				$y_data_x[$row_dimensions[$row_index]]=$ou_path['districts'][$dimension_id];
			}


			if(array_key_exists($dimension_id,$ou_path['clinics'])){

				$y_data_x[$row_dimensions[$row_index]]=$ou_path['clinics'][$dimension_id];
			}


			if(array_key_exists($dimension_id,$ou_path['shehias'])){

				$y_data_x[$row_dimensions[$row_index]]=$ou_path['shehias'][$dimension_id];
			}

			if(array_key_exists('legendSet',$api_data)){
			if($api_data['legendSet']){

			$j=0;

			foreach($rows as $row){


			if($row[$column_index] == $indicator_id && $row[$dimension_index] == $dimension_id){  //if column match current iterating column

			if($row_index>0 && $tmp != $row[array_search($row_dimensions[0],$dimension_array)]){



			$y_data_x[$row_dimensions[0]]=$api_data['metaData']['items'][$row[array_search($row_dimensions[0],$dimension_array)]]['name'];
			$tmp=$row[array_search($row_dimensions[0],$dimension_array)];
				
			}

			$y_data_x[$indicatorName]=intval($row[3]).'$'.$row[4];    //label with x axis categories


			}

			}
			}
			}

		else{

			foreach($rows as $row){


			$j=0;

			if($row[$column_index] == $indicator_id && $row[$dimension_index] == $dimension_id){  //if column match current iterating column

			if($row_index>0 && $j<1 && $tmp_title != $row[array_search($row_dimensions[0],$dimension_array)]){

			$y_data_x[$row_dimensions[0]]=$api_data['metaData']['items'][$row[array_search($row_dimensions[0],$dimension_array)]]['name'];

			$tmp_title=$row[array_search($row_dimensions[0],$dimension_array)];

				
			}
			$j=$j+1;

			$y_data_x[$indicatorName]=$row[3];    //label with x axis categories




			}

			}
		
		}

		}

		$indicator_array[]=$y_data_x; 


				}
			}

		
			
		return $indicator_array;



	}

	public function get_filters($api_data,$visual_response){

		$filters='';
		$i=0;

	if(array_key_exists('metaData',$api_data)){

	foreach ($visual_response['filters'] as $visual){

		if($visual['id']=='ou'){

		foreach($api_data['metaData']['dimensions'][$visual['id']] as $data){

			if(!($filters == 'Zanzibar')){
			if($i>0){

				$filters=$filters.'-'.$api_data['metaData']['items'][$data]['name'];
			}

			else{
				$filters=$api_data['metaData']['items'][$data]['name'];
				
				}

				$i=$i+1;
			}
		}
	}


	}

	$periods='';

	foreach ($visual_response['relativePeriods'] as $key =>  $value)
	{



	if($visual_response['relativePeriods'][$key]){
			$relative_period=$key;

			$period_arr = str_split($key);
			$j=0;

			for($i=0;$i<count($period_arr) ; $i++)	{


			if((ctype_upper($period_arr[$i]))&&(($period_arr[$i-1]!='i'))){

			$relative_period = substr_replace($relative_period, ' ', $i+$j, 0);
			$j=$j+1;

			}

			if(((is_numeric($period_arr[$i]))&& (!is_numeric($period_arr[$i-1])) ) ){

			$relative_period = substr_replace($relative_period, ' ', $i, 0);
			$j=$j+1;
			}

			}

			$relative_period = substr_replace($relative_period, strtoupper($period_arr[0]), 0, 1);


			// $periods=$periods.$relative_period;	

			if($relative_period=="Last Week" || $visual_response['type']=='SINGLE_VALUE'){

			//$periods = 'THIS_YEAR;LAST_YEAR;';

			if(strlen($filters)>0){
			$filters=$filters.'-'.$relative_period;

			}

			else{
				$filters=$relative_period;
			}
		}
	}
	}

	}

	 return $filters;
	}

	public function chart_display_options($chart_name){

	$chart_details=[];

		if($chart_name == 'PIVOT_TABLE'){


			$chart_details['type']='table';
			$chart_details['option']='table';


		}

		else if($chart_name == 'COLUMN'){ 

			$chart_details['type']='column';
			$chart_details['option']=1;


		}

		else if($chart_name == 'STACKED_COLUMN'){ 

			$chart_details['type']='column';
			$chart_details['option']=2;

		}

		else if($chart_name == 'SINGLE_VALUE'){ //Not used

			$chart_details['type']='single';
			$chart_details['option']='card';

		}

		else if($chart_name == 'BAR'){

			$chart_details['type']='bar';
			$chart_details['option']=1;

		}

		else if($chart_name == 'STACKED_BAR'){ 

			$chart_details['type']='bar';
			$chart_details['option']=2;

		}

		else if($chart_name == 'LINE'){ 

			$chart_details['type']='line';
			$chart_details['option']=1;


		}

		else if($chart_name == 'AREA'){

			$chart_details['type']='area';
			$chart_details['option']=1;

		}

		else if($chart_name == 'PIE'){ 


			$chart_details['type']='pie';
			$chart_details['option']='pie';

		}

		else if($chart_name == 'RADAR'){ 

			$chart_details['type']='column';
			$chart_details['option']=1;

		}
		else if($chart_name == 'GAUGE'){ 

			$chart_details['type']='column';
			$chart_details['option']=1;

		}

		else if($chart_name == 'MAP'){ 

			$chart_details['type']='map';
			$chart_details['option']='map';

		}

		else if($chart_name == 'YEAR_OVER_YEAR_LINE'){ 

			$chart_details['type']='line';
			$chart_details['option']=1;

		}

		else if($chart_name == 'YEAR_OVER_YEAR_COLUMN'){ 

			$chart_details['type']='column';
			$chart_details['option']=1;

		}

		else{

			$chart_details['type']='column';
			$chart_details['option']=1;
		}

		return $chart_details;

	}


	function filter_data(){
		$id = $this->security->xss_clean($this->input->post('id'));
		$response = [];
		$applications = $this->system->get_all_with('applications', 'tab_id', $id);
		$visualizers = $this->system->get_all_with('visualizers','tab_id',$id);
		$response['visualizers'] = $visualizers;
		$response['applications'] = $applications;
		foreach($visualizers as $visual){
			
			$res_conf = $this->system->get_all_with('response','vis_id',$visual->id);
			$response['indicators'][$visual->id] =$res_conf;

		}

		foreach($visualizers as $key => $visual){
			$vis_res = $this->system->get_all_with('response', 'vis_id', $visual->id);

			foreach ($vis_res as $res) {

				$regions = $this->input->post('regions');
				$districts = $this->input->post('districts');
				$clinics = $this->input->post('clinics');
				$startday = $this->input->post('startday');
				$endday = $this->input->post('endday');
				$newStartDay = date("Y-m-d", strtotime($startday));
				$newEndDay = date("Y-m-d", strtotime($endday));

				$api_data = $this->get_filtered_api($newStartDay, $newEndDay, $regions, $districts, $clinics, $res->element_id);

				if (array_key_exists('rows', $api_data)) {
					$response['indicator_data'][$visual->id][$res->id] = $api_data['rows'];
					}
	 }	
		
	}
	echo json_encode($response);
	}

	function get_filtered_api($startDate, $endDate, $level2, $level3, $level4, $indicatorId){
		$curl = curl_init();
		$uname = 'coconut';
		$pass = 'Coconut@2019';
		
		curl_setopt_array($curl,[
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_USERPWD => $uname.':'.$pass ,
		CURLOPT_URL =>'https://hmis.mohz.go.tz/api/analytics?dimension=dx:'.$indicatorId.';'.$indicatorId.'&dimension=ou:'.$level2.';'.$level3.';'.$level4.'&startDate='.$startDate.'&endDate='.$endDate.'',
		CURLOPT_USERAGENT => 'DHIS api'
		]);
		$responsee = curl_exec($curl);
		curl_close($curl);
		$response = json_decode($responsee, true);
		return $responsee;
	}


	function get_api($link, $file)
	{
		$result = NULL;
		$curl = curl_init();
		$uname = 'coconut';
		$pass = 'Coconut@2019';

		curl_setopt_array($curl,[
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_USERPWD => $uname.':'.$pass ,
		CURLOPT_URL => 'https://hmis.mohz.go.tz/api/'.$link.'.json?paging=false',
		CURLOPT_USERAGENT => 'DHIS api'
		]);
		$response = curl_exec($curl);
		curl_close($curl);
		$fh = fopen($file, 'w');
		fwrite($fh, $response);
		fclose($fh);
		$fileapi = file_get_contents($file);
		$result = json_decode($fileapi, true);
		return $result;
	}

	function get_anything_From_api($link)
	{
		$curl = curl_init();
        $uname = 'coconut';
		$pass = 'Coconut@2019';

		curl_setopt_array($curl,[
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_USERPWD => $uname.':'.$pass ,
		CURLOPT_URL => $link,
		CURLOPT_USERAGENT => 'DHIS api'
		]);
		$response = curl_exec($curl);
		curl_close($curl);
		$responses = json_decode($response, true);
		return $responses;
	}

	function check_logged_user($uname, $pass, $link)
	{
		$curl = curl_init();

		curl_setopt_array($curl,[
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_USERPWD => $uname.':'.$pass ,
		CURLOPT_URL => $link,
		CURLOPT_USERAGENT => 'DHIS api'
		]);
		$response = curl_exec($curl);
		curl_close($curl);
		$responses = json_decode($response, true);
		return $responses;
		

	}

    function get_programIndicators()
	{	
		$val = $this->input->post('val');
		$link = 'https://hmis.mohz.go.tz/api/programIndicators.json?filter=program.id:eq:'.$val.'';

		$result = $this->get_anything_From_api($link);

		echo json_encode($result);
		
	}

	function get_programIndicatorsGroups()
	{	
		$prgramIndicatorGroupFile =  $_SERVER['DOCUMENT_ROOT'].'/portal'.'/temp'.'/prgramIndicatorGroupsTemp.json';

		if (file_exists($prgramIndicatorGroupFile))
		{
			$fh = fopen($prgramIndicatorGroupFile, 'r');
			$file_created_time = strtotime(date("H:i:s",filemtime($prgramIndicatorGroupFile)));
			$current_time = strtotime(date("H:i:s"));
			$interval = abs($current_time - $file_created_time);
			$minutes = round($interval / 60);

			if ($minutes>45)
			{
				fclose($fh);
				unlink($prgramIndicatorGroupFile);
				$result = $this->get_api('programs', $prgramIndicatorGroupFile);
			}
			else
			{	
				$filecnt = file_get_contents($prgramIndicatorGroupFile);
				$result = json_decode($filecnt, true);
				
			}
		}
		else
		{
			$result = $this->get_api('programs', $prgramIndicatorGroupFile);
		}
		//echo $file_created_time, "and ", $current_time, " and ", $interval, "and ",$minutes;
		echo json_encode($result);
	}

	function get_indicatorsGroups()
	{
		$indicatorGroupsFile =  $_SERVER['DOCUMENT_ROOT'].'/portal'.'/temp'.'/indicatorGroupdTemp.json';

		if (file_exists($indicatorGroupsFile))
		{
			$fh = fopen($indicatorGroupsFile, 'r');
			$file_created_time = strtotime(date("H:i:s",filemtime($indicatorGroupsFile)));
			$current_time = strtotime(date("H:i:s"));
			$interval = abs($current_time - $file_created_time);
			$minutes = round($interval / 60);

			if ($minutes>45)
			{
				fclose($fh);
				unlink($indicatorGroupsFile);
				$result = $this->get_api('indicatorGroups', $indicatorGroupsFile);
			}
			else
			{	
				$filecnt = file_get_contents($indicatorGroupsFile);
				$result = json_decode($filecnt, true);
			}
		}
		else
		{
			$result = $this->get_api('indicatorGroups', $indicatorGroupsFile);
		}
		echo json_encode($result);		
	}

	function get_dataElements()
	{
		$val = $this->input->post('val');
		$link = 'https://hmis.mohz.go.tz/api/dataElements.json?filter=dataElementGroups.id:eq:'.$val.'';

		$result = $this->get_anything_From_api($link);

		echo json_encode($result);
		
	}

	function get_dataElements_Groups()
	{
		$dataElementGroupFile =  $_SERVER['DOCUMENT_ROOT'].'/portal'.'/temp'.'/dataElementGroupTemp.json';

		if (file_exists($dataElementGroupFile))
		{
			$fh = fopen($dataElementGroupFile, 'r');
			$file_created_time = strtotime(date("H:i:s",filemtime($dataElementGroupFile)));
			$current_time = strtotime(date("H:i:s"));
			$interval = abs($current_time - $file_created_time);
			$minutes = round($interval / 60);

			if ($minutes>45)
			{
				fclose($fh);
				unlink($dataElementGroupFile);
				$result = $this->get_api('dataElementGroups', $dataElementGroupFile);
			}
			else
			{	
				$filecnt = file_get_contents($dataElementGroupFile);
				$result = json_decode($filecnt, true);
			}
		}
		else
		{
			$result = $this->get_api('dataElementGroups', $dataElementGroupFile);
		}
		echo json_encode($result);	
	}

	function get_dataSets()
	{
		$dataSetFile =  $_SERVER['DOCUMENT_ROOT'].'/portal'.'/temp'.'/visualizationFile.json';

		if (file_exists($dataSetFile))
		{
			$fh = fopen($dataSetFile, 'r');
			$file_created_time = strtotime(date("H:i:s",filemtime($dataSetFile)));
			$current_time = strtotime(date("H:i:s"));
			$interval = abs($current_time - $file_created_time);
			$minutes = round($interval / 60);

			if ($minutes>45)
			{
				fclose($fh);
				unlink($dataSetFile);
				$result = $this->get_api('dataSets', $dataSetFile);
			}
			else
			{	
				$filecnt = file_get_contents($dataSetFile);
				$result = json_decode($filecnt, true);
			}
		}
		else
		{
			$result = $this->get_api('dataSets', $dataSetFile);
		}
		echo json_encode($result);	
	}

	public function save_comments(){
		// return "hi";
		$tab_id = $this->security->xss_clean($this->input->post('comment_tab_id'));
		$user_id = $this->security->xss_clean($this->input->post('user_id'));
		$body = $this->security->xss_clean($this->input->post('body'));
		$created_at = date('d-m-y h:i:s');
		$data = [
			'tab_id'=>$tab_id,
			'user_id'=>$user_id,
			'body'=>$body,
			'tab_id'=>$tab_id
		];
		$save = $this->system->create_data('comments',$data);

		if ($save) {

			// $this->session->set_flashdata('success', 'Comment added successfully');

		}else {
			
			$this->session->set_flashdata('error','Failed to add coment please try again');
		}
		redirect('dashboard');
		$data = $this->security->xss_clean($data);
	}

	public function save_comment_asy(){

		$displayName = $this->security->xss_clean($this->input->post('displayName'));
		$userName = $this->security->xss_clean($this->input->post('userName'));
		$visualization_id = $this->security->xss_clean($this->input->post('visualization_id'));
		// return "hi";
		$tab_id = $this->security->xss_clean($this->input->post('comment_tab_id'));
		$user_id = $this->security->xss_clean($this->input->post('user_id'));
		$body = $this->security->xss_clean($this->input->post('body'));

		$data = [
			'displayName'=>$displayName,
			'userName'=>$userName,
			'visualization_id '=>$visualization_id ,
			'tab_id'=>$tab_id,
			'user_id'=>$user_id,
			'body'=>$body
		];
		$save = $this->system->create_data('comments',$data);

		if ($save) {

			// $this->session->set_flashdata('success', 'Comment added successfully');

		}else {
			
			$this->session->set_flashdata('error','Failed to add coment please try again');
		}

		$res = $this->system->get_latest_record('comments','body',$body);

		if(count($res)>0){
			foreach($res as $result){
				$id = $result->id;
			}
		}
		$data = $this->security->xss_clean($data);
		echo json_encode($id);
	}

	function add_app(){
		$name = $this->security->xss_clean($this->input->post('name'));
		$link = $this->security->xss_clean($this->input->post('link'));
		$dashid = $this->security->xss_clean($this->input->post('dash_id'));
		$tabid = $this->security->xss_clean($this->input->post('tab_id'));

		if (filter_var($link, FILTER_VALIDATE_URL) === FALSE) {

			echo json_encode(false);
		}
		else {
			$data =[
			'name'=>$name,
			'link'=>$link,
			'dash_id'=>$dashid,
			'element_id'=>$dashid,
			'tab_id'=>$tabid
		];
			$save = $this->system->create_data_returns_id('applications',$data);
			if ($save) {
				$this->session->set_flashdata('success', 'Visualizer added successfully');
			} else {

				$this->session->set_flashdata('error', 'Failed to add visualizer please try again');
			}
			echo json_encode($save);	
		}

	}

	function delete_app($id){
		$app = $this->system->delete_data('applications', 'id', $id);
		return false;
		
	}

	function last_tab(){

		$id = $this->input->post('id');
		$_SESSION["last_tab"] = $id;
		echo json_encode($id);
	}

	function get_Dhis2_visualizations()
	{
		$link = 'https://hmis.mohz.go.tz/api/visualizations.json?paging=false';
		$result = $this->get_anything_From_api($link);
	
		echo json_encode($result);	
	}

	function get_Dhis2_maps(){
		$link = 'https://hmis.mohz.go.tz/api/maps.json?paging=false';
		$result = $this->get_anything_From_api($link);

		echo json_encode($result);
	}

	function get_Dhis2_Pivottables(){
		$link = 'https://hmis.mohz.go.tz/api/reportTables.json?paging=false';
		$result = $this->get_anything_From_api($link);

		echo json_encode($result); 
	}


	function create_organization_unit_path()
	{
		$region_file =  $_SERVER['DOCUMENT_ROOT'].'/portal'.'/temp'.'/regionTemp.json';

		$districtFile = $_SERVER['DOCUMENT_ROOT'].'/portal'.'/temp'.'/districtTemp.json';

		$clinicFile = $_SERVER['DOCUMENT_ROOT'].'/portal'.'/temp'.'/clinicTemp.json';

		$shehiaFile = $_SERVER['DOCUMENT_ROOT'].'/portal'.'/temp'.'/shehiaTemp.json';

		$path_file= $_SERVER['DOCUMENT_ROOT'].'/portal'.'/temp'.'/ouTemp.json';


		$regions = file_get_contents($region_file);
		$regions = json_decode($regions, true);

		$districts = file_get_contents($districtFile);
		$districts = json_decode($districts, true);

		$clinics = file_get_contents($clinicFile);
		$clinics = json_decode($clinics, true);

		$shehias = file_get_contents($shehiaFile);
		$shehias = json_decode($shehias, true);

		$ou_path=[];

		foreach($regions as $region){

			foreach($districts as $district){

				if($region['id']==$district['parent']){

					$path='Zanzibar/'.$region['displayName'].'/'.$district['name'];

					$ou_path['districts'][$district['id']]=$path;

				foreach($clinics as $clinic){

					if($district['id']==$clinic['parent']){

					$path='Zanzibar/'.$region['displayName'].'/'.$district['name'].'/'.$clinic['name'];

					$ou_path['clinics'][$clinic['id']]=$path;

					foreach($shehias as $shehia){


					if($clinic['id']==$shehia['parent']){

					$path='Zanzibar/'.$region['displayName'].'/'.$district['name'].'/'.$clinic['name'].'/'.$shehia['name'];

					$ou_path['shehias'][$shehia['id']]=$path;

						}

					}
				}
			}
		}
	}
	}


		$fh = fopen($path_file, 'w');
		fwrite($fh, json_encode($ou_path));
		fclose($fh);
	}




	function get_ou_path()
	{
		$path_file= $_SERVER['DOCUMENT_ROOT'].'/portal'.'/temp'.'/ouTemp.json';

		$paths = file_get_contents($path_file);
		$result = json_decode($paths, true);
		return $result;
	}

	function get_visualizations_response($visulId){
		$curl = curl_init();
		$uname = 'coconut';
		$pass = 'Coconut@2019';

		curl_setopt_array($curl,[
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_USERPWD => $uname.':'.$pass ,
		CURLOPT_URL =>'https://hmis.mohz.go.tz/api/visualizations/'.$visulId.'.json?paging=false',
		CURLOPT_USERAGENT => 'DHIS api'
		]);
		
		$responsee = curl_exec($curl);
		return $responsee;
	}

	function get_visualizations_response_map($visulId){
		$curl = curl_init();
		$uname = 'coconut';
		$pass = 'Coconut@2019';

		curl_setopt_array($curl,[
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_USERPWD => $uname.':'.$pass ,
		CURLOPT_URL =>'https://hmis.mohz.go.tz/api/maps/'.$visulId.'.json?paging=false',
		CURLOPT_USERAGENT => 'DHIS api'
		]);
		
		$responsee = curl_exec($curl);
		return $responsee;
	}

	function get_visualization_data($period, $indicator, $organizationUnit){
		$curl = curl_init();
		$uname = 'coconut';
		$pass = 'Coconut@2019';

		curl_setopt_array($curl,[
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_USERPWD => $uname.':'.$pass,
		//CURLOPT_URL =>'https://hmis.mohz.go.tz/api/visualizations/'.$visulId.'.json?;paging=false',
		CURLOPT_URL =>'https://hmis.mohz.go.tz/api/analytics?dimension=dx:'.$indicator.'&dimension=ou:'.$organizationUnit.'&dimension=pe:'.$period.'',
		CURLOPT_USERAGENT => 'DHIS api'
		]);

		$responsee = curl_exec($curl);

		// var_dump('https://hmis.mohz.go.tz/api/analytics?dimension=dx:'.$indicator.'&dimension=ou:'.$organizationUnit.'&dimension=pe:'.$period.'');

		// return false;
		return $responsee;
	}


	function get_visualization_data_hierarchy($period, $indicator, $organizationUnit){
		$curl = curl_init();
		$uname = 'coconut';
		$pass = 'Coconut@2019';

		curl_setopt_array($curl,[
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_USERPWD => $uname.':'.$pass,
		//CURLOPT_URL =>'https://hmis.mohz.go.tz/api/visualizations/'.$visulId.'.json?;paging=false',
		CURLOPT_URL =>'https://hmis.mohz.go.tz/api/analytics?dimension=dx:'.$indicator.'&dimension=ou:'.$organizationUnit.'&dimension=pe:'.$period.';&hierarchyMeta=true',
		CURLOPT_USERAGENT => 'DHIS api'
		]);

		$responsee = curl_exec($curl);

		return $responsee;
	}

	function getLegendSet($legendSetId){
		$curl = curl_init();
	    $uname = 'coconut';
		$pass = 'Coconut@2019';

		curl_setopt_array($curl,[
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_USERPWD => $uname.':'.$pass,
		//CURLOPT_URL =>'https://hmis.mohz.go.tz/api/visualizations/'.$visulId.'.json?;paging=false',
		CURLOPT_URL =>'https://hmis.mohz.go.tz/api/legendSets/'.$legendSetId.'.json?',
		CURLOPT_USERAGENT => 'DHIS api'
		]);

		$responsee = curl_exec($curl);
		return $responsee;

	}

	function get_visualization_data2($period, $indicator){
		$curl = curl_init();
		$uname = 'coconut';
		$pass = 'Coconut@2019';

		curl_setopt_array($curl,[
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_USERPWD => $uname.':'.$pass,
		//CURLOPT_URL =>'https://hmis.mohz.go.tz/api/visualizations/'.$visulId.'.json?paging=false',
		CURLOPT_URL =>'https://hmis.mohz.go.tz/api/analytics?dimension=dx:'.$indicator.'&dimension=ou:UNSNiNqkzEM&dimension=pe:'.$period.'',
		CURLOPT_USERAGENT => 'DHIS api'
		]);

		$responsee = curl_exec($curl);
		return $responsee;
	}

	function get_trimmed_period($relative, $fixed, $decc=null){
	
		if (empty($relative) && !empty($fixed)) {
			$periods = $this->concatinate_string($fixed);
		}
	
		if (!empty($relative) && empty($fixed)) {
			$periods = $this->concatinate_string($relative);
		}

		if (!empty($relative) && !empty($fixed)) {

			$periods= $this->concatinate_string($relative). $this->concatinate_string($fixed);
		}

		if (empty($relative) && empty($fixed) && isset($decc)) {
			$periods = $decc->periods;

		 } 
		
		return $periods;
	}
	

	function add_normal_vis(){
	    $name = $this->security->xss_clean($this->input->post('title'));
	    $dashid = $this->security->xss_clean($this->input->post('dash_id'));
	    $tabid = $this->security->xss_clean($this->input->post('tab_id'));
	    $chart_type = $this->security->xss_clean($this->input->post('chart_type'));
	    $selected_clinics = $this->security->xss_clean($this->input->post('selected_clinics'));
		$selected_regions = $this->security->xss_clean($this->input->post('selected_regions'));
		$selected_districs = $this->security->xss_clean($this->input->post('selected_districs'));
		$orggroups = $this->security->xss_clean($this->input->post('orggroups'));
		$orglevels = $this->security->xss_clean($this->input->post('orglevels'));
		$selected_period = $this->security->xss_clean($this->input->post('selected_period'));
		$groupid = $this->security->xss_clean($this->input->post('groupid'));

		$column = $this->security->xss_clean($this->input->post('column'));
		$filter = $this->security->xss_clean($this->input->post('filter'));
		$data = $this->security->xss_clean($this->input->post('data'));

		$elementid = $this->security->xss_clean($this->input->post('elementid'));
		$relative_period = $this->security->xss_clean($this->input->post('relative_period'));
		$fixed_period = $this->security->xss_clean($this->input->post('fixed_period'));
		$filter_data=[];

		$orggroups = $this->security->xss_clean($this->input->post('orggroups'));
		$orglevels = $this->security->xss_clean($this->input->post('orglevels'));


		$orgUnit = $this->get_filtered_organization_unit($selected_clinics, $selected_districs, $selected_regions, $orggroups, $orglevels);
		$period = $this->get_trimmed_period($relative_period, $fixed_period);
		$res = $this->concatinate_string($elementid);
		

		$filter_data['periods']=$period;
		$filter_data['org_unit']=$orgUnit;
		$filter_data['indicators']=$res;

		$filter_data['column'] = json_encode($column) ;
		$filter_data['filter'] = json_encode($filter);
		$filter_data['rows'] = json_encode($data);

		

		$type['type'] = 'COLUMN';

	    $data =[
	      'title'=>$name,
	      'dash_id'=>$dashid,
	      'chart_type'=>$chart_type,
	      'tab_id'=>$tabid,
	      'dimensions'=>json_encode($filter_data),
	      'response' =>json_encode($type)
	      // 'style'=>json_encode($style_data)
	    ];

	    
	    $save = $this->system->create_data_returns_id('visualizers',$data);

	    echo json_encode($save);

	  }

	function concatinate_string($array){
		$stringg = "";
		foreach ($array as $value) {
			$stringg = $stringg.$value.';';
			
		}

		return $stringg;
	}


	function concatinate_string_with_word($array, $word){
		$stringg = "";
		foreach ($array as $value) {

			$new_str = str_replace(' ', '', $value);
			$stringg = $stringg.$word.$new_str.';';
			
		}

		return $stringg;
	}

	function get_filtered_organization_unit($selected_clinics, $selected_districs, $selected_regions, $orggroups, $orglevels, $decc=null){

		if (!empty($selected_districs) && empty($selected_regions) && empty($selected_clinics)) {
			$orgUnit = $this->concatinate_string($selected_districs);
		}

		if (!empty($selected_regions) && empty($selected_clinics) && empty($selected_districs)) {
			$orgUnit = $this->concatinate_string($selected_regions);
		}

		if (!empty($selected_clinics) && !empty($selected_districs) && empty($selected_regions)) {
			$orgUnit = $this->concatinate_string($selected_districs).$this->concatinate_string($selected_clinics);
		}

		if (!empty($selected_regions) && !empty($selected_districs) && empty($selected_clinics)) {
			$orgUnit = $this->concatinate_string($selected_regions).$this->concatinate_string($selected_districs);
		}

		if (!empty($selected_regions) && !empty($selected_clinics) && empty($selected_districs)) {
			$orgUnit = $this->concatinate_string($selected_regions).$this->concatinate_string($selected_clinics);
		}

		if (!empty($selected_regions) && !empty($selected_clinics) && !empty($selected_districs)) {
			$orgUnit = $this->concatinate_string($selected_regions).$this->concatinate_string($selected_districs).$this->concatinate_string($selected_clinics);
		}

		if (empty($selected_regions) && empty($selected_clinics) && empty($selected_districs) && empty($orggroups) && empty($orglevels)) {
			$orgUnit = $decc->org_unit;
		}
		
		if (!empty($orggroups) && !empty($orgUnit)) {
			$orgUnit = $this->concatinate_string_with_word($orggroups, 'OU_GROUP-').$orgUnit;
		}

		if (!empty($orggroups) && empty($orgUnit)) {
			$orgUnit = $this->concatinate_string_with_word($orggroups, 'OU_GROUP-');
		}

		if (!empty($orglevels) && !empty($orgUnit)) {
			$orgUnit = $this->concatinate_string_with_word($orglevels, 'LEVEL-').$orgUnit;
		}

		if (!empty($orglevels) && empty($orgUnit)) {
			$orgUnit = $this->concatinate_string_with_word($orglevels, 'LEVEL-');
		}
		return $orgUnit;

	}

  function update_style(){
  	$name = $this->security->xss_clean($this->input->post('name'));
  	$tab_id = $this->security->xss_clean($this->input->post('tab_id'));
    $styles = $this->security->xss_clean($this->input->post('style'));
    $container = $this->security->xss_clean($this->input->post('container'));
    $translate = $this->security->xss_clean($this->input->post('translate'));

    	$data =[
			'name'=>$name,
			];

	$save = $this->system->update_data('dashboard_tabs',$data,'id',$tab_id);

	$visualizers = $this->system->get_all_with('visualizers','tab_id',$tab_id);
   
    $styles=json_decode($styles,true);

     // data-row="2" data-col="4" data-sizex="2" data-sizey="1"

    foreach($styles as $style){

    	$id=$style['id'];

    	$visual = $this->system->get_any_row('visualizers','id',$id);

    	$visual_style=json_decode($visual->style,true);


    	$widget['col']=$style['col'];
    	$widget['row']=$style['row'];
    	$widget['size_y']=$style['size_y'];
    	$widget['size_x']=$style['size_x'];

    	$visual_style['style']=$widget;


    	$data =[
			'style'=>json_encode($visual_style),
			];

		$save = $this->system->update_data('visualizers',$data,'id',$visual->id);


	}

  }

  function bulletin_index($msg=NULL)
  {
	$this->session->set_userdata('referred_from', current_url());
  	$this->data['files'] = $this->system->get_all('reports');
  	$this->data['templates'] = $this->system->get_all('templates');
  	$this->data['dashboards'] = $this->system->get_all('dashboards');
	$this->data['content'] = 'bulletin_index';
	$this->data['msg'] = $msg;
	$this->load->view('template', $this->data);
  }

  function bulletin_reload($msg=NULL)
  {
  	$this->data['files'] = $this->system->get_all('reports');
  	$this->data['templates'] = $this->system->get_all('templates');
  	$this->data['dashboards'] = $this->system->get_all('dashboards');
	$this->data['content'] = 'bulletin_index';
	$this->data['msg'] = $msg;
	$this->load->view('template', $this->data);

  }

  function check_admin(){

  	if(!$_SESSION['admin'])
  	{
		$this->data['content'] = 'forbidden';
		$this->load->view('template',$this->data);
		return false;
	}
	else{
	return true;
}
  }

  function save_report()
  {
  	$title = $this->input->post('name');
  	$file = $this->input->post('userfile');
  	$type = $this->input->post('reportType');

    $status = "";
    $msg = "";
    $file_element_name = 'userfile';
     
    if (empty($title))
    {
        $status = "error";
        $msg = "Please enter a title";
         redirect('malariabulletin/'.$msg);
    }
     
    if ($status != "error")
    {
    	if ($type =="report") {

    		$config['upload_path'] =   $_SERVER['DOCUMENT_ROOT'].'/portal'.'/temp/bulletin-files';
    	}
    	if ($type =="template") {
    		$config['upload_path'] =   $_SERVER['DOCUMENT_ROOT'].'/portal'.'/temp/bulletin-template-file';
    	}
        
        $config['allowed_types'] = 'gif|jpg|png|doc|pdf';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = TRUE;
 
        $this->load->library('upload', $config);  # Load upload library
    	$this->upload->initialize($config);   # Initialize
 

        if (!$this->upload->do_upload($file_element_name))
        {
            $status = 'error';
            $msg = $this->upload->display_errors('', '');
             redirect('malariabulletin/'.$msg);
        }
        else
        {
            $data = $this->upload->data();

            if ($type =="report") {

            	$file_id = $this->system->insert_file($data['file_name'], $_POST['name'], 'reports');
            }
            if ($type =="template") {

            	$file_id = $this->system->insert_file($data['file_name'], $_POST['name'], 'templates');
            }
            
            if($file_id)
            {
                $status = "success";
                $msg = "File successfully uploaded";
                //redirect back to the page with status message;
                 redirect('malariabulletin/'.$msg);
               
            }
            else
            {
                unlink($data['full_path']);
                $status = "error";
                $msg = "Something went wrong when saving the file, please try again.";
                 redirect('malariabulletin/'.$msg);
            }
        }
       
    }
 

  }

  function edit_bulletin_file(){
  	$newTitle = $this->input->post('newTitle');
  	$id = $this->input->post('id');

  	$edit = $this->system->update_data('reports',['title'=>$newTitle],'id',$id);
  	echo json_encode($this->system->get_any_column('path','reports','id',$id)->path);
  }

   function edit_bulletin_template(){
  	$newTitle = $this->input->post('newTitle');
  	$id = $this->input->post('id');

  	$edit = $this->system->update_data('templates',['title'=>$newTitle],'id',$id);
  	echo json_encode($this->system->get_any_column('path','templates','id',$id)->path);
  }

  function delete_bulletin_file($id)
  {
  	$msg = "";

  	$path = $_SERVER['DOCUMENT_ROOT'].'/portal'.'/temp/bulletin-files/'.$this->system->get_any_column('path', 'reports', 'id', base64_decode($id))->path;

  	unlink($path);

  	$delete = $this->system->delete_data('reports', 'id', base64_decode($id));

  	if ($delete) {
  		$msg = "File successfully deleted";
  		 redirect('malariabulletin/'.$msg);
  		
  	}
  	else {
  		$msg = "Something went wrong when deleting the file, please try again.";
  		//  redirect('malariabulletin/'.$msg);
  		 redirect('malariabulletin/'.$msg);
  	}

  }

  function delete_bulletin_template_file($id)
  {
  	$msg = "";

  	$path = $_SERVER['DOCUMENT_ROOT'].'/portal'.'/temp/bulletin-template-file/'.$this->system->get_any_column('path', 'templates', 'id', base64_decode($id))->path;

  	unlink($path);

  	$delete = $this->system->delete_data('templates', 'id', base64_decode($id));

  	if ($delete) {
  		$msg = "File successfully deleted";
  		 redirect('malariabulletin/'.$msg);
  		
  	}
  	else {
  		$msg = "Something went wrong when deleting the file, please try again.";
  		 redirect('malariabulletin/'.$msg);
  	}

  }



 }
