<?php
session_start();
include('includes/config.php');
if(isset($_POST['login']))
{
$emailreg=$_POST['emailreg'];
$password=$_POST['password'];
$stmt=$db->prepare("SELECT id, email, password FROM userregistration WHERE email=?");
$stmt->bind_param('s',$emailreg);
$stmt->execute();
$data=$stmt->fetch();
