<?php
include('config.php');
$action = get('action');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if($action == 'add') {
		$sql = file_get_contents('sql/signup.sql');
		$params = array(
			'name' => $name,
			'username' => $username,
			'password' => $password
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
		
		
		
		
		
	}
		
	$sql = file_get_contents('sql/login.sql');
	$params = array(
		'username' => $username,
		'password' => $password
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$users = $statement->fetchAll(PDO::FETCH_ASSOC);
	
	
	if(!empty($users)) {
	$user = $users[0];
		
	$_SESSION['crewid'] = $user['crewid'];
	
	$sql = file_get_contents('sql/signUpCaptain.sql');
		$params = array(
			'crewid' => $user['crewid']
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
	} 
	header('location: captianForm.php?action=add&crewid=$crewid');
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>SignUp</title>
	
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="page">
		<h1>Sign Up</h1>
		<p>When creating a login you will be directed to the create Captain Page, to create your captain. Your Captain will be linked to your account and you will be able to edit your captain whenever.</p>
		<form method="POST">
			<input type="text" name="name" placeholder="Name" />
			<input type="text" name="username" placeholder="Username" />
			<input type="password" name="password" placeholder="Password" />
			<input type="submit" value="Sign Up" />
		</form>
		<p><a href="login.php">Cancel</a></p>
	</div>
</body>
</html>