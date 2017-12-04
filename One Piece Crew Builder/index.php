<?php
include('config.php');

$crewid = $user->get('crewid');
$isCap = isCap($crewid, $database);
if($isCap == false)
{
	header ("location: class.php");
}

$cap = null;




$sql = file_get_contents('sql/getCaptainsForm.sql');
$params = array(
	'crewid' => $crewid
);
$statement = $database->prepare($sql);
$statement->execute($params);
$captains = $statement->fetchAll(PDO::FETCH_ASSOC);

$cap = $captains[0];


$sql = file_get_contents('sql/getCapCrew.sql');
$params = array(
	'crewid' => $crewid
);
$statement = $database->prepare($sql);
$statement->execute($params);
$crew = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Home</title>
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
		<h1>Welocme To One Piece Crew Builder</h1>
		<hr>
		<br />
		<p>Here is your current crew<br />
		Currently Logged in as <?php echo $user->get('name') ?><br />
		<a href="captianForm.php?action=edit&crewid=<?php echo $crewid ?>">Edit Captain</a><br />
		<a href="buildCrew.php?action=edit&crewid=<?php echo $crewid ?>">Edit Crew</a>
		</p>
		<br />
		<h2>Your Crew Name:</h2>
		<hr>
		<br />
		<p><?php echo $cap['crewName']; ?></p>
		<br />
		<h2>Your Captain:</h2>
		<hr>
		<br />
			<p>
				<strong><?php echo $cap['name']; ?></strong><br />
				<img id="beli" src="images/Beli.png" alt="beli"><?php echo $cap['bounty']; ?> <br />
			</p>
		<br />
		<h2>Your Crew Members:</h2>
		<?php foreach ($crew as $cm) : ?>
			<hr>
			<br/>
			<p>
				<strong><?php echo $cm['name']; ?></strong><br />
				<img id="beli" src="images/Beli.png" alt="beli"><?php echo $cm['bounty']; ?> <br />
			</p>
		<?php endforeach; ?>	
	</div>
</body>
</html>