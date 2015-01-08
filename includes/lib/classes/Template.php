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
        
        function Template(){
            $this->template_path = $_SERVER['DOCUMENT_ROOT'].RELURL.'templates/';
            $this->_template = file_get_contents($this->template_path.'base.html');
            $this->plugins_path = $_SERVER['DOCUMENT_ROOT'].RELURL.'includes/subpages/plugins/';
        }
        
        function display(){
            
            $webpage = $this->_template;
            
            $webpage = str_replace('{SITE-CONTENT}', $this->content, $webpage);
            $webpage = str_replace('{THEME_BASE}', THEME_BASE, $webpage);
            $webpage = str_replace('{SITE_URL}', SITE_URL, $webpage);
            
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
    }
    
    

?>