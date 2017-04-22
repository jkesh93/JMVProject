<!DOCTYPE HTML>
<html>


	<head>
	  <title>JMV2: Jay's database of Motor Vehicles</title>

	  
	</head>

	<body>
	
	<h3> Welcome to the JMV -- Jay's database of Motor Vehicles </h3>
	<h3> Please Log in below or <a href="register.php">register</a></h3>
	
	
	<form method="post" action="">
		<input type="text" name="username" placeholder="Username"><br>
		<input type="password" name="password" placeholder="Password"><br>
		<input type="submit" value="Login">
	</form>
	
	
	<?php 
	
	require_once('connectscripts/loginConnect.php'); 
	session_start();
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		
		// variables
		global $stated;
		$logUser = $_POST['username'];
		$logPass = md5($_POST['password']);
		$login = false;
		
		// query
		$queryUsers = "SELECT username, password, fname from regusers";
		$sql = $conn->prepare($queryUsers);
		$sql->execute();
		while($result = $sql->fetch(PDO::FETCH_ASSOC)){
		//	echo "<br> " . $result['username'] . " and " . $result['password'];
			
			if($logUser == $result['username'] && $logPass == $result['password']){
				echo "<br>user found";
				$_SESSION['loggedIn'] = true;
				$_SESSION['name'] = ucfirst($result['fname']);

				?>
				<meta http-equiv="refresh" content="0; url=/ProjectSevenV2/userLoggedIn.php" />
				<?php
				
				$login = true;
				
			} else{
				if($stated == 0){
				echo "<br> Invalid username or password";
				$stated = 1;
				}
			}
			
		}
		
		if($login == true){
			?> <meta http-equiv="refresh" content="0; url=/ProjectSevenV2/userLoggedIn.php" /> <?php
			
		}
		
		
		
		
		
		
	}
	







	?>

	</body>
	
	
</html>
