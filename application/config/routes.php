<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['404_override'] = 'error/showError404';
$route['default_controller'] = 'home/view';
$route['home'] = 'home/view';
$route['about'] = 'about/view';
$route['user/view'] = 'user/changePass';
$route['user/view'] = 'user/view';
$route['user/register'] = 'user/register';
$route['user/login'] = 'user/login';
$route['supply/postDoc'] = 'supply/postDoc';
$route['supply/setData'] = 'supply/setData';
$route['supply/deleteEqpt'] = 'supply/deleteEqpt';
$route['supply/addEqpt'] = 'supply/addEqpt';
$route['supply/addSupp'] = 'supply/addSupp';
$route['supply/viewEqpt'] = 'supply/viewEqpt';
$route['supply/deleteDoc'] = 'supply/deleteDoc';
$route['supply/setAcquisition'] = 'supply/setAcquisition';
$route['supply/viewSupply'] = 'supply/viewSupply';
$route['supply/fetchData'] = 'supply/fetchData';
$route['supply/sequence'] = 'supply/sequence';
$route['supply/barcodeInventory'] = 'supply/barcodeInventory';
$route['supply/iar'] = 'supply/iar';
$route['supply/pmo'] = 'supply/pmo';
$route['supply/view'] = 'supply/view';
$route['supply/transfer'] = 'supply/transfer';
$route['supply/wasteEqpt'] = 'supply/wasteEqpt';
$route['supply/transEqpt'] = 'supply/transEqpt';
$route['personnel/view'] = 'personnel/view';
$route['supply/track'] = 'supply/track';
$route['personnel/addpersonnel'] = 'personnel/addpersonnel';
$route['person/view']='person/view';
$route['summaries/filterPipz'] = 'summaries/filterPipz';
$route['summaries/equipOffice'] = 'summaries/equipOffice';
$route['summaries/enduser'] = 'summaries/view/enduser';
$route['summaries/accounting'] = 'summaries/view/accounting';
$route['translate_uri_dashes'] = FALSE;
