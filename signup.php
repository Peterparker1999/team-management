<?php 
	require "connection.php";
	if(isset($_POST['sign_up']))
	{
		$email = $_POST['email'];
		$password = $_POST['password'];
        $base64= base64_encode($password);

	if(!empty($email) && !empty($base64) && !is_numeric($email))
		{
			$sql = mysqli_query($conn, "SELECT * FROM login WHERE email='{$email}'");
            if(mysqli_num_rows($sql) > 0){
                echo "$email - This email already exist!";
            }else{
				$sql="INSERT INTO login (email,password)VALUES ('$email','$base64')";
				$runn=mysqli_query($conn,$sql);	
                echo "You have successfully signed Up";
            }
	}
		else
			{
				echo "you have entered wrong details";
				
			}
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
</head>
<body>

	<style type="text/css">
        
        body{
background-image: url("https://images.unsplash.com/photo-1554415707-6e8cfc93fe23?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80")  ;
            background-repeat: no-repeat;
            background-size:cover;
        }
	
	#text{

		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}

	#button{

		padding: 10px;
		width: 100px;
		color: white;
		background-color: lightblue;
		border: none;
	}

	#box{

		background-color: grey;
		margin: 90px;
		width: 370px;
		padding: 20px;
	}
        a{
              color: skyblue;
            text-align: center;
        }
        a:hover{
            color:purple;
        }

	</style>

	<div id="box">
		
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Signup</div>
            
            <input id="text" type="email" name="email" placeholder="Enter your Email">
            

<!--			<input id="text" type="text" name="text" placeholder="Enter your name"><br><br>-->
			<input id="text" type="password" name="password" placeholder=" Enter your password"><br><br>

			<input id="button" type="submit"name="sign_up" value="Signup"><br><br>

			Do you have an account? <a href="login.php">Click to Login</a><br><br>
		</form>
	</div>
</body>
</html>
