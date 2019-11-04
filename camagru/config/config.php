<?php

define('DEBUG', true);

define('DB_NAME', 'modo'); //database name
define('DB_USER', 'root'); //database name
define('DB_PASSWORD', 'root42'); // database password
define('DB_HOST', 'localhost'); // database host, *use IP address to avoid DNS lookup 127.0.0.1

define('DEFAULT_CONTROLLER', 'Home'); //default controller if there isnt one defined
define('DEFAULT_LAYOUT', 'default'); //if no layout is set in controller use this one default

define('PROOT', '/mvc-prac/camagru/'); // set tthis to '/' for a live server

define('SITE_TITLE', 'Modo MVC framework'); //this will be used if no sitetitle is set
define('MENU_BRAND', 'Camagru'); // Brand text in the menu

define('CURRENT_USER_SESSION_NAME', 'fsfsffewsirfkDFSDAFSffsdfd'); // session name for logged in user
define('REMEMBER_ME_COOKIE_NAME', 'HJMIYSEDJhjnhnSIFJSfsdfFJJFE'); //cookie name for logged in user remember me
define('REMEMBER_ME_COOKIE_EXPIRY', 2592000); // time in seconds for remember me cookie to live (30 days)

define('ACCESS_RESTRICTED', 'Restricted'); //controller name for the restricted redirect
