<?php
	session_set_cookie_params(0 , '/' , '.' , true, true);
	session_start();
//$old_sessionid = session_id();
if(isset($_SESSION['id_account']))
session_regenerate_id();
//$new_sessionid = session_id();
//echo "Old Session: $old_sessionid<br />";
//echo "New Session: $new_sessionid<br />";
	/*
	Security
	*/
	
	if (!isset($_SESSION['csrf_token'])) {
	    if(isset($_SESSION['id_account'])) {
            $_SESSION['csrf_token'] = md5(uniqid($_SESSION['id_account'], true));
        }
		}

?>
