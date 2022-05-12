<?php

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
		$curl = curl_init();
		$uname = 'coconut';
		$pass = 'Coconut@2019';

		curl_setopt_array($curl,[
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_USERPWD => $uname.':'.$pass ,
		CURLOPT_URL => 'https://hmis.mohz.go.tz/api/organisationUnits?filter=level:eq:2&paging=false',
		CURLOPT_USERAGENT => 'DHIS api',
		CURLOPT_USERAGENT => 'DHIS api'
		]);
		$response = curl_exec($curl);
		curl_close($curl);
		$resdec = json_decode($response, true);

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
		$curl = curl_init();
		$uname = 'coconut';
		$pass = 'Coconut@2019';

		curl_setopt_array($curl,[
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_USERPWD => $uname.':'.$pass ,
		CURLOPT_URL => 'https://hmis.mohz.go.tz/api/organisationUnits?filter=level:eq:3&paging=false&fields=id,level,name,parent,coordinates,path',
		CURLOPT_USERAGENT => 'DHIS api'
		]);
		$response = curl_exec($curl);
		curl_close($curl);
		$resdec = json_decode($response, true);

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
		$curl = curl_init();
		$uname = 'coconut';
		$pass = 'Coconut@2019';

		curl_setopt_array($curl,[
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_USERPWD => $uname.':'.$pass ,
		CURLOPT_URL => 'https://hmis.mohz.go.tz/api/organisationUnits?filter=level:eq:4&paging=false&fields=id,level,name,parent,coordinates,path',
		CURLOPT_USERAGENT => 'DHIS api'
		]);
		$response = curl_exec($curl);
		curl_close($curl);
		$resdec = json_decode($response, true);

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


// month type goes here


function getPeriodType()
{
	// echo "am here";
	// return false;

	$result = [];
	$periodTypeFile = $_SERVER['DOCUMENT_ROOT'].'/malariadashboard'.'/temp'.'/monthTypeTemp.json';
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



// extended types

function getExtendedPeriodType()
{
	// echo "am here";
	// return false;

	$result = [];
	$periodTypeFile = $_SERVER['DOCUMENT_ROOT'].'/malariadashboard'.'/temp'.'/monthExtendedTypeTemp.json';
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



if(isset($_POST['region'])){
	$district = [];
	foreach(getDistrict() as $key =>$value){
		if ($_POST['region'] === $value['parent']){
			array_push($district,$value);
		 }
		 if($_POST['region'] === 'UNSNiNqkzEM') {
		 	array_push($district,$value);
		 }
	}
  echo json_encode($district);
}

if(isset($_POST['district'])){
	$clinic = [];
	foreach(getClinic() as $key =>$value){
		if($_POST['district'] === $value['parent']){
			array_push($clinic, $value);
		}
		 if($_POST['district'] === 'UNSNiNqkzEM') {
		 	array_push($clinic,$value);
		 }
	}
	echo json_encode($clinic);
}
 
?>