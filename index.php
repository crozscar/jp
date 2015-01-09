<?php
    header("Access-Control-Allow-Origin: *");
    error_reporting(E_ALL);
    
    define('RELURL', '/'.basename(__DIR__).'/');
    include('includes/lib/includes.php');
    
    includeModelClasses();
    
    $_CONN = new Connection();
    $_CTRL = new Controller();
    $_TPLT = new Template();
    
    ob_start();
    $_CTRL->page();
    $_TPLT->content = ob_get_clean();
    echo $_TPLT->display();
    flush();
    
?>