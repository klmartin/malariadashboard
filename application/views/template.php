
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Dashboard Portal</title>
		<link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico') ?>">
		<link href="<?php echo base_url('assets/fonts/fontawesome.5.3.1/css/all.css') ?>" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
		
		<link href="<?php echo base_url('/assets/css/hummingbird-treeview.css'); ?>" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/custom/period.css') ?>" />
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
		<script src="<?php echo base_url('assets/js/custom/specific_filter.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/custom/period_filter_view.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/custom/visualizers.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/custom/containers.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/custom/edit_containers.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/custom/empty_visualizer.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/custom/update_visualizer.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/custom/map.js') ?>"></script>
		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script><!-- scripts for the datepicker in the dashboard filter -->
		<!-- scripts dependancies -->
		<link rel="stylesheet" href="<?php echo base_url('/assets/css/daterangepicker.css'); ?>">
		<script src="<?php echo base_url('/assets/js/moment.js'); ?>"></script>
		<script src="<?php echo base_url('/assets/js/multiselect.js'); ?>"></script>
		<script src="<?php echo base_url('/assets/js/hummingbird-treeview.js'); ?>"></script>
		<script src="<?php echo base_url('/assets/js/knockout.js'); ?>"></script>
		<script src="<?php echo base_url('/assets/js/daterangepicker.js'); ?>"></script>

		<script src="<?php echo base_url('/assets/js/shim.min.js'); ?>"></script>
		<script src="<?php echo base_url('/assets/js/xlsx.full.min.js'); ?>"></script>
		

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
		<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
		  	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/gridstack/dist/gridstack-extra.min.css') ?>"rel="stylesheet">
	  <script src="<?php echo base_url('/assets/gridstack/dist/gridstack-h5.js') ?>"></script> 
	  	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/gridstack/dist/gridstack.min.css') ?>"f rel="stylesheet">


 	<!-- end map -->
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<!-- <script src="<?php echo base_url('/assets/js/exporting.js'); ?>" ></script> -->
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script src="https://code.highcharts.com/modules/offline-exporting.js"></script>
		<!-- <script src="https://highcharts.github.io/export-csv/export-csv.js"></script> -->
		<script src="https://code.highcharts.com/modules/export-data.js"></script>
		
		<link rel="stylesheet" href="<?php echo base_url('/assets/css/tabulator.min.css'); ?>" >
		<script src="<?php echo base_url('/assets/js/tabulator.min.js'); ?>"></script>
		<link rel="stylesheet" href="<?php echo base_url('/assets/css/custom.css'); ?>" >
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>


       <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700|Open+Sans:300,400,600" rel="stylesheet">
    <!-- Include Leaflet -->
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>
    <link href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" rel="stylesheet">
    <!-- Include CARTO.js -->
    <script src="https://libs.cartocdn.com/carto.js/v4.2.0/carto.min.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.2/jspdf.plugin.autotable.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://carto.com/developers/carto-js/examples/maps/public/style.css" rel="stylesheet">

  <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/gridster/dist/jquery.gridster.css') ?>" rel="stylesheet"> -->

   <!-- <script src="<?php echo base_url('/assets/gridster/jquery.gridster.min.js'); ?>"></script> -->
	<!-- <script src="<?php echo base_url('bower_components/gridster/dist/jquery.gridster.min.js') ?>"></script> -->
	 <!-- <script src="<?php echo base_url('/assets/js/custom/gridster.js'); ?>"></script> -->
	
		<!-- <script src="<?php echo base_url('bower_components/gridster/dist/jquery.gridster.js') ?>"></script> -->

<!-- 		<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/gridster/jquery.gridster.min.css') ?>"rel="stylesheet">
	  <script src="<?php echo base_url('/assets/gridster/jquery.gridster.min.js') ?>"></script>  -->


	



    <!-- Make sure you put this AFTER Leaflet's CSS -->
<!--  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>

   <script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.0.5/jspdf.plugin.autotable.js"></script> -->

		<!-- map -->
		<!-- <script src="https://code.highcharts.com/maps/highmaps.js"></script> -->
		<!-- <script src="https://code.highcharts.com/maps/modules/exporting.js"></script> -->
		<!-- <script src="https://code.highcharts.com/mapdata/countries/tz/tz-all.js"></script> -->
		<style>
			* {
			box-sizing: border-box;
			}
			#container {
			height: 500px; 
			min-width: 310px; 
			max-width: 800px; 
			margin: 0 auto; 
			}
			.loading {
			margin-top: 10em;
			text-align: center;
			color: gray;
			}
			.tabulator{
			/*font-size: 10px;*/
			}
			/* Float four columns side by side */
			.column {
			float: left;
			width: 25%;
			padding: 0 10px;
			}
			/* Remove extra left and right margins, due to padding */
			.row {
			margin: 0 -5px;
			}
			/* Clear floats after the columns */
			.row:after {
			content: "";
			display: table;
			clear: both;
			}
			/* Responsive columns */
			@media screen and (max-width: 600px) {
			.column {
			width: 100%;
			display: block;
			margin-bottom: 20px;
			}
			}
			.iconic { 
			border-style: solid;
			padding: 10px;
			border-width: 0.5px;
			}


				.iconic_chart { 
			/*border-style: solid;*/
			padding: 10px;
			border-width: 0.5px;
			color: #2a6dad;
			font-size: 12px;

			}

			.gridster .gs-w {

				background-color: white;
				box-shadow: 0 0 0px rgb(0 0 0 / 30%);

			}

/*			.sticky-top {
    position: -webkit-sticky;
    position: sticky;
    top: 0;
    z-index: 2020;
}*/
			.chartcard{
			/*   margin-top: 40px;
			box-shadow: -11px -5px 49px -8px rgba(9, 9, 16, 0.4);
			padding-bottom:30px;
			padding-top:30px;*/
			}

			.chart-dropdown{
				border-radius: 4px;
				padding:0px;
				height: 23px;
				width: 38px;
			}
			.chartheader{
			height: 30px;
			padding-top: 5px;
			padding-bottom: 5px;
			/*background-color:inherit;*/
			font-size: 10px;
			padding: 4px;
			}
			.card {
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
			padding: 16px;
			background-color: #f1f1f1;
			}
			#container {
			height: 500px; 
			min-width: 310px; 
			max-width: 800px; 
			margin: 0 auto; 
			}
			.loading {
			margin-top: 10em;
			text-align: center;
			color: gray;
			}

