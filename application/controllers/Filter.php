<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include_once (dirname(__FILE__) . "/Main.php");

class Filter extends Main {
	public function __construct()  {
		parent::__construct();
		$this->load->helper('url','html', 'new');
		$this->load->model("system");
		$this->load->helper('file');
		$this->load->library('session');
	}

function getRegion()
{
	$result = [];
	$regionFile = $_SERVER['DOCUMENT_ROOT'].'/malariadashboard'.'/temp'.'/regionTemp.json';
	if (file_exists($regionFile)) 
	{
		$fh = fopen($regionFile, 'r');
		$file_created_time = strtotime(date("H:i:s",filemtime($regionFile)));
		$current_time = strtotime(date("H:i:s"));
		$interval = abs($current_time - $file_created_time);
		$minutes = round($interval / 60);

		if ($minutes>45)
		{
			fclose($fh);
			unlink($regionFile);
		}
		else
		{	
			$filecnt = file_get_contents($regionFile);
			$filejsn = json_decode($filecnt, true);
			foreach ($filejsn as $key => $value)
			{
				array_push($result,[
					'id' => $value['id'],
					'displayName' =>$value['displayName']
				]);
			}
			
		}
	}
// if there is no regionTemp.json file below function will search the API and create one
	else
	{
		$link = 'https://hmis.mohz.go.tz/api/organisationUnits?filter=level:eq:2&paging=false';
		
		$resdec = Main::get_anything_From_api($link);

			foreach ($resdec['organisationUnits'] as $key => $value)
			{
				array_push($result,[
					'id' => $value['id'],
					'displayName' =>$value['displayName']
				]);
			}
			$json = json_encode($result);
			$fh = fopen($regionFile, 'w');
			fwrite($fh, $json);
			fclose($fh);	
	}
	return $result;	
}

function getDistrict()
{
	$result = [];
	$districtFile = $_SERVER['DOCUMENT_ROOT'].'/malariadashboard'.'/temp'.'/districtTemp.json';
	if (file_exists($districtFile)) 
	{
		$fh = fopen($districtFile, 'r');
		$file_created_time = strtotime(date("H:i:s",filemtime($districtFile)));
		$current_time = strtotime(date("H:i:s"));
		$interval = abs($current_time - $file_created_time);
		$minutes = round($interval / 60);

		if ($minutes>45)
		{
			fclose($fh);
			unlink($districtFile);
		}
		else
		{	
			$filecnt = file_get_contents($districtFile);
			$filejsn = json_decode($filecnt, true);
			foreach ($filejsn as $key => $value)
			{
				array_push($result,[
					'id' => $value['id'],
					'name' =>$value['name'],
					'parent' =>$value['parent']
				]);
			}
			
		}
	}
// if there is no districtTemp.json file below function will search the API and create one
	else
	{
		$link = 'https://hmis.mohz.go.tz/api/organisationUnits?filter=level:eq:3&paging=false&fields=id,level,name,parent,coordinates,path';
		
		$resdec = Main::get_anything_From_api($link);

			foreach ($resdec['organisationUnits'] as $key => $value)
			{
				array_push($result,[
					'id' => $value['id'],
					'name' =>$value['name'],
					'parent' => $value['parent']['id']
				]);
			}
			$json = json_encode($result);
			$fh = fopen($districtFile, 'w');
			fwrite($fh, $json);
			fclose($fh);
	}
return $result;
}


function getShehia()
{
	$result = [];
	$districtFile = $_SERVER['DOCUMENT_ROOT'].'/malariadashboard'.'/temp'.'/shehiaTemp.json';
	if (file_exists($districtFile)) 
	{
		$fh = fopen($districtFile, 'r');
		$file_created_time = strtotime(date("H:i:s",filemtime($districtFile)));
		$current_time = strtotime(date("H:i:s"));
		$interval = abs($current_time - $file_created_time);
		$minutes = round($interval / 60);

		if ($minutes>45)
		{
			fclose($fh);
			unlink($districtFile);
		}
		else
		{	
			$filecnt = file_get_contents($districtFile);
			$filejsn = json_decode($filecnt, true);
			foreach ($filejsn as $key => $value)
			{
				array_push($result,[
					'id' => $value['id'],
					'name' =>$value['name'],
					'parent' =>$value['parent']
				]);
			}
			
		}
	}
// if there is no districtTemp.json file below function will search the API and create one
	else
	{
		$link = 'https://hmis.mohz.go.tz/api/organisationUnits?filter=level:eq:5&paging=false&fields=id,level,name,parent,coordinates,path';
		
		$resdec = Main::get_anything_From_api($link);

			foreach ($resdec['organisationUnits'] as $key => $value)
			{
				array_push($result,[
					'id' => $value['id'],
					'name' =>$value['name'],
					'parent' => $value['parent']['id']
				]);
			}
			$json = json_encode($result);
			$fh = fopen($districtFile, 'w');
			fwrite($fh, $json);
			fclose($fh);
	}
return $result;
}



// month type goes here


function getPeriodType()
{
	$result = [];
	$periodTypeFile = $_SERVER['DOCUMENT_ROOT'].'/malariadashboard'.'/temp'.'/monthTypeTemp.json';
	if (file_exists($periodTypeFile)) 
	{
		$fh = fopen($periodTypeFile, 'r');
		$file_created_time = strtotime(date("H:i:s",filemtime($periodTypeFile)));
		$current_time = strtotime(date("H:i:s"));
		$interval = abs($current_time - $file_created_time);
		$minutes = round($interval / 60);

		if ($minutes>45)
		{
			fclose($fh);
			unlink($periodTypeFile);
		}
		else
		{	
			$filecnt = file_get_contents($periodTypeFile);
			$filejsn = json_decode($filecnt, true);
			foreach ($filejsn as $key => $value)
			{
				array_push($result,[
					'id' => $value['id'],
					'name' =>$value['name'],
				]);
			}
			
		}
	}
// if there is no districtTemp.json file below function will search the API and create one
	else
	{
		// if the file not exist
	}
return $result;
}


function getExtendedPeriodType()
{

	$result = [];
	$periodTypeFile = $_SERVER['DOCUMENT_ROOT'].'/malariadashboard'.'/temp'.'/monthExtendedTypeTemp.json';
	if (file_exists($periodTypeFile)) 
	{
		$fh = fopen($periodTypeFile, 'r');
		$file_created_time = strtotime(date("H:i:s",filemtime($periodTypeFile)));
		$current_time = strtotime(date("H:i:s"));
		$interval = abs($current_time - $file_created_time);
		$minutes = round($interval / 60);

		if ($minutes>45)
		{
			fclose($fh);
			unlink($periodTypeFile);
		}
		else
		{	
			$filecnt = file_get_contents($periodTypeFile);
			$filejsn = json_decode($filecnt, true);
			foreach ($filejsn as $key => $value)
			{
				array_push($result,[
					'id' => $value['id'],
					'name' =>$value['name'],
				]);
			}
			
		}
	}
// if there is no districtTemp.json file below function will search the API and create one
	else
	{
		// if the file not exist
	}
return $result;
}


// month type ends here


function getClinic()
{
	$result = [];
	$clinicFile = $_SERVER['DOCUMENT_ROOT'].'/malariadashboard'.'/temp'.'/clinicTemp.json';
	if (file_exists($clinicFile)) 
	{
		$fh = fopen($clinicFile, 'r');
		$file_created_time = strtotime(date("H:i:s",filemtime($clinicFile)));
		$current_time = strtotime(date("H:i:s"));
		$interval = abs($current_time - $file_created_time);
		$minutes = round($interval / 60);

		if ($minutes>45)
		{
			fclose($fh);
			unlink($clinicFile);
		}
		else
		{	
			$filecnt = file_get_contents($clinicFile);
			$filejsn = json_decode($filecnt, true);
			foreach ($filejsn as $key => $value)
			{
				array_push($result,[
					'id' => $value['id'],
					'name' =>$value['name'],
					'parent' =>$value['parent']
				]);
			}
		}
	}
// if there is no clinicTemp.json file below function will search the API and create one
	else
	{
		$link = 'https://hmis.mohz.go.tz/api/organisationUnits?filter=level:eq:4&paging=false&fields=id,level,name,parent,coordinates,path';
		
		$resdec = Main::get_anything_From_api($link);

			foreach ($resdec['organisationUnits'] as $key => $value)
			{
				array_push($result,[
					'id' => $value['id'],
					'name' =>$value['name'],
					'parent' => $value['parent']['id']
				]);
			}
			$json = json_encode($result);
			$fh = fopen($clinicFile, 'w');
			fwrite($fh, $json);
			fclose($fh);
	}		
	return $result;
}

function filteredDistrict(){

if(isset($_POST['region'])){
	$district = [];
	foreach($this->getDistrict() as $key =>$value){
		if ($_POST['region'] === $value['parent']){
			array_push($district,$value);
		 }
		 if($_POST['region'] === 'UNSNiNqkzEM') {
		 	array_push($district,$value);
		 }
	}
 
}
 echo json_encode($district);
}


function filteredClinic(){

if(isset($_POST['district'])){
	$clinic = [];
	foreach($this->getClinic() as $key =>$value){
		if($_POST['district'] === $value['parent']){
			array_push($clinic, $value);
		}
		 if($_POST['district'] === 'LEVEL-3') {
		 	array_push($clinic,$value);
		 }
	}
	
}
echo json_encode($clinic);
}


function get_Organization_Group()
{
	$orgGroupFile =  $_SERVER['DOCUMENT_ROOT'].'/malariadashboard'.'/temp'.'/orgGroupTemp.json';
	$link = 'https://hmis.mohz.go.tz/api/organisationUnitGroups?paging=false';

		if (file_exists($orgGroupFile))
		{
			$fh = fopen($orgGroupFile, 'r');
			$file_created_time = strtotime(date("H:i:s",filemtime($orgGroupFile)));
			$current_time = strtotime(date("H:i:s"));
			$interval = abs($current_time - $file_created_time);
			$minutes = round($interval / 60);

			if ($minutes>45)
			{
				fclose($fh);
				unlink($orgGroupFile);
				$result = Main::get_api('organisationUnitGroups', $orgGroupFile);
			}
			else
			{	
				$filecnt = file_get_contents($orgGroupFile);
				$result = json_decode($filecnt, true);
			}
		}
		else
		{
			$result = Main::get_api('organisationUnitGroups', $orgGroupFile);
		}
		echo json_encode($result);	
}

function get_organization_level()
{
	$orgLevelFile =  $_SERVER['DOCUMENT_ROOT'].'/malariadashboard'.'/temp'.'/orgLevelTemp.json';

		if (file_exists($orgLevelFile))
		{
			$fh = fopen($orgLevelFile, 'r');
			$file_created_time = strtotime(date("H:i:s",filemtime($orgLevelFile)));
			$current_time = strtotime(date("H:i:s"));
			$interval = abs($current_time - $file_created_time);
			$minutes = round($interval / 60);

			if ($minutes>45)
			{
				fclose($fh);
				unlink($orgLevelFile);
				$result = Main::get_api('organisationUnitLevels', $orgLevelFile);
			}
			else
			{	
				$filecnt = file_get_contents($orgLevelFile);
				$result = json_decode($filecnt, true);
			}
		}
		else
		{
			$result = Main::get_api('organisationUnitLevels', $orgLevelFile);
			
		}
		echo json_encode($result);	
}


function getPeriodSubType()
{
	
	$result = [];
	$periodTypeFile = $_SERVER['DOCUMENT_ROOT'].'/malariadashboard'.'/temp'.'/monthSubTypesTemp.json';

	if (file_exists($periodTypeFile)) 
	{

		
		$fh = fopen($periodTypeFile, 'r');
		$file_created_time = strtotime(date("H:i:s",filemtime($periodTypeFile)));
		$current_time = strtotime(date("H:i:s"));
		$interval = abs($current_time - $file_created_time);
		$minutes = round($interval / 60);

	
			$filecnt = file_get_contents($periodTypeFile);
			$filejsn = json_decode($filecnt, true);
			foreach ($filejsn as $key => $value)
			{
				array_push($result,[
					'id' => $value['id'],
					'name' =>$value['name'],
					'parent' =>$value['parent'],

				]);


			}	
		
	}
// if there is no districtTemp.json file below function will search the API and create one
	else
	{
		// if the file not exist
	}

return $result;
}

function sub_period_type(){

	if(isset($_POST['periodType'])){
		$subPeriodTypes = [];
		foreach($this->getPeriodSubType() as $key =>$value){

			if(!empty($value['id'])){
				if ($_POST['periodType'] === $value['parent']){
					array_push($subPeriodTypes,$value);
				}
			}
		}
	echo json_encode($subPeriodTypes);
	}

// sub period ends here

		
// return false;
	
	}
// end sub category in month type

// global filter
public function global_period_filter(){
	
		//display visuualization 
		$response=array();
		$filtervisid = $this->security->xss_clean($this->input->post('filtervisid'));
		$filtertabid = $this->security->xss_clean($this->input->post('filtertabid'));
		$applications = $this->system->get_all_with('applications', 'tab_id', $filtertabid);
		$selected_regionsNames= $this->security->xss_clean($this->input->post('selected_regionsNames'));
		$selected_districsNames= $this->security->xss_clean($this->input->post('selected_districsNames'));

		$selected_clinicsNames= $this->security->xss_clean($this->input->post('selected_clinicsNames'));
		$response['applications'] = $applications;
		$tmp_indicator='';
		$all_data =[];
		$y_data_array=[];
		$x_data=[];
		$row_dimensions=0;
		$ou=[];
		$pe=[];
		$x_data_id=[];
		$og_units=[];

		if($filtervisid != 'general'){
			$visualizers = $this->system->get_all_with('visualizers','id',$filtervisid);
			$response['visualizers'] = $visualizers;
			}
			else{

			$visualizers = $this->system->get_all_with('visualizers','tab_id',$filtertabid);

			$response['visualizers'] = $visualizers;

			}

		foreach($visualizers as $visual){
			$res_conf = $this->system->get_all_with('response', 'vis_id', $visual->id);
			$response['indicators'][$visual->id] =$res_conf;
			$response['items'][$visual->id]['title'] =$visual->title;

			$relative_period = $this->security->xss_clean($this->input->post('relative_period'));

			$fixed_period = $this->security->xss_clean($this->input->post('fixed_period'));
					
			$selected_clinics = $this->security->xss_clean($this->input->post('selected_clinics'));
			$selected_regions = $this->security->xss_clean($this->input->post('selected_regions'));
			$selected_districs = $this->security->xss_clean($this->input->post('selected_districs'));
			$orggroups = $this->security->xss_clean($this->input->post('orggroups'));
			$orglevels = $this->security->xss_clean($this->input->post('orglevels'));
			$decc = json_decode($visual->dimensions);


			$orgUnit = Main::get_filtered_organization_unit($selected_clinics, $selected_districs, $selected_regions, $orggroups, $orglevels, $decc);

			$ress = $decc->indicators;

			$visual_response=json_decode($visual->response,true);

			if(array_key_exists('organisationUnitLevels',$visual_response))
			{
				if(count($visual_response['organisationUnitLevels'])>0){
					$response['items'][$visual->id]['level']  = $visual_response['organisationUnitLevels'][0];

				}
			}


			if(is_array($selected_regionsNames) ){
				$og_units=array_merge($og_units,$selected_regionsNames );

			}

			if(is_array($selected_districsNames) ){
				$og_units=array_merge($selected_districsNames, $og_units);
			}

			if(is_array($selected_clinicsNames) ){
				$og_units=array_merge( $selected_clinics, $og_units);
			}

			if(empty($og_units) ){
				$og_units[]='Zanzibar';
			}

			$periods = Main::get_trimmed_period($relative_period, $fixed_period, $decc);

			$period_array=explode(";",$periods);

			foreach ($res_conf as $res) {

				$res=$res;
			}
				

			$indicator_id_array=[];

			if(strlen($visual->style)<1){

				$style_data['container']='';
				$style_data['style']='width:620px; height:400px';
				$style_data['translate']='';
				$visual->style=json_encode($style_data);

			}
		

			if($visual_response['type']=='YEAR_OVER_YEAR_LINE' || $visual_response['type']=='YEAR_OVER_YEAR_COLUMN'){

				$response=$this->get_yearly_series_data_filter($response,$visual,$orgUnit,$period_array,$ress,$og_units);

			}

			elseif($visual->chart_type>2){
				$api_data = Main::get_visualization_data($periods, $ress, $orgUnit);
				$api_data  = json_decode($api_data, true );

				$response=Main::get_mcn_data($response,$visual_response,$api_data,$visual,$res);

				if(array_key_exists('rows',$api_data)){
					$response['rows_count']=count($api_data ['rows']);			
				}
				else{
					$response['rows_count']='';		
					}				
			}


		else {
			$api_data = Main::get_visualization_data_hierarchy($periods, $ress, $orgUnit);
			$api_data  = json_decode($api_data, true );

			$response=Main::get_msdqi_data($api_data,$response,$visual,$period_array,$og_units,$orgUnit);

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


function get_yearly_series_data_filter($response,$visual,$orgUnit,$period_array,$indicators,$og_units){

		$visual_response=json_decode($visual->response,true);

		$filter='';

		$relative_periods= Main::concatinate_string($period_array);

		$yearly_series=Main::concatinate_string($visual_response['yearlySeries']);

		$link='https://hmis.mohz.go.tz/api/32/analytics.json?dimension=pe:'.$yearly_series.'&dimension=dx:'.$indicators.'&skipData=true&skipMeta=false&includeMetadataDetails=false';

		$vis_details=Main::get_anything_From_api($link);

		$years=$vis_details['metaData']['dimensions']['pe'];

		$indicator_id=$vis_details['metaData']['dimensions']['dx'];

		foreach($indicator_id as $indicator){

			if(strlen($filter)>0){

				$filter=$filter.' - ';
			}

			$filter=$filter.$vis_details['metaData']['items'][$indicator]['name'];

		}

		foreach(array_unique($og_units) as $ou){
			if(strlen($ou)>1){
				if(strlen($filter)>0){
					$filter=$filter.' - ';
				}
				$filter=$filter. $ou;
			}
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


		$api_response=Main::get_anything_From_api($link)['rows'];

		$table_row['year']=$year;


		foreach($api_response as $rows){

			$y_data[]=intval($rows[2]);

			$date=Main::format_date($rows[1]);
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

		$chart_details=Main::chart_display_options($visual_response['type']);

		$response['items'][$visual->id]['chart_type']= $chart_details['type'];
		$response['items'][$visual->id]['chart_options']= $chart_details['option'];
		$response['items'][$visual->id]['axis_label']= '';


		  if(array_key_exists('rangeAxisLabel',$visual_response)){
            			$response['items'][$visual->id]['axis_label']= $visual_response['rangeAxisLabel'];
            		}

		return $response;

	}



}
