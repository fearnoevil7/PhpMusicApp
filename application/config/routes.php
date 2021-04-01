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
$route['register'] = 'Home/Register';
$route['signin'] = "Home/login";
$route['dashboard/(:any)'] = "Home/user_dashboard/$1";
$route['song/new'] = "Song/new";
$route['upload/(:any)'] = "Song/new/(:any)";
$route['song/show/(:any)'] = "Song/Show/$1";
$route['create'] = "Song/create";
$route['like/create/(:any)/(:any)'] = "Like/Create/$1/$2";
$route['dislike/(:any)/(:any)'] = "Like/Destroy/$1/$2";
$route['post/(:ant)/(:any)'] = "Message/Create/$1/$2";
$route['user/show/(:any)'] = "Home/show/$1";
$route['sendFriendRequest/(:any)/(:any)'] = "Home/sendFriendRequest/$1/$2";
$route['song/show/comment/(:any)/(:any)/(:any)'] = "Comment/Create/$1/$2/$3";
$route['comment/(:any)/(:any)/(:any)'] = "Comment/Create/$1/$2/$3";
$route['dashboard/confirmRequest/(:any)/(:any)'] = "Home/acceptFriendRequest/$1/$2";
$route['dashboard/declineRequest/(:any)/(:any)'] = "Home/declineFriendRequest/$1/$2";
$route['radio'] = "Song/getStation";
$route['Artist'] = "Welcome/ArtistWall";
$route['Station'] = "Station/RadioStation";
$route['edit'] = "Home/edit";
$route['signout'] = "Home/logout";
$route['update'] = 'Home/update';
$route['update/password'] = 'Home/updatePassword';
$route['update/profilepicture'] = 'Home/updateProfilePic';

