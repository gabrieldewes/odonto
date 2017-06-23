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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route["users"] = "UserController";

$route["me"] = "AccountController";
$route["register"] = "AccountController/create";
$route["account/register"] = "AccountController/registerAccount";
$route["account/activate"] = "AccountController/activateAccount";

$route["login"] = "AuthController/login";
$route["auth"] = "AuthController/authenticate";
$route["logout"] = "AuthController/logout";

$route["cards"] = "CardController";
$route["cards/archive"] = "CardController/findArchived";
$route["cards/new"] = "CardController/create";
$route["cards/create"] = "CardController/createCard";
$route["cards/(:num)"] = "CardController/detailedCard/$1";
$route["cards/(:num)/archive"] = "CardController/archiveCard/$1";
$route["cards/(:num)/recover"] = "CardController/recoverCard/$1";
$route["cards/(:num)/actions"] = "CardController/findDiagnostics/$1";
$route["cards/(:num)/actions/(:num)"] = "CardController/detailedDiagnostic/$1/$2";
$route["cards/(:num)/actions/new"] = "ContributorController/create/$1";
$route["cards/(:num)/actions/create"] = "ContributorController/createDiagnostic/$1";

$route["actions"] = "ActionController";

$route["contributor"] = "ContributorController";
$route["contributor/cards"] = "ContributorController/findAll";
$route["contributor/cards/(:num)"] = "CardController/detailedCard/$1";
$route["contributor/cards/(:any)/(:num)"] = "CardController/detailedCard/$2";
$route["contributor/cards/(:any)/(:num)/actions"] = "CardController/findDiagnostics/$2";
$route["contributor/cards/(:any)/(:num)/actions/(:num)"] = "CardController/detailedDiagnostic/$2/$3";
$route["contributor/cards/(:num)/actions"] = "CardController/findDiagnostics/$1";
$route["contributor/cards/(:num)/actions/new"] = "ContributorController/create/$1";
$route["contributor/cards/(:any)/(:num)/actions/new"] = "ContributorController/create/$2";
$route["contributor/cards/pending"] = "ContributorController/pendingCards";
$route["contributor/cards/diagnosed"] = "ContributorController/diagnosedCards";

$route["attachments"] = "AttachmentController";
$route["attachments/(:num)"] = "AttachmentController/detailedAttachment/$1";
$route["attachments/(:num)/download"] = "AttachmentController/downloadAttachment/$1";
$route["attachments/(:num)/json"] = "AttachmentController/imageLink/$1";

$route['mails'] = "MailController/seeTemplates";

$route["admin/cards"] = "CardController/findAll";
$route["admin/attachments"] = "AttachmentController/findAll";
$route["admin/users/delete/(:num)"] = "UserController/delete/$1";

$route["api"] = "rest/AuthResource/default";

$route["api/greetings"] = "rest/AuthResource/greetings";

$route["api/auth/token"] = "rest/AuthResource/get_token";
$route["api/auth/logout"] = "rest/AuthResource/logout";

$route["api/account/me"] = "rest/AccountResource/me";
$route["api/account/register"] = "rest/AccountResource/register";

$route["api/cards/archive"] = "rest/CardResource/archive";
$route["api/cards"] = "rest/CardResource";
$route["api/cards/(:num)"] = "rest/CardResource/cards/$1";
$route["api/cards/(:num)/archive"] = "rest/CardResource/archive/$1";
$route["api/cards/(:num)/attachments"] = "rest/CardResource/attachments/$1";

$route["api/cards/(:num)/actions"] = "rest/ActionResource/$1";
$route["api/cards/(:num)/actions/(:num)"] = "rest/ActionResource/actions/$1/$2";
$route["api/cards/(:num)/actions/(:num)/attachments"] = "rest/ActionResource/attachments/$2";
