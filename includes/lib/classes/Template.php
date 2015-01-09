<?php

    class Template{
        var $_template;
        var $content;
        var $template_path;
        var $theme_css = 'form-plugin-css.php';
        var $theme_css_content;
        
        var $theme_js = 'form-plugin-js.php';
        
        var $plugins_path;
        
        var $site_header;
        var $data = array();
        
        var $pageModule = 'sales-dashboard';
        
        var $totalQueryRecords = 0;
        var $queryLimit = 20;
        var $curPage = 1; //Current Page for pagination
        
        var $extraParams = array();
        
        function Template(){
            $this->template_path = $_SERVER['DOCUMENT_ROOT'].RELURL.'templates/';
            $this->_template = file_get_contents($this->template_path.'base.html');
            $this->plugins_path = $_SERVER['DOCUMENT_ROOT'].RELURL.'includes/subpages/plugins/';
            $this->curPage = (int) (isset($_REQUEST['p'])) ? $_REQUEST['p'] : 1;
        }
        
        function display(){
            
            $webpage = $this->_template;
            $webpage = str_replace('{TITLE}', $this->site_header, $webpage);
            $webpage = str_replace('{SITE-CONTENT}', $this->content, $webpage);
            $webpage = str_replace('{THEME_BASE}', THEME_BASE, $webpage);
            $webpage = str_replace('{SITE_URL}', SITE_URL, $webpage);
            $webpage = str_replace('{PAGEMODULE}', $this->pageModule, $webpage);
            
            if(isset($_SESSION['user_id'])) $webpage = str_replace('{TOPBARUSERLOGINDROPDOWN}', $this->topBarUserLoginDropdown(), $webpage);
            return $webpage;
            
        }
        
        private function topBarUserLoginDropdown(){
            
            $u = getUser($_SESSION['user_id']);
            $html = '';
            if($u['login_type'] == '0'){
                $html .= '<img alt="" width="29px" height="29px" src="'.SITE_URL.'user-images/thumb_'.$u['image'].'">';
            }else {
                $html .= '<img alt="" width="29px" height="29px" src="http://graph.facebook.com/'.$u['fb_id'].'/picture">';
            } 
            
            $html .= '<span class="username">'.$u['name'].'</span>';
            
            return $html;
        }
        
        function login(){
            global $_TPLT;
            $data = array();
            
            if($_POST){
                if(isset($_POST['submit'])) {
                    $username = mysql_real_escape_string($_POST['username']);
                    $password = mysql_real_escape_string($_POST['password']);
                    $result = mysql_query("SELECT * FROM users WHERE user_name='$username' AND password='$password' and active = '1'");
                    
                    if(mysql_num_rows($result ) > 0) {
                            $row = mysql_fetch_array($result);
                            $_SESSION['user_id'] = $row['id'];
                            //goUrl("products.php");
                            goUrl(CTRL_FILE.'?page=products');
                    }else {
                            $data['msg'] =  "Invalid Name Or Password";
                    }
                }
                
            }
            
            $_TPLT->site_header = 'Login';
            $_TPLT->_template = file_get_contents($_TPLT->template_path.'base_login.html');
            $_TPLT->template_path .= 'login.php';
            $_TPLT->data = $data;
        }
        
        function notfound(){
            global $_TPLT;
            $data = array();
            
            $_TPLT->site_header = '404 ERROR - PAGE NOT FOUND';
            $_TPLT->_template = file_get_contents($_TPLT->template_path.'base_blank.html');
            $_TPLT->template_path .= '404.php';
            $_TPLT->data = $data;
        }
        
        /*PAGINATION*/
        function displayPagination(){
            $numPages = ceil($this->totalQueryRecords / $this->queryLimit);
            $pagesHtml = array();
            
            //Previous
            $prevNextURL = RELURL.'?'.join('&', $this->extraParams).'&p='.($this->curPage-1);
            $prevNextClass = '';
            
            if($this->curPage == 1){
                $prevNextURL = '#';
                $prevNextClass = 'disabled';
            }
            
            $pagesHtml[] = '<li class="'.$prevNextClass.'"><a href="'.$prevNextURL.'" aria-label="Previous"><span aria-hidden="true">Previous</span></a></li>';
            
            for($ctr = 1; $ctr <= $numPages; $ctr++){
                if($ctr == $this->curPage) $pagesHtml[] = '<li class="active"><a href="#">'.$ctr.' <span class="sr-only">(current)</span></a></li>';
                else $pagesHtml[] = '<li><a href="'.RELURL.'?'.join('&', $this->extraParams).'&p='.$ctr.'">'.$ctr.'</a></li>';
            }
            
            //Next
            $prevNextURL = RELURL.'?'.join('&', $this->extraParams).'&p='.($this->curPage+1);
            $prevNextClass = '';
            
            if($this->curPage == $numPages){
                $prevNextURL = '#';
                $prevNextClass = 'disabled';
            }
            $pagesHtml[] = '<li class="'.$prevNextClass.'"><a href="'.$prevNextURL.'" aria-label="Next"><span aria-hidden="true">Next</span></a></li>';
            
            $html= '
            <nav>
                <ul class="pagination">
                  '.join('',$pagesHtml).'
               </ul>
             </nav>
            ';
            
            //We will not display pagination if records is equal or less than query limit
            if($this->totalQueryRecords <= $this->queryLimit) $html = '';
            
            echo $html;
        }
    }
    
    

?>