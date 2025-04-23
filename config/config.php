<?php



$host = $_SERVER['HTTP_HOST'];

if($host == 'localhost' || $host == '127.0.0.1'){
	define('ROOT', 'http://localhost/track-expense/');
	define('APP_ROOT',dirname(dirname(__FILE__)).'/');
	define('DB_HOST','localhost');
	define('DB_USER','root');
	define('DB_PASSWORD','');
	define('DB_NAME','track_expense');
	define('APP_NAME','Track Expense');
	define('PUBLIC_URL','/track-expense/public/');
	define('API_KEY','kahsdfjh98y3tnkajfajksndgkjar9e8ty2p&^gj4()*ptgv^&sdhaskg}{}|:"?,>,h30248ytpsgsiugbjn3480ty143tdifsuvbsie');
}