/*			.draggable {

				position: relative;

			}*/

		</style>
		<style>
			body {
			margin: 0;
			font-family: Arial, Helvetica, sans-serif;
			background-color:#f4f6f8;
			}
			.app-item{
			font-size: 8px;
			width: 30px;
			/*height:30px;*/
			align-items: center;
			padding: 0px;
			color: black;
			overflow: unset;
			}
			.app-item-container{
			font-size: 14px;
			width: 25px;
			align-items: center;
			padding: 0px;
			color: #eaeaea;
			}
			.topnav {
			/*overflow: hidden;*/
			background-color: rgb(44, 102, 147);
			display: flex;
			flex-direction: row;
			-webkit-box-align: center;
			align-items: center;
			height: 48px;
			border-bottom: 1px solid rgba(32, 32, 32, 0.15);
			color: rgb(255, 255, 255);
			}
			.topnav a {
			/*float: right;*/
			color: #f2f2f2;
			text-align: center;
			padding: 1px 5px;
			text-decoration: none;
			font-size: 15px;
			box-sizing: inherit;
			font-family: Roboto, sans-serif;
			/*overflow: hidden;*/
			text-overflow: ellipsis;
			font-weight: 500;
			letter-spacing: 0.01em;
			white-space: nowrap;
			}
			.topnav a.active {
			/*background-color: #04AA6D;*/
			/*color: white;*/
			box-sizing: inherit;
			font-family: Roboto, sans-serif;
			}

			
			.single_values{
				border-radius: 3px;
			background-color: white;
		/*	height: 130px;
			margin-top: 5px;
			margin-bottom: 1px;*/
			padding-top: 1px;
            padding-left: 3px;
			padding-bottom: 5px;
			box-shadow: 0 0 3px 0 #999;
/*			height: max-content;
			overflow-x: auto;
			overflow-y: hidden;
			display: flex;
			flex-wrap: revert;*/
			/*margin: inherit;*/
			/*margin-left:-8px;*/
			}

/*
			.grid-stack-item-content{
				overflow:hidden; !important
				
			}*/

			.grid-stack > .grid-stack-item > .grid-stack-item-content{
   left: 3px;
   right: 3px;
}


