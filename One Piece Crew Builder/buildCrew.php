<?php
include('config.php');

$crewid = $user->get('crewid');
$isCap = isCap($crewid, $database);
if($isCap == false)
{
	header ("location: class.php");
}
$action = get('action');
$capId = get('crewid');
$crewArray = array();
$cap = null;

$sql = file_get_contents("sql/getCaptains.sql");
$statement = $database->prepare($sql);
$statement->execute();
$captain = $statement->fetchAll(PDO::FETCH_ASSOC);

$cap = $captain[0];

$sql = file_get_contents("sql/getCrew.sql");
$statement = $database->prepare($sql);
$statement->execute();
$crew = $statement->fetchAll(PDO::FETCH_ASSOC);



$sql = file_get_contents("sql/getCrewId.sql");
$params = array(
	'capId' => $crewid
	);
$statement = $database->prepare($sql);
$statement->execute($params);
$crewCheck = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach($crewCheck as $e){
	$crewArray[] = $e['crewId'];
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$capId = $_POST['capId'];
	$crewArrays = $_POST['fcrew'];
	
	if($action == 'add') {

		$sql = file_get_contents('sql/insertCapCrew.sql');
		$statement = $database->prepare($sql);
		foreach($crewArrays as $id) {
			$params = array(
				'capId' => $capId,
				'crewId' => $id
			);
			$statement->execute($params);
		}
	}
	
	elseif ($action == 'edit') {
		$sql = file_get_contents('sql/deleteCapCrew.sql');
		$params = array(
			'capId' => $capId
		);
	
		$statement = $database->prepare($sql);
		$statement->execute($params);
		
		$sql = file_get_contents('sql/insertCapCrew.sql');
		
		foreach($crewArrays as $id) {
			$params = array(
				'capId' => $capId,
				'crewId' => $id
			);
			$statement = $database->prepare($sql);
			$statement->execute($params);
		}
	}
}
		


?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Build Crew</title>
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
			<li><a href="buildCrew.php?action=add&crewid=<?php echo $crewid ?>">Build Crew</a></li>
			<li><a href="login.php">Login</a></li>
			<li><a href="logout.php">Logout</a></li>
	</ul>
	</nav>
	<div class="page">
		<img id="jolly" src="images/jolly.png" alt="jolly">
		<h1>Crew Builder</h1>
		<br />
		<h2>Your Captain</h2>
		<hr>
		<br />
		<form action="" method="POST">
			<div class="form-element">
				<input readonly type="text" name="name" class="textbox" value="<?php echo $cap['name'] ?>" />
				<input readonly type="text" name="capId" class="textbox" value="<?php echo $cap['crewid'] ?>" /><br />
			</div>
			<div class="form-element">
				<?php foreach ($crew as $x) : ?>
					<?php if(in_array($x['crewid'], $crewArray)) : ?>
						<input checked class="radio" type="checkbox" name= "fcrew[]" value="<?php echo $x['crewid'] ?>"/><span class="radio-label"><?php echo $x['name'] ?></span><br />
					<?php else : ?>
						<input class="radio" type="checkbox" name= "fcrew[]" value="<?php echo $x['crewid'] ?>" /><span class="radio-label"><?php echo $x['name'] ?></span><br />
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
			<div class="form-element">
				<input type="submit" class="button" />&nbsp;
				<input type="reset" class="button" />
			</div>
		</form>
	</div>
</body>
</html>