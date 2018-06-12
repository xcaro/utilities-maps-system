<?php
$r_hostname = 'localhost';
$r_dbname = 'app';

$r_connect = r\connect($r_hostname);

$r_list_db = r\dbList()->run($r_connect);
if (!in_array($r_dbname, $r_list_db)) {
	r\dbCreate($r_dbname)->run($r_connect);
}
$r_list_tb = r\db('app')->tableList()->run($r_connect);

if (!in_array('activeReports', $r_list_tb)) {
	r\db('app')->tableCreate('activeReports')->run($r_connect);
}
$r_connect->close();