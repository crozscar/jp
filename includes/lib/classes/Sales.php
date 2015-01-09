<?php
    class Sales{
        
        function dashboard(){
            global $_TPLT;
            global $site_settings;
            global $sql_obj;
            
            $filters = array();
            $_REQUEST['month'] = (isset($_REQUEST['month'])) ? $_REQUEST['month'] : 0;
            $_REQUEST['year'] = (isset($_REQUEST['year'])) ? $_REQUEST['year'] : 0;
            if($_REQUEST['month'] > 0 && $_REQUEST['month'] < 13) $filters[] = 'MONTH(transaction_date) = '.$_REQUEST['month'];
            if($_REQUEST['year'] > 0) $filters[] = 'YEAR(transaction_date) = '.$_REQUEST['year'];
            
            $_TPLT->extraParams[] = 'month='.$_REQUEST['month'];
            $_TPLT->extraParams[] = 'year='.$_REQUEST['year'];
            $filters = (!empty($filters)) ? ' WHERE '.join(' AND ', $filters) : '';
            
            $data = array('site_settings' => $site_settings,
                          'sql_obj' => $sql_obj,
                          'orders' => $this->getSalesOrders($filters));
            
            $_TPLT->totalQueryRecords = $this->getTotalSalesOrders($filters);
            $_TPLT->site_header = 'Sales Dashboard';
            $_TPLT->template_path .= 'sales-dashboard.php';
            $_TPLT->data = $data;
        }
        
        function getSalesOrders($filters = ''){
            global $_TPLT;
            global $_CONN;
            
            $sql = '
            SElECT * 
            FROM #__sale_orders
            '.$filters.' 
            LIMIT '.(($_TPLT->curPage * $_TPLT->queryLimit) - $_TPLT->queryLimit).', '.$_TPLT->queryLimit;
            
            echo $sql;
            
            return $_CONN->query($sql, 2);
            
        }
        
        function getTotalSalesOrders($filters = ''){
            global $_CONN;
            
            $sql = '
            SElECT COUNT(*) as totalRecords
            FROM #__sale_orders '.$filters;
            
            $resp = $_CONN->query($sql, 1);
        
            return $resp->totalRecords;
        }
        
    }
?>