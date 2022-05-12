<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct()  {
		parent::__construct();
		$this->load->helper('url','html', 'new');
		$this->load->model("system");
		$this->load->helper('file');
		$this->load->library('session');
	}



	public function show_tab_data()
	{
		// $ids = base64_decode($id);
		// return 

		$id = $this->security->xss_clean($this->input->post('tab_id'));
        
		// return $id;
		// $this->data['dashboard'] = $this->system->get_any_row('dashboards','id',$ids);
		// $this->data['head'] = $this->system->get_any_row('dashboards','id',$ids)->name;
		$data = $this->system->get_all_with_asy('comments','tab_id',$id);
		// $this->data['content'] = 'dashboard';
    	
		// return json_encode('');
		// return response(['data'=>$data['tabs']]);
		echo json_encode($data);
	
	
	}


	public function index()
	{	
		$_SESSION["last_tab"] = "";
		$this->data['head'] = 'Home';
		$this->data['dashboards'] = $this->system->get_all('dashboards');
		$this->data['content'] = 'all_dashboards';
    	$this->load->view('template', $this->data);
	}

	public function add_dashboard()
	{	$this->data['head'] = 'Add Dashboard';
		$this->data['content'] = 'new_dashboard';
    	$this->load->view('template', $this->data);
	}

	public function create_dash(){
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
		redirect('home');
		//$data = $this->security->xss_clean($data);
	}

	public function edit_dash($id){
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

		redirect('view/dashboard/'.$id);
	}

	public function delete_dash($id){
		$ids = base64_decode($id);
		$dashboard = $this->system->get_any_row('dashboards','id',$ids);
		if($this->security->xss_clean($this->input->post('name'))== $dashboard->name){
			$this->system->delete_data('dashboards','id',$ids);
			$this->system->delete_data('dashboard_tabs','dash_id',$ids);
		}else{
		}
		redirect('home');
	}

	public function view_dash($id){
		$ids = base64_decode($id);

		$this->data['dashboard'] = $this->system->get_any_row('dashboards','id',$ids);
		$this->data['head'] = $this->system->get_any_row('dashboards','id',$ids)->name;
		$this->data['tabs'] = $this->system->get_all_with('dashboard_tabs','dash_id',$this->system->get_any_row('dashboards','id',$ids)->id);
		$this->data['content'] = 'dashboard';
    	$this->load->view('template', $this->data);
	}

	public function delete_tab($id){
		
		$delete_tab = $this->system->delete_data('dashboard_tabs','id',$id);
		
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

		redirect('view/dashboard/'.base64_encode($dash_id));
	}

	public function visualizer($id){
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

	public function add_vis(){
		$name = $this->security->xss_clean($this->input->post('title'));
		$desc = $this->security->xss_clean($this->input->post('subtitle'));
		$dashid = $this->security->xss_clean($this->input->post('dash_id'));
		$tabid = $this->security->xss_clean($this->input->post('tab_id'));
		$elementid = $this->security->xss_clean($this->input->post('elementid'));
		// $chart_type = $this->security->xss_clean($this->input->post('chart_type'));
		$chart_type =3;
		$response = $this->get_visualizations_response($elementid);

		$res = "";
		$periods = "";
		$arrayy = (json_decode($response, true));

		foreach ($arrayy['dataDimensionItems'] as $key =>  $value)
		{
			$res=$res.$value['indicator']['id'].';';
		}
		foreach ($arrayy['periods'] as $key =>  $value)
		{
			$periods=$periods.$value['id'].';';
		}

		$visIndi = $this->get_visualization_data($periods, $res);

		$data =[
			'title'=>$name,
			'subtitle'=>$desc,
			'dash_id'=>$dashid,
			'element_id'=>$elementid,
			'response'=>$response,
			'chart_type'=>$chart_type,
			'tab_id'=>$tabid
		];

		$save = $this->system->create_data_returns_id('visualizers',$data);

		$responseData = [
			'response' => $this->get_visualization_data($periods, $res),
			'element_name' => $name,
			'element_id' => $arrayy['id'],
			'vis_id' => $save
		];

		$save_responseData = $this->system->create_data('response', $responseData);

	}

	public function edit_vis($id){

		$res_conf = $this->system->get_all_with('response','vis_id',$id);
		$vis = $this->system->get_any_row('visualizers','id',$id);
		$this->data['response']=$res_conf;
		$this->data['vis']=$vis;
		$this->data['head'] ="Add Indicators to visualizer ".$vis->title;
		$this->data['content'] = 'visualizer';
    	$this->load->view('template', $this->data);

	}

	public function update_vis($id){
		$ids = base64_decode($id);
		$name = $this->security->xss_clean($this->input->post('title'));
		$chart_type = $this->security->xss_clean($this->input->post('chart_type'));
		$data =[
			'title'=>$name,
			'chart_type'=>$chart_type,
		];
		$save = $this->system->update_data('visualizers',$data,'id',$ids);

		if ($save) {
			$this->session->set_flashdata('success', 'Visualizer updated successfully');
		} else {
			$this->session->set_flashdata('error', 'Failed to update visualizer please try again');
		}

		redirect('edit/visualizer/'.$ids);
	}
	

	public function delete_comment($id){
		$delete_comment= $this->system->delete_data('comments','id',$id);	
	}

	
	public function delete_vis($id){
		$ids = base64_decode($id);
		$vis = $this->system->get_any_row('visualizers','id',$ids);
		$dash = $this->system->get_any_row('dashboards','id',$vis->dash_id);
		$dvis= $this->system->delete_data('visualizers','id',$ids);
		$dconf = $this->system->delete_data('response','vis_id',$ids);

		if ($dvis && $dconf ) {
			$this->session->set_flashdata('success', 'Visualizer deleted successfully');
		} else {
			$this->session->set_flashdata('error', 'Failed to delete visualizer please try again');
		}

		redirect('view/dashboard/'.base64_encode($dash->id));

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

		$api_data = [
			'response' => $this->get_filtered_apiii($newStartDay, $newEndDay, $regions, $districts, $clinics, $element_id), 
			//'response' => $this->get_analytics_api($element_id, 2019,"LEVEL-4"),
			'element_name' => $element_name,
			'element_id' => $element_id,
			'vis_id' => $vis_id
		];

		$save_api_data = $this->system->create_data('response',$api_data);

		if ($save_api_data) {
			$this->session->set_flashdata('success', 'Indicator was added successfully');
		} else {
			$this->session->set_flashdata('error', 'Failed to add indicator please try again');
		}

		// $get_multiple_rows = $this->system->get_multiple_rows('response',$element_name, $element_id);


		// echo json_encode($get_multiple_rows);
	}

	public function delete_indicator($id){

		$res_del = $this->system->delete_data('response','id',$id);
		// delete is now done by ajax thus this is commented
		
	}

	//outdated slower function
	public function view_vis(){
		//display visuualization 
		$id = $this->security->xss_clean($this->input->post('id'));
		$response=array();
		$visualizers = $this->system->get_all_with('visualizers','tab_id',$id);
		$applications = $this->system->get_all_with('applications', 'tab_id', $id);
		$response['visualizers'] = $visualizers;
		$response['applications'] = $applications;
		foreach($visualizers as $visual){
			
			$vis_conf = $this->system->get_all_with('response','vis_id',$visual->id);
			$response['indicators'][$visual->id] =$vis_conf;

		}

		foreach($visualizers as $key => $visual){

		$vis_conf = $this->system->get_all_with('response',"vis_id",$visual->id);

		foreach($vis_conf as $conf){
		$api_data = $this->get_analytics_api($conf->element_id, 2019,"LEVEL-4");

		if (array_key_exists('rows', $api_data)) {
			$response['indicator_data'][$visual->id][$conf->id] = $api_data['rows'];
			}
		}
				
	 }
	 
		echo json_encode($response);
	}

	//new and improved function
	function faster_view_vis(){
		//display visuualization 
		$id = $this->security->xss_clean($this->input->post('id'));
		$response=array();
		$visualizers = $this->system->get_all_with('visualizers','tab_id',$id);
		$applications = $this->system->get_all_with('applications', 'tab_id', $id);
		$response['visualizers'] = $visualizers;
		$response['applications'] = $applications;
		foreach($visualizers as $visual){
			//$vis_conf = $this->system->get_all_with('visualization_configs','vis_id',$visual->id);
			$res_conf = $this->system->get_all_with('response', 'vis_id', $visual->id);
			$response['indicators'][$visual->id] =$res_conf;

			foreach ($res_conf as $res) {

				$api_data = json_decode($res->response, true);
				if (array_key_exists('rows', $api_data)) {
					$response['indicator_data'][$visual->id][$res->id] = $api_data['rows'];
					}

				$clinic_name = json_decode($res->response, true);
				if (array_key_exists('metaData', $clinic_name)) {
					$response['items'][$visual->id][$res->id] = $clinic_name['metaData'];
				}
					//else{
					//	$api_data = [];
						//push something to the rows array if there is no Rows from the response
					//}
				}

		}
	 
		echo json_encode($response);
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
		$uname='Cits';
		$pass='Dev3@2021#';

		curl_setopt_array($curl,[
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_USERPWD => $uname.':'.$pass ,
		CURLOPT_URL =>'https://mohzn.go.tz/api/analytics?dimension=dx:'.$indicatorId.';'.$indicatorId.'&dimension=ou:'.$level2.';'.$level3.';'.$level4.'&startDate='.$startDate.'&endDate='.$endDate.'',
		CURLOPT_USERAGENT => 'DHIS api'
		]);
		$responsee = curl_exec($curl);
		curl_close($curl);
		$response = json_decode($responsee, true);
		return $response;
	}

	function get_filtered_apiii($startDate, $endDate, $level2, $level3, $level4, $indicatorId){
		$curl = curl_init();
		$uname='Cits';
		$pass='Dev3@2021#';

		curl_setopt_array($curl,[
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_USERPWD => $uname.':'.$pass ,
		CURLOPT_URL =>'https://mohzn.go.tz/api/analytics?dimension=dx:'.$indicatorId.';'.$indicatorId.'&dimension=ou:'.$level2.';'.$level3.';'.$level4.'&startDate='.$startDate.'&endDate='.$endDate.'',
		CURLOPT_USERAGENT => 'DHIS api'
		]);
		$responsee = curl_exec($curl);
		
		return $responsee;
	}
	
	function get_analytics_api($indicator_id, $year,$level)
	{
		$curl = curl_init();
		$uname='Cits';
		$pass='Dev3@2021#';

		curl_setopt_array($curl,[
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_USERPWD => $uname.':'.$pass ,
		CURLOPT_URL => 'https://mohzn.go.tz/api/analytics?dimension=dx:'.$indicator_id.';'.$indicator_id.'&dimension=pe:'.$year.'&&dimension=ou:'.$level.'',
		CURLOPT_USERAGENT => 'DHIS api'
		]);
		$responsee = curl_exec($curl);
		curl_close($curl);
		return $responsee;
	}

	function get_api($link, $file)
	{
		$result = NULL;
		$curl = curl_init();
		$uname='Cits';
		$pass='Dev3@2021#';

		curl_setopt_array($curl,[
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_USERPWD => $uname.':'.$pass ,
		CURLOPT_URL => 'https://mohzn.go.tz/api/'.$link.'.json?paging=false',
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

    function get_programIndicators()
	{	
		$prgramIndicatorFile =  $_SERVER['DOCUMENT_ROOT'].'/portal'.'/temp'.'/prgramIndicatorTemp.json';

		if (file_exists($prgramIndicatorFile))
		{
			$fh = fopen($prgramIndicatorFile, 'r');
			$file_created_time = strtotime(date("H:i:s",filemtime($prgramIndicatorFile)));
			$current_time = strtotime(date("H:i:s"));
			$interval = abs($current_time - $file_created_time);
			$minutes = round($interval / 60);

			if ($minutes>45)
			{
				fclose($fh);
				unlink($prgramIndicatorFile);
				$result = $this->get_api('programIndicators', $prgramIndicatorFile);
			}
			else
			{	
				$filecnt = file_get_contents($prgramIndicatorFile);
				$result = json_decode($filecnt, true);
				
			}
		}
		else
		{
			$result = $this->get_api('programIndicators', $prgramIndicatorFile);
		}
		//echo $file_created_time, "and ", $current_time, " and ", $interval, "and ",$minutes;
		echo json_encode($result);
	}

	function get_indicators()
	{
		$indicatorFile =  $_SERVER['DOCUMENT_ROOT'].'/portal'.'/temp'.'/indicatorTemp.json';

		if (file_exists($indicatorFile))
		{
			$fh = fopen($indicatorFile, 'r');
			$file_created_time = strtotime(date("H:i:s",filemtime($indicatorFile)));
			$current_time = strtotime(date("H:i:s"));
			$interval = abs($current_time - $file_created_time);
			$minutes = round($interval / 60);

			if ($minutes>45)
			{
				fclose($fh);
				unlink($indicatorFile);
				$result = $this->get_api('indicators', $indicatorFile);
			}
			else
			{	
				$filecnt = file_get_contents($indicatorFile);
				$result = json_decode($filecnt, true);
			}
		}
		else
		{
			$result = $this->get_api('indicators', $indicatorFile);
		}
		echo json_encode($result);		
	}

	function get_dataElements()
	{
		$dataElementFile =  $_SERVER['DOCUMENT_ROOT'].'/portal'.'/temp'.'/dataElementTemp.json';

		if (file_exists($dataElementFile))
		{
			$fh = fopen($dataElementFile, 'r');
			$file_created_time = strtotime(date("H:i:s",filemtime($dataElementFile)));
			$current_time = strtotime(date("H:i:s"));
			$interval = abs($current_time - $file_created_time);
			$minutes = round($interval / 60);

			if ($minutes>45)
			{
				fclose($fh);
				unlink($dataElementFile);
				$result = $this->get_api('dataElements', $dataElementFile);
			}
			else
			{	
				$filecnt = file_get_contents($dataElementFile);
				$result = json_decode($filecnt, true);
			}
		}
		else
		{
			$result = $this->get_api('dataElements', $dataElementFile);
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

			$this->session->set_flashdata('success', 'Comment added successfully');

		}else {
			
			$this->session->set_flashdata('error','Failed to add coment please try again');
		}
		redirect('dashboard');
		$data = $this->security->xss_clean($data);
	}

	public function save_comment_asy(){
		// return "hi";
		$tab_id = $this->security->xss_clean($this->input->post('comment_tab_id'));
		$user_id = $this->security->xss_clean($this->input->post('user_id'));
		$body = $this->security->xss_clean($this->input->post('body'));
		// $created_at = date('d-m-y h:i:s');
		

		$data = [
			'tab_id'=>$tab_id,
			'user_id'=>$user_id,
			'body'=>$body
		];
		$save = $this->system->create_data('comments',$data);

		if ($save) {

			$this->session->set_flashdata('success', 'Comment added successfully');

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
			$save = $this->system->create_data('applications',$data);
			if ($save) {
				$this->session->set_flashdata('success', 'Visualizer added successfully');
			} else {

				$this->session->set_flashdata('error', 'Failed to add visualizer please try again');
			}	
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
		$visualizationFile =  $_SERVER['DOCUMENT_ROOT'].'/portal'.'/temp'.'/visualizationTemp.json';
	
			if (file_exists($visualizationFile))
			{
				$fh = fopen($visualizationFile, 'r');
				$file_created_time = strtotime(date("H:i:s",filemtime($visualizationFile)));
				$current_time = strtotime(date("H:i:s"));
				$interval = abs($current_time - $file_created_time);
				$minutes = round($interval / 60);
	
				if ($minutes>45)
				{
					fclose($fh);
					unlink($visualizationFile);
					$result = $this->get_visualizations_api($visualizationFile);
				}
				else
				{	
					$filecnt = file_get_contents($visualizationFile);
					$result = json_decode($filecnt, true);
				}
			}
			else
			{
				$result = $this->get_visualizations_api($visualizationFile);
			}
			echo json_encode($result);	
	}

	function get_visualizations_api($file)
	{
		$result = NULL;
		$curl = curl_init();
		$uname='Cits';
		$pass='Dev3@2021#';

		curl_setopt_array($curl,[
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_USERPWD => $uname.':'.$pass ,
		CURLOPT_URL => 'https://mohzn.go.tz/api/visualizations.json?paging=false',
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

	function get_visualizations_response($visulId){
		$curl = curl_init();
		$uname='Cits';
		$pass='Dev3@2021#';

		curl_setopt_array($curl,[
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_USERPWD => $uname.':'.$pass ,
		CURLOPT_URL =>'https://mohzn.go.tz/api/visualizations/'.$visulId.'.json?paging=false',
		CURLOPT_USERAGENT => 'DHIS api'
		]);
		
		$responsee = curl_exec($curl);
		return $responsee;
		// return json_decode($responsee,true);
	}

	function get_visualization_data($period, $indicator){
		$curl = curl_init();
		$uname='Cits';
		$pass='Dev3@2021#';

		curl_setopt_array($curl,[
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_USERPWD => $uname.':'.$pass,
		//CURLOPT_URL =>'https://mohzn.go.tz/api/visualizations/'.$visulId.'.json?paging=false',
		CURLOPT_URL =>'https://mohzn.go.tz/api/analytics?dimension=dx:'.$indicator.'&dimension=ou:UNSNiNqkzEM&dimension=pe:'.$period.'',
		CURLOPT_USERAGENT => 'DHIS api'
		]);

		$responsee = curl_exec($curl);
		return $responsee;
	}


 }