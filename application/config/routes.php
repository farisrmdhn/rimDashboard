<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Leading Risk Indicators
$route['kpmmRatios'] = 'kpmmRatios/dashboard';

//Leading Risk Indicators
$route['gaExpenses'] = 'gaExpenses/dashboard';

//Leading Risk Indicators
$route['leadingRiskIndicators'] = 'leadingRiskIndicators/dashboard';

//Investment Assets
$route['investmentRiskLimits'] = 'investmentRiskLimits/dashboard';
$route['unrealizedGainLosses'] = 'unrealizedGainLosses/dashboard';
$route['assetAllocations'] = 'assetAllocations/dashboard';
$route['bondAllocations'] = 'bondAllocations/dashboard';
$route['bondARatings'] = 'bondARatings/dashboard';

//RcpReport
$route['riskBasedCapitals'] = 'riskBasedCapitals/dashboard';

//bpp
$route['bpp'] = 'bpp/dashboard';


//rcpStatus
$route['rcpStatus'] = 'rcpStatus/index';

//Pages
$route['pages'] = 'pages/index';
$route['(:any)'] = 'pages/index';
$route['default_controller'] = 'pages/index';

$route['404_override'] = 'pages/notFound'; //belom
$route['translate_uri_dashes'] = FALSE;
