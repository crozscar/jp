<?php 
session_start();
define("SITE_NAME", "Seller Tools");
#define("SITE_URL", "http://dixeam.com/amazone/"); 
#define("RANK_SITE_URL", "http://dixeam.com/amazone/");
define("SITE_URL", RELURL); 
define("RANK_SITE_URL", RELURL);
define('USER_IMAGES', SITE_URL."images/user-images/"); 
define("THEME_BASE",SITE_URL."theme/");
define("INCLUDE_PATH",$_SERVER['DOCUMENT_ROOT']."/includes/");

define("CTRL_FILE", RELURL);

//FOR CONNECTION Class
define("DB_PREFIX", "");
define("DB_USER", ($_SERVER['SERVER_NAME'] == 'localhost') ? 'dixeam_amazone' : 'root');
define("DB_PASSWORD", "vertrigo");
define("DB_NAME", "dixeam_amazone");
define("DB_HOST", "localhost");

?>