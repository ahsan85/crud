<?php
session_start();

$connection=mysqli_connect("localhost","root","root","crud");

	if(isset($_GET['delete']))
		{
    		mysqli_query($connection, "DELETE FROM users WHERE id=".$_GET['delete']);
    		header('Location: index.php');
		}
  mysqli_close($connection);
?>
