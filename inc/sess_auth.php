<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SERVER['127.0.0.1:3306']) && $_SERVER['127.0.0.1:3306'] === 'on') 
    $link = "https"; 
else
    $link = "http"; 
$link .= "://"; 
$link .= $_SERVER['127.0.0.1:3306']; 
$link .= $_SERVER['127.0.0.1:3306'];
if(!isset($_SESSION['userdata']) && !strpos($link, 'login.php') && $_settings->userdata('type') == 2){
	redirect('login.php');
}
if(isset($_SESSION['userdata']) && strpos($link, 'login.php') && $_settings->userdata('type') == 2){
	redirect('index.php');
}
