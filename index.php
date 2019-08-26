<?php
session_start();

$connection=mysqli_connect("localhost","root","root","crud");

if(isset($_POST['submit1']))
{ 

	$_name = mysqli_real_escape_string($connection, $_POST['username']);
	$e_mail = mysqli_real_escape_string($connection, $_POST['email']);
	$user_role = mysqli_real_escape_string($connection, $_POST['role']);     
	$sql_insert_data="INSERT  INTO users (name,email, role) VALUES ('$_name', '$e_mail', '$user_role')";
		
	if(mysqli_query($connection,$sql_insert_data)){
	     header('Location: index.php');
	} else {
    		echo "ERROR: Could not able to execute $sql_insert_data." . mysqli_error($connection);
	}


}

// show all records
$sql_record="SELECT * FROM users";
$result=mysqli_query($connection,$sql_record);

// delete specific record

if(isset($_GET['delete']))
{
    mysqli_query($connection, "DELETE FROM users WHERE id=".$_GET['delete']);
    header('Location: index.php');
}


mysqli_close($connection);

?>

<!DOCTYPE html>
<html>
<head>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<title>crud</title>
</head>
<body>
         <div class="container">
         	     <h4>Insert Record</h4>
                 <form action="" method="post" class="form">
                 	<div class="form-group">
                 		<input type="text" name="username" class="form-control" placeholder="Enter user name here">
                 	</div>
                 		<div class="form-group">
                 		<input type="text" name="email" class="form-control" placeholder="Enter your here">
                 	</div>
                 
                 		<div class="form-group">
                 		<input type="text" name="role" class="form-control" placeholder="Enter your role">
                 	</div>
                     <button type="submit" class="btn btn-primary" name="submit1">Save recod</button>
                 </form>
                 <br>
                 <br>
                 <table class="table table-bordered">
                 	<thead>
                  		 <tr>
      						  <th>Name</th>
       						  <th>Email</th>
        					  <th>Role</th>
        					  <th>Edit</th>
        					  <th>Delete</th>
        				 </tr>
                    </thead>
                    <tbody>
                    	<?php
                              while ($row = mysqli_fetch_assoc($result)) {
                               ?>	 
                         	     <tr>
                          	    	<td><?php echo $row['name'];   ?></td>
                                 	<td><?php echo $row['email'];   ?></td>
                                 	<td><?php echo $row['role'];   ?></td>
                                 	<td><a href="">Edit</a></td>
                                 	<td><a href="?delete=<?php echo $row['id'] ;  ?>">Delete</a></td>
                                 </tr>
                        <?php
                            }
                    	?>
                    </tbody>
               </table>
				 
         </div>
         
</body>
</html>
