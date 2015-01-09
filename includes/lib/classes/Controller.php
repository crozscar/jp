<?php

    class Controller{
        
        var $pageModule = 'sales-dashboard';
        /*var $modules = array('products','sales-dashboard',
                          'Inventory_health','super-url',
                          'rank-tracker','seller-rank',
                          'user-rating','profile-setting',
                          'setting','login');
        */
        function page(){
            global $_TPLT;
            
            $_TPLT->pageModule = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : $_TPLT->pageModule;
            $_TPLT->extraParams[] = 'page='.$_TPLT->pageModule;
            //Check to see if user is logged in
            if(!isset($_SESSION['user_id'])) $_TPLT->pageModule = 'login';
            
            switch($_TPLT->pageModule){
                case 'login': $this->processView('Template', $this->pageModule);
                              break;
                case 'sales-dashboard': $this->processView('Sales', 'dashboard');
                                        break;
                
                case 'products': $this->processView('Product', $this->pageModule);
                                        break;
                                    
                default: $this->processView('Template', 'notfound');
                         break; 
                            
            }
            $_TPLT->data['_TPLT'] = $_TPLT;
            extract($_TPLT->data);
            include_once($_TPLT->template_path);
        }
        
        private function processView($className, $methodName){
            global $_TPLT;
            if($className != 'Template'){
                $viewInstance = new $className;
                $viewInstance->$methodName();
            }else $_TPLT->$methodName();
        }
        
    }

?>