.grid-stack > .grid-stack-item > .grid-stack-item-content {
left: 4px !important;
right: 4px !important;
top: 4px !important;
bottom: 4px !important;
}
			/*
			.single_data_{
			background-color: #f4f6f8;
			height: 130px;
			width: 270px;
			margin-top: 5px;
			margin-bottom: 5px;
			padding-top: 1px;
			padding-bottom: 5px;
			height: max-content;
			overflow-x: auto;
			overflow-y: hidden;
			display: flex;
			flex-wrap: revert;
			/*margin: inherit;*/
			margin-left:-8px;
			}*/
			.title-bar{
			background-color: inherit;
			/*height: 130px;*/
			margin-top: 3px;
			margin-bottom: 10px;
			padding-top: 1px;
			padding-bottom: 5px;
			height: max-content;
			overflow-x: auto;
			overflow-y: hidden;
			display: flex;
			flex-wrap: revert;
			/*margin: inherit;*/
			margin-left:-21px;
			}
			.single_value_inner{
			border-color: rgb(213, 221, 229);
			overflow: hidden !important;
			height: inherit;
			width: inherit;
			font-size: 13px;
			}
			.single_value_outer{
			box-shadow: 0 0 3px 0 #999;
			background-color: #fff;
			height: 130px;
			width: 254px;
			/*     margin-top: 10px;
			margin-bottom: 5px;*/
			padding: 3px;
			border-radius: 3px;
			margin: 7px;
			flex: 0 0 10%;
			max-width: 100%;
			padding: 1px;
			}
			/* Style the tab */
			.tab {
			/*overflow: hidden;*/
			border: 1px solid #ccc0;
			background-color: #ffffff;
			height: 85px;
    		box-shadow: inherit;			}
			a {
			color: rgb(44, 102, 147);
			}
			/* Style the buttons that are used to open the tab content */
			.tablinks {
			display: inline-flex;
			background-color: inherit;
			float: left;
			border: none;
			outline: none;
			cursor: pointer;
			padding: 10px 10px;
			transition: 0.3s;
			display: inline-flex;
			-moz-box-align: center;
			align-items: center;
			height: 32px;
			margin: 4px;
			border-radius: 16px;
			background-color: rgb(243, 245, 247);
			font-size: 14px;
			font-weight:500;
			line-height: 16px;
			cursor: pointer;
			user-select: none;
			color: rgb(33, 41, 52);
			margin-top: 13px;
			margin-bottom: 8px;
			}
			.addbtn {
			display: inline-flex;
			background-color: inherit;
			float: left;
			border: none;
			outline: none;
			cursor: pointer;
			padding: 10px 10px;
			transition: 0.3s;
			display: inline-flex;
			-moz-box-align: center;
			align-items: center;
			height: 32px;
			margin: 4px;
			border-radius: 16px;
			background-color:#00796b;
			font-size: 14px;
			font-weight:500;
			line-height: 16px;
			cursor: pointer;
			user-select: none;
			color: rgb(33, 41, 52);
			margin-top: 13px;
			margin-bottom: 8px;
			}
			.tabsearch {
			display: inline-flex;
			background-color: inherit;
			float: left;
			border-color:  rgb(243, 245, 247);
			border-top: none;
			border-left: none;
			border-right: none;
			outline: none;
			cursor: text;
			padding: 10px 10px;
			transition: 0.3s;
			display: inline-flex;
			-moz-box-align: center;
			align-items: center;
			height: 32px;
			margin: 4px;
			font-size: 14px;
			font-weight:500;
			line-height: 16px;
			user-select: none;
			color: rgb(33, 41, 52);
			margin-top: 13px;
			margin-bottom: 8px;
			}
			/* Change background color of buttons on hover */
			/*    .dashlinks :hover {
			background-color: green;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
			padding-left: 16px;
			padding-right: 22px;
			/* width: 100px; */
			}*/
			/* Create an active/current tablink class */
			.tab button.active {
			background-color:green;
			color:white;
			padding: 16px;
			/* width: 100px; */
			}
			/* Style the tab content */
			.home-header{
			font-size: 12px;
			/*background-color:green;*/
			}
			table, th, td {
			border: 1px solid black;
			}
			.center {
			margin: auto;
			width: 10%;
			padding: 10px;
			}
			.dashlinks{
			background-color:  #2c6693;
			float: left;
			border: 1px;
			outline: none;
			cursor: pointer;
			padding: 9px 22px;
			transition: 0.3s;
			display: inline-flex;
			-moz-box-align: center;
			align-items: center;
			height: 22px;
			margin: 4px;
			border-radius: 18px;
			background-color: #2c6693;
			font-size: 12px;
			line-height: 16px;
			cursor: pointer;
			user-select: none;
			color: rgb(33, 41, 52);
			margin-top: 12px;
			margin-bottom: 8px;
			}
			a .dashlinks{
			color: :white;
			}
			/* making the page more attractive */
			/* dashboard */
			.home-header{
			font-weight:700;
			}
			.dashboard-header{
			font-weight:600;
			text-transform: capitalize;
			}
			a .dashboard-card-links {
			font-weight:600;
			font-size: medium;
			text-decoration:none;
			}
			.card{
			border: 0px solid rgba(0,0,0,.125);
			background-color: white;
			box-shadow: 0 12px 49px -8px rgb(9 9 16 / 20%);
			}
			.tabcontent {
			/*display: none;*/
			/* padding: 6px 12px;
			border: 1px solid #ccc;
			border-top: none;*/
			background-color:#f4f6f8;
			margin-top: -10px;
			border: 1px solid #ccc0;
			}
			/* adding dashboard */
			/* tabs lists */
			.table td, .table th {
			border-top: 0px solid #dee2e6;
			}
			table, th, td {
			border: 1px solid #6aecc059;
			}
			/* all */
			.container .row{    
			height: 300px;
			/*margin-top: 2em;*/
			min-width: 380px;
			background-color: white;
			}
			.chart-container{    
			background-color: white;
			/*margin-top: 2em;*/
			box-shadow: 0 0 3px 0 #999;
			border-radius: 8px;
			/* width: 100%;
			height: 100%*/
			/*min-width: 380px;*/
			}

			.tabulator{

				background-color: white;
			}
			.chart-menu{
			margin-top:1%; 
			margin-left: 2px;
			margin-bottom:1%;
			}
			.iconic-links{
			padding: 3px;
			padding-left: 10px;

			}
			.iconic-links:hover {

	    background-color: #00000000;

		}

			.dropbtn {
			display: inline-flex;
			position: relative;
			-webkit-box-align: center;
			align-items: center;
			-webkit-box-pack: center;
			justify-content: center;
			border-radius: 4px;
			font-weight: 400;
			letter-spacing: 0.5px;
			text-decoration: none;
			cursor: pointer;
			transition: all 0.15s cubic-bezier(0.4, 0, 0.6, 1) 0s;
			user-select: none;
			color: rgb(33, 41, 52);
			padding: 0px 12px;
			font-size: 14px;
			line-height: 16px;
			height: 36px;
			width: 97px;
			border: 1px solid rgb(160, 173, 186);
			background-color: white;
			padding-right: 2px
			}
			.highcharts-container {
			font-size: 100px;
			height: 100%;
			width: 100%;
			position: relative;
			padding-top: 1px;
			}

			.dropdown-menu{


			}
			.dropdown button{
			/*   height: 20px;
			padding-bottom: 1px;
			border-radius: 4px;
			border: 1px solid rgb(160, 173, 186);
			text-decoration:none;
			padding-top: 1px;
			background-color: #FFF;
			width: 100px;
			font-size: 15px;
			color: #1a1a1a;"*/
			}
			.dropdown-content {
			position: absolute;
			background-color: #f6f6f6;
			min-width: 230px;
			overflow: hidden;
			border: 1px solid #ddd;
			z-index: 1;
			}
			.apps-dropdown{
			background-color: white;
			min-width: 283px
			}
			.options-dropdown{
			background-color: white;
			min-width: 283px;
			z-index: 10000;
			position: absolute;
			top: 50px;
			right: -6px;
			width: 310px;
			border-top: 4px solid transparent;
			}
			.options-card{
				display: inline-block;
				position: relative;
				width: 100%;
				height: 100%;
				border-radius: 3px;
				background: rgb(255, 255, 255) none repeat scroll 0% 0%;
				box-shadow: rgba(64, 75, 90, 0.2) 0px 0px 1px 0px, rgba(64, 75, 90, 0.28) 0px 2px 1px 0px;
			}drop
			.optionsul{
				padding: 0px;
				margin: 0px;

			}
			.optionsli{
				position: relative;
				height: 48px;
				padding: 0px;
				cursor: pointer;
				list-style: outside none none;

			}
			.optionsat{
				height: 100%;
				padding: 0px 24px;
				text-decoration: none;
				display: flex;
				flex-direction: row;
				-moz-box-align: center;
				align-items: center;
			}
			.optionslabel{
				color: rgb(33, 41, 52);
				font-size: 15px;
				white-space: nowrap;
				overflow: hidden;
				text-overflow: ellipsis;
				user-select: none;
				padding-right: 12px;
			}
			.jsx-2224778647{
				fill: rgb(74, 87, 104);
				cursor: pointer;
				height: 24px;
				width: 24px;
			}
			.apps-dropdown a{
			padding: 4px;
			}
			::-webkit-scrollbar {
			width: 0.5em;
			height: 0.5em
			}
			::-webkit-scrollbar-button {
			background: #888
			}
			::-webkit-scrollbar-track-piece {
			background: #ccc
			}
			::-webkit-scrollbar-thumb {
			background: #888
			}
			.btn-primary {
			color: #fff;
			background-color: #2c6693;
			border-color: #007bff;
			}

		.btn-link:hover {
		    /*color: #0056b3;*/
/*		    text-decoration: underline;
*/		    background-color: #888888d1;
		    /*border-color: transparent;*/
		}
		

				.btn-link:hover {
	
		    background-color: #f3f5f7;
		    border-color: #888888d1;
		}

		.dropdown{

			cursor: pointer;
		}


		.ng{
			padding: 0px 20px;
			text-align: center;
			color: #666;
			font-weight: 500;
			cursor: pointer;
			display: inline-block;
			letter-spacing: 0;
			outline: none;
			/*transition: all .2s ease-in-out;*/
			/*white-space: nowrap;*/
	    /*border-width: 1px;*/
	    /*border-style: groove;*/
	    /*border-color: rgb(44, 102, 147);*/
	    /*border-image: darkturquoise;*/
	    border-radius: 25px;
	    margin: 1px;

		}

		.layout-item{
			background-color: #fff;
			padding: 7px;
			font-size: 14px;
			height: auto;
			margin: 4px;
			border-radius: 3px;
			box-shadow: 1px 1px 1px rgba(0,0,0,.2);
			cursor: move;
			cursor: -webkit-grab;
			cursor: grab;
			display: -ms-flexbox;
			display: flex;
			-ms-flex-align: center;
			align-items: center;
		}

		.dhis2loader{
			
		border-radius: 50%;
		cursor: progress;
		display: inline-block;
		overflow: hidden;
		position: absolute;
		transition: all 200ms ease-out 0s;
		vertical-align: top;
		top: 50%;
		left: 50%;
		margin-top: -16px;
		margin-left: -16px;
		height: 32px;
		width: 32px;
		z-index: 4;
		border-width: 2px;
		border-style: solid;
		border-color: rgb(223, 112, 31) rgba(97, 97, 97, 0.29) rgba(97, 97, 97, 0.29);
		mix-blend-mode: difference;
		-webkit-animation:spin 4s linear infinite;
    	-moz-animation:spin 4s linear infinite;
    	animation:spin 0.7s linear 0s  infinite;

		}

		@-moz-keyframes spin { 
    		100% { -moz-transform: rotate(360deg); } 
		}
		@-webkit-keyframes spin { 
		    100% { -webkit-transform: rotate(360deg); } 
		}
		@keyframes spin { 
		    100% { 
		        -webkit-transform: rotate(360deg); 
		        transform:rotate(360deg); 
		    } 
		}

		.content{
		font-size: 14px;
	   /* cursor: move;
	    cursor: -webkit-grab;*/
	    cursor: grab;
}
		.content-image{
			height: 13px;		
		}
		.tab{
			display: flow-root;
			width: 100%;
			width: -moz-available;
		}
		.showLess{
			height:85px;
		}
		.showMore{
			height: unset;

		}

		.legend {
		    line-height: 18px;
		    color: #555;
		    background-color: white;
		    padding: 10px;
		    border-radius: 10px;
			}
		.legend i {
			    width: 18px;height: 18px;float: left; margin-right: 8px; opacity: 0.7;
			}


