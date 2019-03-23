<?php
session_start();

$timezone = date_default_timezone_set("Europe/Copenhagen");

$con = mysqli_connect("localhost", "root", "mysql", "akv001"); // Connection variable

	if(mysqli_connect_errno())
		{
			echo "Failed to connect: " . mysqli_connect_errno();
		} 
?>