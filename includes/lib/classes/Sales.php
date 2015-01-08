<?php
    class Sales{
        
        function dashboard(){
            global $_TPLT;
            global $site_settings;
            global $sql_obj;
            
            $data = array('site_settings' => $site_settings,
                          'sql_obj' => $sql_obj);
            
            $_TPLT->site_header = 'Sales Dashboard';
            $_TPLT->template_path .= 'sales-dashboard.php';
            $_TPLT->data = $data;
        }
        
    }
?>