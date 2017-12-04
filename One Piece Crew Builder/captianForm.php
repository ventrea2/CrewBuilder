<?php
include('config.php');

$crewid = $user->get('crewid');
$isCap = isCap($crewid, $database);
if($isCap == false)
{
	header ("location: class.php");
}

$action = get('action');
$crewid = get('crewid');

$cap = null;

if(!empty($crewid)) {
	$sql = file_get_contents('sql/getCaptainsForm.sql');
	$params = array(
		'crewid' => $crewid
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$captains = $statement->fetchAll(PDO::FETCH_ASSOC);

	$cap = $captains[0];
	
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name = $_POST['f_name'];
	$bounty = $_POST['f_bounty'];
	$crewName = $_POST['f_crewName'];
	$abilities = $_POST['f_abilities'];
	$Info = $_POST['f_Info'];
	
	
	if($action == 'add') {
		
		$sql = file_get_contents('sql/insertCaptain.sql');
		$params = array(
			'name' => $name,
			'bounty' => $bounty,
			'crewName' => $crewName,
			'abilities' => $abilities,
			'Info' => $Info
		);
	
		$statement = $database->prepare($sql);
		$statement->execute($params);
	}
	elseif ($action == 'edit') {
		$sql = file_get_contents('sql/updateCaptain.sql');
		$params = array(
			'crewid' => $crewid,
			'name' => $name,
			'bounty' => $bounty,
			'crewName' => $crewName,
			'abilities' => $abilities,
			'Info' => $Info
		);
	
		$statement = $database->prepare($sql);
		$statement->execute($params);
}
header('location: captians.php');
}
	
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Captain Form</title>
	<meta name="description" content="The HTML5 Herald">
	<meta name="author" content="SitePoint">

	<link rel="stylesheet" href="css/style.css">

</head>
<body>
	<nav>
	<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="captians.php">Captains</a></li>
			<li><a href="crew.php">Crew Members</a></li>
			<li><a href="buildCrew.php?action=add&crewid=<?php echo $crewid?>">Build Crew</a></li>
			<li><a href="login.php">Login</a></li>
			<li><a href="logout.php">Logout</a></li>
	</ul>
	</nav>
	<div class="page">
	<img id="jolly" src="images/jolly.png" alt="jolly">
	<h1> New Captian </h1>
		<form action="" method="POST">
			<div class="form-element">
				<label>Name:</label>
				<?php if($action == 'add') : ?>
					<input type="text" name="f_name" class="textbox" />
				<?php else : ?>
					<input type="text" name="f_name" class="textbox" value="<?php echo $cap['name'] ?>" />
				<?php endif; ?>
			</div>
				<div class="form-element">
				<label>Bounty:</label>
				<?php if($action == 'add') : ?>
					<input type="text" name="f_bounty" class="textbox" />
				<?php else : ?>
					<input  type="text" name="f_bounty" class="textbox" value="<?php echo $cap['bounty'] ?>" />
				<?php endif; ?>
			</div>
				<div class="form-element">
				<label>Crew:</label>
				<?php if($action == 'add') : ?>
					<input type="text" name="f_crewName" class="textbox" />
				<?php else : ?>
					<input  type="text" name="f_crewName" class="textbox" value="<?php echo $cap['crewName'] ?>" />
				<?php endif; ?>
			</div>
				<div class="form-element">
				<label>Abilities:</label>
				<?php if($action == 'add') : ?>
					<input type="text" name="f_abilities" class="textbox" />
				<?php else : ?>
					<input  type="text" name="f_abilities" class="textbox" value="<?php echo $cap['abilities'] ?>" />
				<?php endif; ?>
			</div>
				<div class="form-element">
				<label>Info:</label>
				<?php if($action == 'add') : ?>
					<input type="text" name="f_Info" class="textbox" />
				<?php else : ?>
					<input type="text" name="f_Info" class="textbox" value="<?php echo $cap['Info'] ?>" />
				<?php endif; ?>
			</div>
			<div class="form-element">
				<input type="submit" class="button" />&nbsp;
				<input type="reset" class="button" />
			</div>
		</form>
	</div>
</body>
</html>