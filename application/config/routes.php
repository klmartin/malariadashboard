<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|   example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|   https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|   $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|   $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|   $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples: my-controller/index -> my_controller/index
|       my-controller/my-method -> my_controller/my_method
*/


$route['default_controller'] = 'Auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['home'] = 'main/index';
$route['show_tab_data'] = 'main/show_tab_data';
$route['delete/comment/(:any)'] = 'main/delete_comment/$1';
$route['save_comment_asy'] = 'main/save_comment_asy';
$route['add'] = 'main/add_dashboard';
$route['save_comment'] = 'main/save_comments';

$route['filter/global_period_filter'] = 'filter/global_period_filter';


$route['add/new_dashboard'] = 'main/create_dash';
$route['view/dashboard/(:any)'] = 'main/view_dash/$1';
$route['open/dashboard/(:any)'] = 'main/open_dash/$1';
$route['edit/dash/(:any)'] = 'main/view_edit_dash/$1';
$route['dashboard/home/(:any)'] = 'main/dash_home/$1';
$route['edit/dashboard/(:any)'] = 'main/edit_dash/$1';
$route['delete/dashboard/(:any)'] = 'main/delete_dash/$1';

$route['add/tab'] = 'main/add_tab';
$route['delete/tab/(:any)']['delete'] = 'main/delete_tab/$1';
$route['delete/tabs/(:any)'] = 'main/delete_tabs/$1';
$route['edit/tab/(:any)'] = 'main/edit_tab/$1';
$route['update/style'] = 'main/update_style/';
$route['create/tab/(:any)'] = 'main/create_tab/$1';
$route['new/tab'] = 'main/create_new_tab';

// Report route
$route['new/report'] = 'main/new_report';

$route['add/visualizer/(:any)'] = 'main/visualizer/$1';
$route['import/visualizer/(:any)'] = 'main/import_visualizer/$1';
//for slower visualizers uncomment the following line and comment the line after that
//$route['view/visualizers'] = 'main/view_vis';
$route['view/visualizers'] = 'main/faster_view_vis';
$route['create/visualizer'] = 'main/add_vis';
$route['load/visualizers'] = 'main/load_vis_data';

$route['create/normalvisualizer'] = 'main/add_normal_vis';
$route['delete/visualizer/(:any)'] = 'main/delete_vis/$1';
$route['edit/visualizer/(:any)'] = 'main/edit_vis/$1';
$route['update/mcn_visualizer/(:any)'] = 'main/update_mcn_vis/$1';
$route['update/msdqi_visualizer/(:any)'] = 'main/update_msdqi_vis/$1';

$route['add/indicator'] = 'main/add_indicator';
$route['delete/indicator/(:any)']['delete'] = 'main/delete_indicator/$1';


//api to visualizations
$route['get/programIndicators'] = 'main/get_programIndicators';
$route['get/programIndicatorsGroups'] = 'main/get_programIndicatorsGroups';
$route['get/indicators'] = 'main/get_indicators';
$route['get/indicatorsGroups'] = 'main/get_indicatorsGroups';
$route['get/dataElements'] = 'main/get_dataElements';
$route['get/dataElementsGroups'] = 'main/get_dataElements_Groups';

$route['get/dataSets'] = 'main/get_dataSets';

//filtering routes
$route['view/sub_period_type'] = 'filter/sub_period_type';
$route['view/districts'] = 'filter/filteredDistrict';
$route['view/clinics'] = 'filter/filteredClinic';

//adding new App
 $route['create/applications'] = 'main/add_app';
 $route['delete/applications/(:any)']['delete'] = 'main/delete_app/$1';

 //Demo Route to see filter data
 $route['filter/data'] = 'main/filter_data';

 //route for local filter
 $route['filter/local'] = 'main/local_filter';

 $route['last_tab'] = 'main/last_tab';

 //route to add visualizations to the dashboard

 $route['view/visualizations'] = 'main/get_Dhis2_visualizations';
 $route['view/maps'] = 'main/get_Dhis2_maps';
 $route['view/tables'] = 'main/get_Dhis2_Pivottables';
 $route['view/organizationGroups'] = 'filter/get_Organization_Group';
 $route['view/organizationLevels'] = 'filter/get_organization_level';

 // login action routes

 $route['login/dhis2/user'] = 'auth/Aindex';
 $route['dhis-web-commons-security/logout'] = 'auth/logout_Dhis2_user';

 // route to malaria bulletin functionalities

 $route['malariabulletin'] = 'main/bulletin_index';
 $route['bulletin/(:any)'] = 'main/open_bulletin/$1';
 $route['malariabulletin/(:any)'] = 'main/bulletin_reload/$1';
 $route['view/malariabulletin'] = 'main/view_bulletin';
 $route['save/report'] = 'main/save_report';
 $route['delete/report/(:any)'] = 'main/delete_bulletin_file/$1';
 $route['delete/template/(:any)'] = 'main/delete_bulletin_template_file/$1';
