<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_local = "localhost";
$database_local = "cursoweb2";
$username_local = "root";
$password_local = "";
$local = mysql_pconnect($hostname_local, $username_local, $password_local) or trigger_error(mysql_error(),E_USER_ERROR); 
?>