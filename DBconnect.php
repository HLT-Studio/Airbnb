<?php
try{
	$conn = new PDO("mysql:host=localhost;dbname=ql_renthouse", 'root', '');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->query("set names utf8");
}
catch(PDOException $e){
	
}
?>
