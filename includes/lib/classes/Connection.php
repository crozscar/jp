<?php

    class Connection {
        var $link;
        
        function Connection(){            
            $this->link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("NO CONNECTION");
            mysql_selectdb(DB_NAME, $this->link);
        }
        
        function query($sSQL, $code = 0){
            $sSQL = str_replace("#__", DB_PREFIX, $sSQL);
            
            $resp = mysql_query($sSQL, $this->link);            
            
            if($resp){
                $results = '';
                
                switch($code){
                    case 0: //Single array
                            $results = mysql_fetch_row($resp);
                            $results = $results[0];
                            break;
                    case 1: //Single Object
                            $results = mysql_fetch_object($resp);
                            break;
                    case 2: //Multiple Objects
                            $results = array();
                            while($o = mysql_fetch_object($resp)) $results[] = $o;
                            break;
                    case 3: //Multibple Arrays
                            $results = array();
                            while($o = mysql_fetch_row($resp)) $results[] = $o;
                            break;
                    
                    default: break;
                
                }
                
                return $results;
                
            }else if(is_bool($resp)) return $resp;
        }
		
	function new_instance_id(){
		return mysql_insert_id();			
	}
        
        function close(){
            mysql_close($this->link);
        }
    }
    
?>