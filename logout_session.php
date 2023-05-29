<?php 

require_once 'dbconfig.php';
session_start();
session_destroy();
	header("Location: login_session.php");

 ?>