.legend-table{

	background-color:white;
	margin-left:15px;
	margin-bottom:15px;
	margin-top:5px

	}


	.legend-table td{

		border-color: white;
	}





	/*for gridster*/

/*	.demo {
  margin: 3em 0;
  padding: 7.5em 0 5.5em;
  background: #26941f;
}
.demo:hover .gridster {
  margin: 0 auto;
  opacity: .8;
  -webkit-transition: opacity .6s;
  -moz-transition: opacity .6s;
  -o-transition: opacity .6s;
  -ms-transition: opacity .6s;
  transition: opacity .6s;
}*/
.content {
  color: white;
}

.controls {
  margin-bottom: 20px;
}

button:focus {
     outline: 0px dotted; 
     outline: 0px  ; 
}
li.jsx-2880366133 {
    position: relative;
    height: 48px;
    padding: 0px;
    cursor: pointer;
    list-style: outside none none;
}
.link.jsx-2880366133 {
    height: 100%;
    padding: 0px 24px;
    text-decoration: none;
    display: flex;
    flex-direction: row;
    -moz-box-align: center;
    align-items: center;
}
svg.jsx-2224778647 {
    fill: rgb(74, 87, 104);
    cursor: pointer;
    height: 24px;
    width: 24px;
}
li.jsx-2880366133 div.label.jsx-2880366133:not(:first-child) {
    margin-left: 8px;
}
.label.jsx-2880366133 {
    color: rgb(33, 41, 52);
    font-size: 15px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    user-select: none;
    padding-right: 12px;
}

.nav {
      border-bottom: 1px solid rgba(0,0,0,.12)
    }



/* addition */


.search-hover {
  border: 1px solid #ccc;
  outline: none;
  background-size: 22px;
  background-position: 13px;
  border-radius: 10px;
  width: 50px;
  height: 25px;
  padding: 12px;
  transition: all 0.5s;
}
.search-hover:hover {
  width: 300px;
  padding-left: 50px;
}
   @media screen and (min-width: 676px) {
      .modal-dialog {
        max-width: 600px;
        /* New width for default modal */
      }
    }

    .scrollable{
  overflow-y: auto;
  max-height: 70px;
}


