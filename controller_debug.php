<?php
    define('RELURL', '/'.basename(__DIR__).'/');
    require_once('includes/lib/includes.php');
    
    $_PAGEMODULES = array('products','sales-dashboard',
                          'Inventory_health','super-url',
                          'rank-tracker','seller-rank',
                          'user-rating','profile-setting',
                          'setting');
    
    $pageModule = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 'products';
    
    //Check to see if user is logged in
    if(!isset($_SESSION['user_id'])) $pageModule = 'login';
    
    
    //Controller
    if(in_array($pageModule, $_PAGEMODULES) && $pageModule != 'login'){
        require_once('includes/subpages/header.php');
        include_once($pageModule.'.php');
        require_once('includes/subpages/footer.php');
    }elseif($pageModule == 'login') include_once('index.php');
?>