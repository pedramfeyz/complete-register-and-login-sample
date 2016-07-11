<?php
mysql_connect('server','user','pass') or die('could not connect:' .mysql_error());
mysql_select_db('dbName') or die('can\'t use'.libbookstore.':'.mysql_error());
?>
