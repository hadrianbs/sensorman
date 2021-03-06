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
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['sensor/new'] = 'home/create_sensor/form';
$route['new_collab2'] = 'home/create_collab/form2';
$route['new_collab3'] = 'home/create_collab/form3';
$route['create_sensor'] = 'home/create_sensor/submit';
$route['sensor/view/(:any)'] = 'home/viewsensor/$1';
$route['getRealtimeData/(:any)'] = 'data_controller/getRealTimeSensorData/$1';
$route['getRealTimeCollabData/(:any)'] = 'data_controller/getRealTimeCollabData/$1';
$route['analyze/sensor/(:any)'] = 'home/analyzeSensor/$1';
$route['analyze/collab/(:any)'] = 'home/analyzeCollab/$1';
$route['collab/view/(:any)'] = 'home/viewcollab/$1';
$route['profile'] = 'home/viewUserProfile';
$route['public-sensors'] = 'home/viewPublicSensors';
$route['rule/create/(:num)'] = 'home/createAlertForm/$1';
$route['send-data'] = 'api/retrieve_data';
 
#routes for json api

$route['json/sensor/all/(:any)'] = 'data_controller/getallsensordata/$1';
$route['json/sensor/max/(:any)'] = 'data_controller/getMaxSensorReading/$1';
$route['json/sensor/min/(:any)'] = 'data_controller/getMinSensorReading/$1';
$route['json/sensor/average/(:any)'] = 'data_controller/getAverageSensorReading/$1'; 

$route['json/collab/(:any)/(:any)'] = 'data_controller/getCollabCharts/$2/$1';