.modal-backdrop {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: #42343494;
}

	.dropdown a:hover {background-color: #ddd;}

.dashboard_link a:hover {
        background-color: #00000000;
        }
		.comment_p{
			color: #5f5a5a;
			background: #fdfbff;
		}

		.comment_avatar{
		padding: 10px;
		padding-top: 10px;
		padding-left: 10px;	
		border-radius: 50%;
		padding-top: 8px;
		padding-left: 6px;
		font-size: 15px;
		border: 2px solid #ddd;
		color: #9e9e9e;
		margin-right: 7px;
				}
				.comment_avatar_2{
					padding: 10px;
    padding-top: 10px;
    padding-left: 10px;
border-radius: 50%;
padding-top: 8px;
padding-left: 6px;
font-size: 15px;
border: 2px solid #ddd;
color: #9e9e9e;
margin-right: 7px;
height: 42px;
margin-top: 13px;
margin-left: 6px;	}

	a.jsx-200270532 {
    position: relative;
    margin: 10px 10px 0px 0px;
    cursor: pointer;
}
svg.jsx-255544020 {
    fill: rgb(255, 255, 255);
    cursor: pointer;
    height: 24px;
    width: 24px;
}
div.jsx-1265754857 {
    position: relative;
    width: 24px;
    height: 30px;
    margin: 8px 0px 0px;
}
a.jsx-1265754857 {
    display: block;
}
div.jsx-1500177125 {
    user-select: none;
    display: flex;
    flex-direction: row;
    -moz-box-align: center;
    align-items: center;
}


		</style>
	</head>
	<body>

	<nav id="navbar_top" class=" sticky-top" style="width: 100%;top: 0px;box-shadow: 0 1px 1px -8px rgba(9, 9, 16, .2);">
		<div class="topnav">
			<div class="col-md-12" style="margin:auto">
				<div class="float-left">
					<a style="float:left ;padding:10px" href="<?php echo base_url('home'); ?>"> <img style="width: 28px;height: 25px;" src="<?php echo base_url('/assets/icon.png'); ?>"></img> </a>
					<a style="padding:10px;float:left;padding-left:1px;">Zanzibar Health Management Information System</a>
				</div>
				<div class="float-right">
				
						<!-- <a onclick=" showOptions() " style="float:right;width: 36px;height: 36px;margin: 5px 5px 0px 5px;"> <i style="display: flex;-moz-box-align: center;align-items: center;-moz-box-pack: center;justify-content: center;width: 36px;height: 36px;overflow: hidden;border-radius: 50%;background-color: rgba(0, 0, 0, 0.3);color: rgb(255, 255, 255);cursor: pointer;" aria-hidden="true"><?php echo $_SESSION['displayName'] ?></i> </a>

						<div id="dropdown3" class="dropdown-content options-dropdown">
							<div class="options-card"></div>
							<ul class="optionsul">

								<li data-test="dhis2-uicore-menuitem" class="jsx-2880366133 jsx-2908761452">
									<a href="https://docs.dhis2.org/master/en/user/html/dhis2_user_manual_en.html" class="jsx-2880366133 link">
										<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" class="jsx-2224778647"><path d="M0 0h48v48H0z" fill="none"></path>
											<path d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm2 34h-4v-4h4v4zm4.13-15.49l-1.79 1.84C26.9 25.79 26 27 26 30h-4v-1c0-2.21.9-4.21 2.34-5.66l2.49-2.52C27.55 20.1 28 19.1 28 18c0-2.21-1.79-4-4-4s-4 1.79-4 4h-4c0-4.42 3.58-8 8-8s8 3.58 8 8c0 1.76-.71 3.35-1.87 4.51z"></path>
										</svg>
										<div class="jsx-2880366133 label">Help</div>
									</a>
								</li>

								<li data-test="dhis2-uicore-menuitem" class="jsx-2880366133 jsx-2908761452">
									<a href="../dhis-web-user-profile/#/aboutPage" class="jsx-2880366133 link">
										<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" class="jsx-2224778647">
											<path d="M0 0h48v48H0z" fill="none"></path>
											<path d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm2 30h-4V22h4v12zm0-16h-4v-4h4v4z"></path>
										</svg>
										<div class="jsx-2880366133 label">About DHIS2</div>
									</a>
								</li>

								<li data-test="dhis2-uicore-menuitem" class="jsx-2880366133 jsx-2908761452">
									<a href=" <?php echo base_url('https://hmis.mohz.go.tz/dhis-web-commons-security/logout.action') ?> " class="jsx-2880366133 link">
										<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" class="jsx-2224778647">
											<path d="M0 0h48v48H0z" fill="none">	
											</path>
											<path d="M20.17 31.17L23 34l10-10-10-10-2.83 2.83L25.34 22H6v4h19.34l-5.17 5.17zM38 6H10c-2.21 0-4 1.79-4 4v8h4v-8h28v28H10v-8H6v8c0 2.21 1.79 4 4 4h28c2.21 0 4-1.79 4-4V10c0-2.21-1.79-4-4-4z">
												
											</path>
										</svg>
										<div class="jsx-2880366133 label">Logout</div>
									</a>
								</li>

							</ul>
						</div> -->


				                 <div class="dropdown dashboard_link"  style="float:right">
        <!--  //                    <button  style="box-shadow: 0 12px 39px -8px rgba(9, 9, 16, .2);" class="chart-dropdown dropbtn btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" style="color:#888888" aria-hidden="true"></i>
			  				</button> -->

			  				<!-- <button   style="float:right" data-toggle="dropdown" class="chart-dropdown btn btn-link "><i class="fa fa-ellipsis-h" style="color:#888888" aria-hidden="true"></i></button>  -->

			  				 <a onclick=" showOptions() " style="float:right" data-toggle="dropdown"  style="float:right;width: 36px;height: 36px;margin: 5px 5px 0px 5px;"> <i style="display: flex;-moz-box-align: center;align-items: center;-moz-box-pack: center;justify-content: center;width: 36px;height: 36px;overflow: hidden;border-radius: 50%;background-color: rgba(0, 0, 0, 0.3);color: rgb(255, 255, 255);cursor: pointer;margin-top:4px;" aria-hidden="true"><?php echo $_SESSION['displayName'] ?></i> </a>

			  				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
						   <ul class="optionsul" style="padding-inline-start: 1px;">

								<li data-test="dhis2-uicore-menuitem" class="jsx-2880366133 jsx-2908761452">
									<a href="https://docs.dhis2.org/master/en/user/html/dhis2_user_manual_en.html" class="jsx-2880366133 link">
										<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" class="jsx-2224778647"><path d="M0 0h48v48H0z" fill="none"></path>
											<path d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm2 34h-4v-4h4v4zm4.13-15.49l-1.79 1.84C26.9 25.79 26 27 26 30h-4v-1c0-2.21.9-4.21 2.34-5.66l2.49-2.52C27.55 20.1 28 19.1 28 18c0-2.21-1.79-4-4-4s-4 1.79-4 4h-4c0-4.42 3.58-8 8-8s8 3.58 8 8c0 1.76-.71 3.35-1.87 4.51z"></path>
										</svg>
										<div class="jsx-2880366133 label">Help</div>
									</a>
								</li>

								<li data-test="dhis2-uicore-menuitem" class="jsx-2880366133 jsx-2908761452">
									<a href="../dhis-web-user-profile/#/aboutPage" class="jsx-2880366133 link">
										<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" class="jsx-2224778647">
											<path d="M0 0h48v48H0z" fill="none"></path>
											<path d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm2 30h-4V22h4v12zm0-16h-4v-4h4v4z"></path>
										</svg>
										<div class="jsx-2880366133 label">About DHIS2</div>
									</a>
								</li>

								<li data-test="dhis2-uicore-menuitem" class="jsx-2880366133 jsx-2908761452">
									<a href="https://hmis.mohz.go.tz/dhis-web-commons/security/login.action" class="jsx-2880366133 link">
										<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" class="jsx-2224778647">
											<path d="M0 0h48v48H0z" fill="none">	
											</path>
											<path d="M20.17 31.17L23 34l10-10-10-10-2.83 2.83L25.34 22H6v4h19.34l-5.17 5.17zM38 6H10c-2.21 0-4 1.79-4 4v8h4v-8h28v28H10v-8H6v8c0 2.21 1.79 4 4 4h28c2.21 0 4-1.79 4-4V10c0-2.21-1.79-4-4-4z">
												
											</path>
										</svg>
										<div class="jsx-2880366133 label">Logout</div>
									</a>
								</li>

							</ul>
							</div>
                      </div>


				            </div>
				      		


					<a  style="float:right; font-size: 18px; font-weight:50;padding: 10px" href="<?php echo base_url('home'); ?>"></i> <svg fill="#ffffff" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 50 50" width="22px" height="22px">    <path d="M 25 1.0507812 C 24.7825 1.0507812 24.565859 1.1197656 24.380859 1.2597656 L 1.3808594 19.210938 C 0.95085938 19.550938 0.8709375 20.179141 1.2109375 20.619141 C 1.5509375 21.049141 2.1791406 21.129062 2.6191406 20.789062 L 4 19.710938 L 4 46 C 4 46.55 4.45 47 5 47 L 19 47 L 19 29 L 31 29 L 31 47 L 45 47 C 45.55 47 46 46.55 46 46 L 46 19.710938 L 47.380859 20.789062 C 47.570859 20.929063 47.78 21 48 21 C 48.3 21 48.589063 20.869141 48.789062 20.619141 C 49.129063 20.179141 49.049141 19.550938 48.619141 19.210938 L 25.619141 1.2597656 C 25.434141 1.1197656 25.2175 1.0507812 25 1.0507812 z M 35 5 L 35 6.0507812 L 41 10.730469 L 41 5 L 35 5 z"/></svg></a>
					
					

	          <div class="dropdown 	dashboard_link"  style="float:right" >

  				<a style="float:right; font-size: 18px;position: relative;width: 24px;height: 30px;" data-test="headerbar-apps-icon" class="jsx-200270532" data-toggle="dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" class="jsx-255544020"><path d="M8 16h8V8H8v8zm12 24h8v-8h-8v8zM8 40h8v-8H8v8zm0-12h8v-8H8v8zm12 0h8v-8h-8v8zM32 8v8h8V8h-8zm-12 8h8V8h-8v8zm12 12h8v-8h-8v8zm0 12h8v-8h-8v8z"></path><path d="M0 0h48v48H0z" fill="none"></path></svg></a>

  				<div id="myDropdown2" class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" >
			 	<div class="col-md-12">
				<div class="row" style="width: 359px;">
					<div class="col-md-12" style="padding: 10px;">

						<input class="DashAppsInput" type="text" placeholder="Search apps" id="myInput" style="box-sizing: border-box;font-size: 14px;line-height: 16px;user-select: text;color: rgb(33, 41, 52);    background-color: white;padding: 12px 11px 10px;outline: currentcolor none 0px;border: 1px solid rgb(160, 173, 186);border-radius: 3px;box-shadow: rgba(48, 54, 60, 0.1) 0px 1px 2px 0px inset;text-overflow: ellipsis;" onkeyup="appfilterFunction()">
					</div>

                      <div class="col-md-12" style="display: contents;">
                                <div class="col-md-3 dashapps">
                                  <a href="https://hmis.mohz.go.tz/dhis-web-pivot/index.html" class="">
                                    <img src="<?php echo base_url('/assets/images/dhis-web-pivot.png')?>" alt="app logo" class="app-item">
                                  </a>
                                  <div class="" style="color: black;text-align: center;font-size: x-small;font-weight: 386;font-family: Roboto,sans-serif;">Pivot Table</div>
                                </div>
                                <div class="col-md-3 dashapps">
                                  <a href="https://hmis.mohz.go.tz/dhis-web-event-reports/index.html" class="">
                                    <img src="<?php echo base_url('/assets/images/dhis-web-event-reports.png')?>" alt="app logo" class="app-item">
                                  </a>
                                  <div class="" style="color: black;text-align: center;font-size: x-small;font-weight: 386;font-family: Roboto,sans-serif;">Event Reports</div>
                                </div>
                                <div class="col-md-3 dashapps">
                                  <a href="https://hmis.mohz.go.tz/dhis-web-event-visualizer/index.html" class="">
                                    <img src="<?php echo base_url('/assets/images/dhis-web-event-visualizer.png')?>" alt="app logo" class="app-item">
                                  </a>
                                  <div class="" style="color: black;text-align: center;font-size: x-small;font-weight: 386;font-family: Roboto,sans-serif;">Event Visualizer</div>
                                </div>
                                <div class="col-md-3 dashapps">
                                  <a href="https://hmis.mohz.go.tz/dhis-web-dataentry/index.action" class="">
                                    <img src="<?php echo base_url('/assets/images/dhis-web-dataentry.png')?>" alt="app logo" class="app-item">
                                  </a>
                                  <div class="" style="color: black;text-align: center;font-size: x-small;font-weight: 386;font-family: Roboto,sans-serif;">Data Entry</div>
                                </div>
                                <div class="col-md-3 dashapps">
                                  <a href="https://hmis.mohz.go.tz/dhis-web-dashboard/index.html" class="">
                                    <img src="<?php echo base_url('/assets/images/dhis-web-dashboard.png')?>" alt="app logo" class="app-item">
                                  </a>
                                  <div class="" style="color: black;text-align: center;font-size: x-small;font-weight: 386;font-family: Roboto,sans-serif;">Dashboard</div>
                                </div>
                                <div class="col-md-3 dashapps">
                                  <a href="https://hmis.mohz.go.tz/dhis-web-cache-cleaner/index.html" class="">
                                    <img src="<?php echo base_url('/assets/images/dhis-web-cache-cleaner.png')?>" alt="app logo" class="app-item">
                                  </a>
                                  <div class="" style="color: black;text-align: center;font-size: x-small;font-weight: 386;font-family: Roboto,sans-serif;">Browser Cache Cleaner</div>
                                </div>
                                <div class="col-md-3 dashapps">
                                  <a href="https://hmis.mohz.go.tz/dhis-web-capture/index.html" class="">
                                    <img src="<?php echo base_url('/assets/images/dhis-web-capture.png')?>" alt="app logo" class="app-item">
                                  </a>
                                  <div class="" style="color: black;text-align: center;font-size: x-small;font-weight: 386;font-family: Roboto,sans-serif;">Capture</div>
                                </div>
                                <div class="col-md-3 dashapps">
                                  <a href="https://hmis.mohz.go.tz/dhis-web-data-quality/index.html" class="">
                                    <img src="<?php echo base_url('/assets/images/dhis-web-data-quality.png')?>" alt="app logo" class="app-item">
                                  </a>
                                  <div class="" style="color: black;text-align: center;font-size: x-small;font-weight: 386;font-family: Roboto,sans-serif;">Data Quality</div>
                                </div>
                                <div class="col-md-3 dashapps">
                                  <a href="https://hmis.mohz.go.tz/dhis-web-data-visualizer/index.html" class="">
                                    <img src="<?php echo base_url('/assets/images/dhis-web-data-visualizer.png')?>" alt="app logo" class="app-item">
                                  </a>
                                  <div class="" style="color: black;text-align: center;font-size: x-small;font-weight: 386;font-family: Roboto,sans-serif;">Data Visualizer</div>
                                </div>
                                <div class="col-md-3 dashapps">
                                  <a href="https://hmis.mohz.go.tz/dhis-web-import-export/index.html" class="">
                                    <img src="<?php echo base_url('/assets/images/dhis-web-import-export.png')?>" alt="app logo" class="app-item">
                                  </a>
                                  <div class="" style="color: black;text-align: center;font-size: x-small;font-weight: 386;font-family: Roboto,sans-serif;">Import/Export</div>
                                </div>
                                <div class="col-md-3 dashapps">
                                  <a href="https://hmis.mohz.go.tz/dhis-web-import-export/index.html" class="">
                                    <img src="<?php echo base_url('/assets/images/dhis-web-interpretation.png')?>" alt="app logo" class="app-item">
                                  </a>
                                  <div class="" style="color: black;text-align: center;font-size: x-small;font-weight: 386;font-family: Roboto,sans-serif;">Interpretations</div>
                                </div>
                                <div class="col-md-3 dashapps">
                                  <a href="https://hmis.mohz.go.tz/dhis-web-maps/index.html" class="">
                                    <img src="<?php echo base_url('/assets/images/dhis-web-maps.png')?>" alt="app logo" class="app-item">
                                  </a>
                                  <div class="" style="color: black;text-align: center;font-size: x-small;font-weight: 386;font-family: Roboto,sans-serif;">Maps</div>
                                </div>
                                <div class="col-md-3 dashapps">
                                  <a href="https://hmis.mohz.go.tz/dhis-web-menu-management/index.html" class="">
                                    <img src="<?php echo base_url('/assets/images/dhis-web-menu-management.png')?>" alt="app logo" class="app-item">
                                  </a>
                                  <div class="" style="color: black;text-align: center;font-size: x-small;font-weight: 386;font-family: Roboto,sans-serif;">Menu Management</div>
                                </div>
                                <div class="col-md-3 dashapps">
                                  <a href="https://hmis.mohz.go.tz/dhis-web-reports/index.html" class="">
                                    <img src="<?php echo base_url('/assets/images/dhis-web-reports.png')?>" alt="app logo" class="app-item">
                                  </a>
                                  <div class="" style="color: black;text-align: center;font-size: x-small;font-weight: 386;font-family: Roboto,sans-serif;">Reports</div>
                                </div>
                                <div class="col-md-3 dashapps">
                                  <a href="https://hmis.mohz.go.tz/api/apps/Interactive-Dashboard-2/index.html" class="">
                                    <img src="<?php echo base_url('/assets/images/icon-48x48.png')?>" alt="app logo" class="app-item">
                                  </a>
                                  <div class="" style="color: black;text-align: center;font-size: x-small;font-weight: 386;font-family: Roboto,sans-serif;">Interactive Dashboard 2</div>
                                </div>
                                <div class="col-md-3 dashapps ">
                                  <a href="https://hmis.mohz.go.tz/api/apps/LLIN-Quartely-Report/index.html" class="">
                                    <img src="<?php echo base_url('/assets/images/dhis-web-reports.png')?>" alt="app logo" class="app-item">
                                  </a>
                                  <div class="" style="color: black;text-align: center;font-size: x-small;font-weight: 386;font-family: Roboto,sans-serif;">LLIN Quartely Report</div>
                                </div>
                                <div class="col-md-3 dashapps">
                                </div>

                          </div>								
							</div>
							</div>
                      </div>

                  </div>


				            
					<a style="float:right; font-size: 18px;" href="https://hmis.mohz.go.tz/dhis-web-messaging" data-test="headerbar-messages" class="jsx-200270532 interpretation"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" class="jsx-255544020"><path d="M40 8H8c-2.21 0-3.98 1.79-3.98 4L4 36c0 2.21 1.79 4 4 4h32c2.21 0 4-1.79 4-4V12c0-2.21-1.79-4-4-4zm0 8L24 26 8 16v-4l16 10 16-10v4z"></path><path d="M0 0h48v48H0z" fill="none"></path></svg></a>
					<a style="float:right; font-size: 18px;" href="https://hmis.mohz.go.tz/dhis-web-interpretation" data-test="headerbar-interpretations" class="jsx-200270532 message"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" class="jsx-255544020"><path d="M40 4H8C5.79 4 4.02 5.79 4.02 8L4 44l8-8h28c2.21 0 4-1.79 4-4V8c0-2.21-1.79-4-4-4zm-4 24H12v-4h24v4zm0-6H12v-4h24v4zm0-6H12v-4h24v4z"></path><path d="M0 0h48v48H0z" fill="none"></path></svg></a>

			
			</div>
		</div>
		<?php
			if ((isset($tabs)) || (isset($dashboards))) { ?>


		<div  class="tab" style="overflow: hidden;">
  
			 <?php if (isset($dashboards)) { ?>

  				<ul class="nav" style="display: flex;padding: 0;margin: 0;width: 100%;overflow: auto;">

				  <?php foreach ($dashboards as $dash) : ?>


			  <li id="<?php echo $dash->id?>" class="nav-item ng active">
			  	<?php if ($dash->status ==1) { ?> 

			  		 <a href="<?php echo base_url('malariabulletin') ?>" class="nav-link " id="bulletin" href="#"><?php echo $dash->name ?></a>

			  		 <?php } else {  ?>

			    <a href="<?php echo base_url('view/dashboard/' . base64_encode($dash->id)) ?>" class="nav-link " id="link<?php echo $dash->id?>" href="#"><?php echo $dash->name ?></a>

			      <?php  }  ?>
			  </li>
				<?php endforeach;
				  
				  ?>
			</ul>
  				
  			<?php } ?>

  				 <?php if (isset($tabs)) { ?>
  
			<button class="addbtn btn_1"  >
			<a  href="<?php echo base_url('create/tab/'. base64_encode($dash_id)) ?>"> <i  style="color:white;" class="fa fa-plus" ></i></a>
			</button>    
			<input type="text" placeholder="Search Tabs" id='searchTab' class="tabsearch" onkeyup="tabfilterFunction()">
			<div id='tablist'>
				<?php foreach ($tabs as $tab) : ?>
				<button  class="tablinks btn_" id="btn<?php echo $tab->id; ?>"  onclick="openTab(event, '<?php echo $tab->id; ?>')">
				<a><?php echo $tab->name; ?></a>
				</button>
			
				<?php endforeach; ?>																					
			</div>

		</div>
		
		<p id="show_more_btn"  onclick="show_tab_more()" style="margin-top: 0;box-shadow: rgb(0 0 0 / 30%) 0px 5px 5px;
margin-bottom: 1rem;border: 1px solid #ccc0;background-color: #ffffff;text-align: center;cursor: pointer;margin-bottom: -24px;"><span>show more</span></p>

			
		<?php } ?>


		<?php } ?>
			</nav>
		<div class="col-md-12" style="margin: auto;padding:5px;padding-top: 0px;
			margin-top: 35px;top: 0px;">


			<?php 
				$this->load->view('filterfunctions');
				//  getPeriodType();
				
				   getRegion();
				   getDistrict();
				
				// if (isset($head)) {
				//       echo $head;
				//     } else echo '';
				    ?>
			<!-- <hr> -->
			<?php if ($this->session->flashdata('success')) { ?>
			<div id="closesuccess" class="btn-success" style="margin: 10px;padding: 20px; color: #000000">
				<a href=""  class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Success!</strong> <?php echo $this->session->flashdata('success') ?>
			</div>
			<?php } ?>
			<?php if($this->session->flashdata('error')) { ?>
			<div id="closesuccess" class="btn-danger" style="margin: 10px;padding: 20px;">
				<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error!</strong> <?php echo $this->session->flashdata('error') ?>
			</div>
			<?php } ?>
			<?php if (isset($content) && isset($data)) :  $this->load->view($content, $data);
				else :  $this->load->view($content);
				endif;  ?>



				
		</div>
		<script>


			/* When the user clicks on the button,
			toggle between hiding and showing the dropdown content */
			function myFunction(id) {
			  
			  document.getElementById('myDropdown'+id).classList.toggle("show");
			  // $('myDropdown').addClass('show')
			}
			
			function myApplications() {
			  
			  document.getElementById("myDropdown2").classList.toggle("show");
			}

			function showOptions(){

				document.getElementById("dropdown3").classList.toggle("show");
			}

			
			
			function appfilterFunction() {
			  var input, filter, ul, li, a, i;
			  input = document.getElementById("myInput");
			  filter = input.value.toUpperCase();
			  div = document.getElementById("myDropdown2");
			  //we have to get elements by className and not <a> tags
			  dashapps = div.getElementsByClassName("dashapps");
			  for (i = 0; i < dashapps.length; i++) {
			    txtValue = dashapps[i].textContent || dashapps[i].innerText;
			    if (txtValue.toUpperCase().indexOf(filter) > -1) {
			      dashapps[i].style.display = "";
			    } else {
			      dashapps[i].style.display = "none";
			    }
			  }
			}
			
			
			function tabfilterFunction() {
			  var input, filter, ul, li, a, i;
			  input = document.getElementById("searchTab");
			  filter = input.value.toUpperCase();
			  div = document.getElementById("tablist");
			  button = div.getElementsByTagName("button");
			  for (i = 0; i < button.length; i++) {
			    a = div.getElementsByTagName("a");
			    txtValue = a[i].textContent || a[i].innerText;
			    if (txtValue.toUpperCase().indexOf(filter) > -1) {
			      button[i].style.display = "";
			    } else {
			      button[i].style.display = "none";
			    }
			  }
			}

			function show_tab_more(){
				if($('#show_more_btn').text() == 'show more'){
					$('#show_more_btn').text('show less')
					$('.tab').removeClass('showLess');
					$('.tab').addClass('showMore');
				}else if($('#show_more_btn').text() == 'show less'){
					$('#show_more_btn').text('show more')					
					$('.tab').addClass('showLess');
					$('.tab').removeClass('showMore');
				}
				
			}
		</script>
		<!-- <div id="dashcontent" style="width:100%;height:100%"></div> -->
	</body>
</html>

