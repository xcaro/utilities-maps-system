<?php
$r_hostname = env('R_HOST', '127.0.0.1');
$r_dbname = env('R_DATABASE', 'test');
$r_port = env('R_PORT');

$r_connect = r\connect($r_hostname, $r_port);

$r_list_db = r\dbList()->run($r_connect);
if (!in_array($r_dbname, $r_list_db)) {
	r\dbCreate($r_dbname)->run($r_connect);
}
$r_list_tb = r\db('app')->tableList()->run($r_connect);

if (!in_array('activeReports', $r_list_tb)) {
	r\db('app')->tableCreate('activeReports')->run($r_connect);
}
if (!in_array('activeClinics', $r_list_tb)) {
	r\db('app')->tableCreate('activeClinics')->run($r_connect);
}
$r_connect->close();
