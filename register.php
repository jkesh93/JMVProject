<html>

	<head>
	  <title>JMV: Jay's database of Motor Vehicles</title>
	</head>

	<body>
	
	
	<h3> Please fill out the form </h3>
	<form method="post" action="">
		<input type="text" name="username" placeholder="Username" maxlength="20"> 
		<br>
		<input type="password" name="password" placeholder="Password" maxlength="15"> 
		<br>
		<input type="password" name="cpassword" placeholder="Confirm Password" maxlength="15"> 
		<br>
		<input type="text" name="fname" placeholder="First Name" maxlength="15"> 
		<br>
		<input type="text" name="midinit" placeholder="Middle Initial" maxlength="2">
		<br>
		<input type="text" name="lname" placeholder="Last Name" maxlength="15">
		<br>
		<br>Gender: 
		<br> 
		<input type="radio" name="gender" value="male"> Male 
		<br>
		<input type="radio" name="gender" value="female"> Female 
		<br>
		<input type="radio" name="gender" value="noanswer"> Prefer Not to Say 
		<br><br>
		<input type="submit"><input type="reset">
	</form>
	
	
	
	
	
	<?php 
		
			$username = '';
			$password = '';
			$cpassword = '';
			$midinit = '';
			$lname = '';
			$fname = '';
			$gender = '';
			
	$entriesReady = false;
	require_once('connectscripts/registrationConnect.php');

	
	
	function check_entries(){
		global $entriesReady;
		
		global $username;
		global $password;
		global $cpassword;
		global $midinit;
		global $lname;
		global $fname;
		global $gender;
		
		$entriesReady = true;
		
	
	// Form Field Validation -- with help from phppot.com/php/php-user-registration-form/

		if(empty($_POST['username'])){
			echo "<br>username is required";
			$entriesReady = false;
		} else{
			$username = $_POST['username'];
		}
		
		if(empty($_POST['password'])){
			echo "<br>password is required";
			$entriesReady = false;
		} else{
			$password = md5($_POST['password']);
		}
	
		if(empty($_POST['cpassword'])){
			echo "<br>password verifcation is incomplete";
			$entriesReady = false;
		} else{
			$cpassword = md5($_POST['cpassword']);
		}
		
		if(empty($_POST['fname'])){
			echo "<br>First name is required";
			$entriesReady = false;
		} else{
			$fname = $_POST['fname'];
		}
		
		if(empty($_POST['lname'])){
			echo "<br>last name is required";
			$entriesReady = false;
		} else{
			$lname = $_POST['lname'];
		}
		
		if(empty($_POST['midinit'])){
			echo "<br>Middle initial is required";
			$entriesReady = false;
		} else{
			$midinit = $_POST['midinit'];
		}
		
		if(empty($_POST['gender'])){
			echo "<br>username is required";
			$entriesReady = false;
		} else{
			$gender = $_POST['gender'];
		}
		
		
		
	}
	
	// retrieving variables from the form
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
			check_entries();

			if($entriesReady == true){
			
			$sql = "insert into regusers (username, password, gender, fname, lname, minit) values(:username,:password,:gender,:fname,:lname,:midinit)";
			$query = $conn->prepare($sql);
			$query->execute(array(
				':username' => $username,
				':password' => $password,
				':midinit' => $midinit,
				':fname' => $fname,
				':lname' => $lname,
				':gender' => $gender
				));
			
			echo "<br>You have successfully registered, please click <a href='/ProjectSeven/index.php'> here </a> to log in.";
			}elseif($entriesReady == false){
				echo "<br>Something went wrong, please try again.";
			}
	}
	
	?>

	
	</body>
	
	
</html>
